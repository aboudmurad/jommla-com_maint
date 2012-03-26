<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modeladmin');

/**
 * HelloWorld Model
 */
class MaintModelMaint extends JModelAdmin {

    /**
     * @var string msg
     */
    protected $order;

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
 
        //make entries
        $orderObj = $this->getTable();
        $clientObj = $this->getTable('client');

        $this->mergeClientData($data, $clientObj);
        $clientObj->store();

        $this->mergeOrderData($data, $orderObj, $clientObj);

        $orderObj->store();
        return true;
    }

    private function mergeOrderData($data, $orderObj, $clientObj) {
       	$currentLoggedUser =& JFactory::getUser();
        $orderObj->load($data['id']);
        
        if (!$orderObj->workers_recipient_id)
        {
            $order['workers_recipient_id'] = $currentLoggedUser->id;
        }

        $leftMoney = $data['total_money'] - ( $data['paied_money'] + $data['discount_money'] );
        $order = array(
            'device_type' => $data['device_type'],
            'device_desc' => $data['device_desc'],
            'work_required' => $data['work_required'],
            'entered_at' => $data['entered_at'],
            'work_done' => $data['work_done'],
            'total_money' => $data['total_money'],
            'discount_money' => $data['discount_money'],
            'paied_money' => $data['paied_money'],
            'left_money' => $leftMoney,
            'fixed_at' => $data['fixed_at'],
            'delivered_at' => $data['delivered_at'],
            'client_id' => $clientObj->id
        );
       
        if (strtotime($data['fixed_at'])) { 
            $order['fixed'] = 1;
            $order['workers_fixer_id'] = $currentLoggedUser->id;
        }else {
            $order['fixed'] = 0;
        }
        

        $orderObj->bind($order);       
    }

    private function mergeClientData($data, $clientObj) {
        //check if the user email or phone exists
        $oldClient = false;
        if (($oldClient = $this->getClientById($data['client_id'])) ||
                ($oldClient = $this->getClientByPhone($data['client_phone'])) ||
                ($oldClient = $this->getClientByMobile($data['client_mobile'])) ||
                ($oldClient = $this->getClientByEmail($data['client_email']) )) {

            $clientObj->bind($oldClient);
            $clientObj->name = $data['client_name'];
            $clientObj->phone = $data['client_phone'];
            $clientObj->mobile = $data['client_mobile'];

            if (!$clientObj->email && isset($data['client_email']) && $data['client_email']) {
                $clientObj->email = $data['client_email'];
            }
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
            $data = $this->order;
            $data->client_name  = $data->name;
            $data->client_phone = $data->phone;
            $data->client_mobile = $data->mobile;
            $data->client_email  = $data->email;
        }
        return $data;
    }

}
