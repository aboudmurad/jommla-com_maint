<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modeladmin');

/**
 * Maint Model
 */
class MaintModelMaint extends JModelAdmin {

    /**
     * @var string msg
     */
    protected $order;

    /**
     * Method override to check if you can edit an existing record.
     *
     * @param	array	$data	An array of input data.
     * @param	string	$key	The name of the key for the primary key.
     *
     * @return	boolean
     * @since	2.5
     */
    protected function allowEdit($data = array(), $key = 'id')
    {
        // Check specific edit permission then general edit permission.
        return JFactory::getUser()->authorise('core.edit', 'com_maint.message.'.
                        ((int) isset($data[$key]) ? $data[$key] : 0))
                        or parent::allowEdit($data, $key);
    }

    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param	type	The table type to instantiate
     * @param	string	A prefix for the table class name. Optional.
     * @param	array	Configuration array for model. Optional.
     * @return	JTable	A database object
     * @since	1.6
     */
    public function getTable($type = 'order', $prefix = 'MaintTable', $config = array()) {
        $type = 'maint_' . $type;
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to save the form data.
     *
     * @param	array	The form data.
     * @return	boolean	True on success.
     */
    public function save($data) {
        $isNew		= true;
        $id			= (!empty($data['id'])) ? $data['id'] : (int)$this->getState($this->getName().'.id');
        if ($id > 0) {
            $isNew = false;
        }

        //make entries
        $orderObj = $this->getTable();
        $clientObj = $this->getTable('client');

        $this->mergeClientData($data, $clientObj);
        $clientObj->store();

        $this->mergeOrderData($data, $orderObj, $clientObj);
        $orderObj->store();

        if (isset($orderObj->id)) {
            $this->setState($this->getName().'.id', $orderObj->id);
        }
        $this->setState($this->getName().'.new', $isNew);
        return true;
    }

    private function mergeOrderData($data, $orderObj, $clientObj) {
        $user	 = JFactory::getUser();
        $userId	 = $user->get('id');
        $canDo   = MaintHelper::getActions(0);
        $canDeliver = $canDo->get('core.deliver');

        $order = array();

        $currentLoggedUser =& JFactory::getUser();
        $orderObj->load($data['id']);

        $leftMoney = $data['total_money'] - ( $data['paied_money'] + $data['discount_money'] );
        $order = array(
                        'device_type' => $data['device_type'],
                        'device_desc' => $data['device_desc'],
                        'device_accessories' => $data['device_accessories'],
                        'work_required'      => $data['work_required'],
                        'entered_at' => $data['entered_at'],
                        'work_done'  => $data['work_done'],
                        'total_money' => $data['total_money'],
                        'discount_money' => $data['discount_money'],
                        'paied_money'    => $data['paied_money'],
                        'left_money'     => $leftMoney,
                        'fixed_at'       => $data['fixed_at'],
                        'delivered_at'   => $data['delivered_at'],
                        'client_id'      => $clientObj->id,
                        'extra_parts_notes'    => $data['extra_parts_notes'],
                        'extra_parts_notes_paied'    => $data['extra_parts_notes_paied']
        );

        if (!$orderObj->workers_recipient_id)
        {
            $order['workers_recipient_id'] = $currentLoggedUser->id;
        }

        if (strtotime($data['fixed_at']) > 0) {
            $order['fixed'] = 1;
            $order['workers_fixer_id'] = "$currentLoggedUser->id";
        }else {
            $order['fixed'] = 0;
        }


        $netMoney = 0;
        //calculate money paied
        if ($orderObj->paied_money  ) {
            $netMoney = $order['paied_money'] - $orderObj->paied_money;
        } else {
            $netMoney = $order['paied_money'];
        }


        if ($netMoney != 0) {
            // update worker holding money.
            $this->addMoneyToWorker($netMoney, $order);
        }
         
        $orderObj->bind($order);
        return $orderObj;
    }

    private function addMoneyToWorker($netMoney, $order) {

        $currentLoggedUser =& JFactory::getUser();
        $mm = $this->getTable('money');

        $query = 'SELECT *' .
                        ' FROM #__maint_money AS m' .
                        ' WHERE m.worker_id = "' . $currentLoggedUser->id . '"'.
                        'AND m.manager_id = 0 ';
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $oldUser =  $db->loadObject();

        if ($oldUser->id && $mm->load($oldUser->id)) {
            $mm->money       =   ($mm->money + $netMoney);
            $mm->datetime_to =    date('Y-m-d H:i:s');
        } else {
            $mm->bind(array(
                            'worker_id'    =>    $currentLoggedUser->id,
                            'datetime_from'=>    date('Y-m-d H:i:s'),
                            'datetime_to'  =>    date('Y-m-d H:i:s'),
                            'money'        =>    $netMoney,
            ));
        }

        if ($mm->money == 0) {
            return $mm->delete();
        }
        return $mm->store();
    }

    private function mergeClientData($data, $clientObj) {
        //check if the user email or phone exists
        $oldClient = false;
        if (($data['client_name'] && ($oldClient = $this->getClientByName($data['client_name']))) ||
                        ($data['client_phone'] && ($oldClient = $this->getClientByPhone($data['client_phone']))) ||
                        ($data['client_mobile'] && ($oldClient = $this->getClientByMobile($data['client_mobile']))) ||
                        ($data['client_email'] && ($oldClient = $this->getClientByEmail($data['client_email']))) ) {

            $clientObj->bind($oldClient);
            $clientObj->name = $data['client_name'];
            $clientObj->phone = $data['client_phone'];
            $clientObj->mobile = $data['client_mobile'];

            //if (!$clientObj->email && isset($data['client_email']) && $data['client_email']) {
            $clientObj->email = $data['client_email'];
            //}
        } else {
            $clientData = array(
                            'name' => $data['client_name'],
                            'phone' => $data['client_phone'],
                            'mobile' => $data['client_mobile'],
                            'email' => $data['client_email']
            );
            $clientObj->bind($clientData);
        }
    }

    /**
     *
     * @return array
     */
    public function getClientByPhone($phone) {

        $query = 'SELECT *' .
                        ' FROM #__maint_clients AS c' .
                        ' WHERE c.phone = "' . $phone . '"';

        // Create a new query object.
        $db = JFactory::getDBO();
        $db->setQuery($query);
        return $db->loadObject();
    }

    /**
     *
     * @return array
     */
    public function getClientByMobile($mobile) {
        if (!$mobile)
            return false;
        $query = 'SELECT *' .
                        ' FROM #__maint_clients AS c' .
                        ' WHERE c.mobile = "' . $mobile . '"';

        // Create a new query object.
        $db = JFactory::getDBO();
        $db->setQuery($query);
        return $db->loadObject();
    }

    /**
     *
     * @return array
     */
    public function getClientByName($name) {
        if (!$name)
            return false;
        $db = JFactory::getDBO();
        $name = $db->escape($name);
        $query = 'SELECT *' .
                        ' FROM #__maint_clients AS c' .
                        ' WHERE c.name = "' . $name . '"';

        // Create a new query object.
        $db->setQuery($query);
        return $db->loadObject();
    }

    /**
     *
     * @return array
     */
    public function getClientById($id) {
        if (!$id)
            return false;
        $query = 'SELECT *' .
                        ' FROM #__maint_clients AS c' .
                        ' WHERE c.id = ' . $id;

        // Create a new query object.
        $db = JFactory::getDBO();
        $db->setQuery($query);
        return $db->loadObject();
    }

    /**
     *
     * @return array
     */
    public function getClientByEmail($email) {
        if (!$email)
            return false;
        $query = 'SELECT *' .
                        ' FROM #__maint_clients AS c' .
                        ' WHERE c.email = "' . $email . '"';

        // Create a new query object.
        $db = JFactory::getDBO();
        $db->setQuery($query);
        return $db->loadObject();
    }

    /**
     * Get the message
     * @return string The message to be displayed to the user
     */
    public function getOrder() {
        if ($this->order)
            return $this->order;

        $id = JRequest::getInt('id');

        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('o.*');
        $query->from('#__maint_orders AS o');

        // Join over the Clients
        $query->select('c.name, c.email, c.phone, c.mobile, c.id as client_id');
        $query->join('LEFT', '`#__maint_clients` AS c ON c.id = o.client_id');

        // Join over the users for user name
        $query->select('ux.name AS workers_recipient');
        $query->join('LEFT', '#__users AS ux ON ux.id=o.workers_recipient_id ');

        // Join over the users for the checked out user.
        $query->select('u.name AS workers_fixer');
        $query->join('LEFT', '#__users AS u ON u.id=o.workers_fixer_id  ');

        $query->where('o.id =' . $id);

        $db->setQuery($query);
        $this->order = $db->loadObject();
        return $this->order;
    }

    /**
     * Method to get the record form.
     *
     * @param	array	$data		Data for the form.
     * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
     * @return	mixed	A JForm object on success, false on failure
     * @since	1.6
     */
    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm('com_maint.maint', 'order', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return	mixed	The data for the form.
     * @since	1.6
     */
    protected function loadFormData() {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_maint.edit.maint.data', array());
        if (empty($data) && ($id = (int) JRequest::getInt('id'))) {
            /*$db = $this->getDbo();
             $db->setQuery(
                             'SELECT o.*, c.id AS client_id, c.name AS client_name, c.phone AS client_phone, c.mobile AS client_mobile, c.email AS client_email' .
                             ' FROM #__maint_orders AS o' .
                             ' LEFT JOIN #__maint_clients AS c' .
                             ' ON c.id = o.client_id' .
                             ' WHERE o.id = ' . $id
             );

            $this->order = $db->loadObject();*/
            if (!$this->order)
                $this->order = $this->getOrder();
            
            if ( strtotime($this->order['fixed_at']) <= 0 ) {
                $this->order['fixed_at'] = NULL;
            }
            if ( strtotime($this->order['delivered_at']) <= 0 ) {
                $this->order['delivered_at'] = NULL;
            }
            $data = $this->order;
            $data->client_name  = $data->name;
            $data->client_phone = $data->phone;
            $data->client_mobile = $data->mobile;
            $data->client_email  = $data->email;
        }
        return $data;
    }

    public function getNameList() {
        $db = JFactory::getDBO();
        $name = $db->getEscaped( JRequest::getVar('query'));
        $db->setQuery('SELECT * from `#__maint_clients` WHERE `name` LIKE "%'.$name.'%"');
        return $db->loadAssocList('name');
    }

    public function getDeviceList() {
        $db = JFactory::getDBO();
        $name = $db->getEscaped( JRequest::getVar('query'));
        $db->setQuery('SELECT `device_type` from `#__maint_orders` WHERE `device_type` LIKE "%'.$name.'%"');
        return $db->loadAssocList(NULL, 'device_type');
    }

}
