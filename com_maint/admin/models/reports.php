<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modellist');
 
/**
 * HelloWorld Model
 */
class MaintModelReports extends JModelList {
    
    public $start;
    public $end;

    protected function populateState($ordering = null, $direction = null) {
        parent::populateState($ordering, $direction);

        $start = $this->getUserStateFromRequest($this->context . '.filter.start', 'filter_start');
        if ($start && $start=date('Y-m-d',strtotime($start)))
            $this->setState('filter.start', $start);
        else
            $this->setState('filter.start', date('Y-m-d'));

        $end = $this->getUserStateFromRequest($this->context . '.filter.end', 'filter_end');
        if ($start && $start=date('Y-m-d',strtotime($start)))
            $this->setState('filter.end', $end);
        else
            $this->setState('filter.end', date('Y-m-d',date(strtotime('last month'))));
        
        $this->start = strtotime($this->getState('filter.start'));
        $this->end   = strtotime($this->getState('filter.end'));
        if ($this->start > $this->end)
        {
            $temp = $this->end;
            $this->end   = $this->start;
            $this->start = $temp;
            unset($temp);
        }
    }
    
    public function getDevicesIn()
    {
        $db = $this->getDbo();
        $db->setQuery('SELECT COUNT(id) AS cid FROM #__maint_orders AS o WHERE o.entered_at >= "'.$this->start.'"
                                                                           AND o.entered_at <= "'.$this->end.'"');
    }
    
    

}
