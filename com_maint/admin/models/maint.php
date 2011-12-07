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

    //check if the user email or phone exists
    $oldClient = false;
    if (($oldClient = $this->getClientById((int) $data['user_id'])) ||
            ($oldClient = $this->getClientByPhone($data['user_phone'])) ||
            ($oldClient = $this->getClientByEmail($data['user_email']) )) {
      $clientObj->bind($oldClient);
      $clientObj->name = $data['user_name'];
      $clientObj->phone = $data['user_phone'];
      if (!$clientObj->email && isset($data['user_email']) && $data['user_email'])
        $clientObj->email = $data['user_email'];
    } else {
      $clientData = array(
          'name' => $data['user_name'],
          'phone' => $data['user_phone'],
          'email' => $data['user_email']
      );
      $clientObj->bind($clientData);
    }
    $clientObj->store();

    $leftMoney = $data['total_money'] - ( $data['paied_money'] + $data['discount_money'] );
    $order = array(
        'type' => $data['type'],
        'serial' => $data['serial'],
        'stat' => $data['stat'],
        'work_done' => $data['work_done'],
        'total_money' => $data['total_money'],
        'discount_money' => $data['discount_money'],
        'paied_money' => $data['paied_money'],
        'left_money' => $leftMoney,
        'entered_at' => $data['entered_at'],
        'fixed_at' => $data['fixed_at'],
        'delivered_at' => $data['delivered_at'],
        'client_id' => $clientObj->id
    );

    if (isset($data['id']) && $data['id'])
      $order['id'] = $data['id'];

    $orderObj->bind($order);
    $orderObj->store();
    return true;
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
  public function getClientById($id) {

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
    if (!isset($this->order)) {
      $id = JRequest::getInt('id');

      // Get a TableHelloWorld instance
      $table = $this->getTable();

      // Load the message
      $table->load($id);

      // Assign the message
      $this->order = $table;
    }
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
    if (empty($data) && ($id = (int) JRequest::getInt('id')) ) {
      $db = $this->getDbo();
      $db->setQuery(
              'SELECT o.*, c.id AS user_id, c.name AS user_name, c.phone AS user_phone, c.email AS user_email' .
              ' FROM #__maint_orders AS o' .
              ' LEFT JOIN #__maint_clients AS c' .
              ' ON c.id = o.client_id' .
              ' WHERE o.id = ' . $id
      );

      $data = $db->loadObject();
    }
    return $data;
  }

}
