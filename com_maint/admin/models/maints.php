<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * HelloWorld Model
 */
class MaintModelMaints extends JModelItem {

  /**
   * @var string msg
   */
  protected $order;

  /**
   * Get Array of orders
   * @return array
   */
  public function getOrders() {
    // Create a new query object.
    $db = JFactory::getDBO();
    $db->setQuery(
            'SELECT o.*, c.name, c.phone, c.email' .
            ' FROM #__maint_orders AS o' .
            ' LEFT JOIN #__maint_clients AS c' .
            ' ON c.id = o.client_id'
    );
    return $db->loadObjectList();
  }

  /**
   * Get the message
   * @return string The message to be displayed to the user
   */
  public function getOrder() {
    $id = JRequest::getInt('id');
    $phone = JRequest::getString('phone');
    if (!isset($this->order)) {
      $client = $order = NULL;
      $db = $this->getDbo();

      $db->setQuery(
              'SELECT *' .
              ' FROM #__maint_orders AS o' .
              ' LEFT JOIN #__maint_clients AS c ' .
              'ON c.id = o.client_id' .
              ' WHERE c.phone = "' . $phone . '"' .
              ' AND o.id = ' . $id
      );

      $this->order = $db->loadObject();
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
    $form = $this->loadForm('com_maint.maint', 'maint', array('control' => 'jform', 'load_data' => $loadData));
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
    if (empty($data)) {
      $data = $this->getItem();
    }
    return $data;
  }

}
