<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * Maint Model
 */
class MaintModelShow extends JModelItem {

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

}
