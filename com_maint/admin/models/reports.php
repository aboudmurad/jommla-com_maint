<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modellist');

/**
 * HelloWorld Model
 */
class MaintModelReports extends JModelList {

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
    }

    public function getDevicesIn()
    {
      $this->prepareDate();
      $db = $this->getDbo();
      $db->setQuery('SELECT COUNT(id) AS cid FROM #__maint_orders AS o WHERE o.entered_at >= "'.$this->getState('filter.start').' 00:00:00"
                                                                           AND o.entered_at <= "'.$this->getState('filter.end').' 00:00:00"');
      $x = $db->loadAssoc();
      return (int) $x['cid'];
    }

    public function getDevicesOut()
    {
      $this->prepareDate();
      $db = $this->getDbo();
      $db->setQuery('SELECT COUNT(id) AS cid FROM #__maint_orders AS o WHERE o.delivered_at >= "'.$this->getState('filter.start').' 00:00:00"
                                                                           AND o.delivered_at <= "'.$this->getState('filter.end').' 00:00:00"');
      $x = $db->loadAssoc();
      return (int) $x['cid'];
    }

    public function getDevicesFixed()
    {
      $this->prepareDate();
      $db = $this->getDbo();
      $db->setQuery('SELECT COUNT(id) AS cid FROM #__maint_orders AS o WHERE o.fixed_at >= "'.$this->getState('filter.start').' 00:00:00"
                                                                           AND o.fixed_at <= "'.$this->getState('filter.end').' 00:00:00"');
      $x = $db->loadAssoc();
      return (int) $x['cid'];
    }

    public function getMoneyIn()
    {
      $this->prepareDate();
      $db = $this->getDbo();
      $db->setQuery('SELECT SUM(paied_money) AS cid FROM #__maint_orders AS o WHERE o.entered_at >= "'.$this->getState('filter.start').' 00:00:00"
                                                                           AND o.entered_at <= "'.$this->getState('filter.end').' 00:00:00"');
      $x = $db->loadAssoc();
      return (int) $x['cid'];
    }

    public function getMoneyDiscount()
    {
      $this->prepareDate();
      $db = $this->getDbo();
      $db->setQuery('SELECT SUM(discount_money) AS cid FROM #__maint_orders AS o WHERE o.entered_at >= "'.$this->getState('filter.start').' 00:00:00"
                                                                           AND o.entered_at <= "'.$this->getState('filter.end').' 00:00:00"');
      $x = $db->loadAssoc();
      return (int) $x['cid'];
    }

        public function getMoneyLeft()
    {
      $this->prepareDate();
      $db = $this->getDbo();
      $db->setQuery('SELECT SUM(left_money) AS cid FROM #__maint_orders AS o WHERE o.entered_at >= "'.$this->getState('filter.start').' 00:00:00"
                                                                           AND o.entered_at <= "'.$this->getState('filter.end').' 00:00:00"');
      $x = $db->loadAssoc();
      return (int) $x['cid'];
    }

    public function prepareDate() {
        $start = strtotime($this->getState('filter.start'));
        $end   = strtotime($this->getState('filter.end'));
        if ($start > $end)
        {
            $temp = $this->getState('filter.end');
            $this->setState('filter.end', $this->getState('filter.start'));
            $this->setState('filter.start', $temp);
            unset($temp);
        }
    }



}
