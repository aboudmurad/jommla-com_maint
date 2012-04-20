<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * HelloWorld Model
 */
class MaintModelMaint extends JModelItem {

    /**
     * @var string msg
     */
    protected $orders;

    /**
     * Get the message
     * @return string The message to be displayed to the user
     */
    public function getOrders() {
        $num = JRequest::getInt('num');
        if (!isset($this->orders) || !$this->orders) {
            $db = $this->getDbo();

            $db->setQuery(
                    'SELECT o.*, c.name' .
                    ' FROM #__maint_orders AS o' .
                    ' LEFT JOIN #__maint_clients AS c ' .
                    ' ON c.id = o.client_id' .
                    ' WHERE c.phone = "' . $num . '"' .
                    ' OR o.id = ' . $num .
                    ' ORDER BY o.entered_at DESC'
            );

            $this->orders = $db->loadObjectList();   
        }
        return $this->orders;
    }

}
