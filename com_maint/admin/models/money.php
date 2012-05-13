<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modellist');

/**
 * Maint Model
 */
class MaintModelMoney extends JModelList {

    
    
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
    
    
    protected function populateState($ordering = null, $direction = null) {
        parent::populateState($ordering, $direction);

        $workerId = $this->getUserStateFromRequest($this->context . '.filter.workerId', 'filter_workerId');
        $this->setState('filter.workerId', $workerId);
    }
    
    public function moneyPaySw() {
        $id    = (int) $_POST['cid'][0];
        $money = $this->getTable('Money');
        $currentLoggedUser =& JFactory::getUser();
        
        $money->load($id);
        if ( $money->id ) {
            if ($money->manager_id) {
                $money->manager_id = 0;
                $money->datetime_to = '0000-00-00 00:00:00';
            } else {
                $money->manager_id = $currentLoggedUser->id;
                $money->datetime_to = date('Y-m-d H:i:s');
            }
            $money->store();
        }
    }

    public function getWorkerList() {
        // Create a new query object.
        $db = JFactory::getDBO();
        $db->setQuery('SELECT u.id, u.name from #__users AS u JOIN #__maint_money AS m ON m.worker_id=u.id');
        return $db->loadAssocList('id', 'name');
    }
    
    public function getInfo() {
        // Create a new query object.
        $workerId = (int) $this->getState('filter.workerId');
        $query = 'SELECT m.*, u1.name AS worker_name, u2.name AS manager_name 
                            FROM #__maint_money AS m 
                                LEFT JOIN #__users AS u1 ON u1.id=m.worker_id
                                LEFT JOIN #__users AS u2 ON u2.id=m.manager_id
                        ';
        if ($workerId > 0) {
            $query .= 'WHERE m.worker_id = "' . $workerId . '"'; 
        }
        $query .= ' ORDER BY m.datetime_from DESC';
        
        $db = JFactory::getDBO();
        $db->setQuery($query);
                                
        return $db->loadObjectList();
    }
    
}