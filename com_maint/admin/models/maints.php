<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modellist');

/**
 * Maint Model
 */
class MaintModelMaints extends JModelList {

    /**
     * @var string msg
     */
    protected $order;

    /**
     * Constructor.
     *
     * @param	array	An optional associative array of configuration settings.
     * @see		JController
     * @since	1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'o.id',
                'c.name',
                'c.phone ',
                'c.mobile',
                'c.email',
                'o.device_type',
                'o.device_accessories',
                'o.fixed',
                'o.discount_money',
                'o.total_money',
                'o.paied_money',
                'o.left_money',
                'o.entered_at',
                'o.fixed_at',
                'o.delivered_at'
            );
        }

        parent::__construct($config);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
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

        $fixed = $this->getState('filter.fixed');
        if (is_numeric($fixed) && ($fixed == 1 || $fixed == 0)) {
            $fixed = (int) $fixed;
            $query->where('o.fixed = "' . $fixed . '"');
        }

        $left_money = $this->getState('filter.left_money');
        if (is_numeric($left_money) && ($left_money == 1 || $left_money == 0)) {
            if ($left_money == 0) {
                $query->where('o.left_money = 0');
            } else {
                $query->where('o.left_money > 0');
            }
        }

        $delivered = $this->getState('filter.delivered');
        if (is_numeric($delivered) && ($delivered == 1 || $delivered == 0)) {
            if ($delivered == 0) {
                $query->where('o.delivered_at = 0');
            } else {
                $query->where('o.delivered_at > 0');
            }
        }

        $clientId = $this->getState('filter.clientId');
        if ($clientId) {
            $clientId = (int) $clientId;
            $query->where('o.client_id = "' . $clientId . '"');
        }

        $deviceType = $this->getState('filter.deviceType');
        if ($deviceType) {
            $deviceType = $db->getEscaped( $deviceType );
            $query->where('o.device_type = "' . $deviceType . '"');
        }

        $start = $this->getState('filter.start');
        if ($start) {
            $start = $db->getEscaped( $start );
            $query->where('o.entered_at >= "' . $start . ' 00:00:00"');
        }


        $end = $this->getState('filter.end');
        if ($end) {
            $end = $db->getEscaped( $end );
            $query->where('o.entered_at <= "' . $end . ' 00:00:00"');
        }


        // Filter by search in title.
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (is_numeric($search)) {
                $search = (int) $search;
                $query->where('(o.id =' . $search . '
                                OR o.phone = "' . $search . '"
                                OR o.mobile = "' . $search . '" )');
            } else {
                $search = $db->Quote('%' . $db->getEscaped($search, true) . '%');
                $query->where('(c.name LIKE ' . $search . '
                             OR u.name LIKE ' . $search . '
                             OR ux.name LIKE ' . $search . '
                             OR c.email LIKE ' . $search . '
                             OR o.device_accessories  LIKE ' . $search . '
                             OR o.device_type  LIKE ' . $search . '
                             OR o.device_desc LIKE ' . $search . '
                             OR o.work_required LIKE ' . $search . '
                                 )');
            }
        }


        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        $query->order($db->getEscaped($orderCol . ' ' . $orderDirn));

        // echo nl2br(str_replace('#__','jos_',$query));
        return $query;
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return	void
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {
        // Adjust the context to support modal layouts.
        if (($layout = JRequest::getVar('layout'))) {
            $this->context .= '.' . $layout;
        }
        //Clients for the form
        $this->setState('clientIdsList', $this->getClientList());

        //Device Types for the form
        $this->setState('deviceTypesList', $this->getDevicesList());

        //Filter population
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $fixed = $this->getUserStateFromRequest($this->context . '.filter.fixed', 'filter_fixed');
        $this->setState('filter.fixed', $fixed);

        $left_money = $this->getUserStateFromRequest($this->context . '.filter.left_money', 'filter_left_money');
        $this->setState('filter.left_money', $left_money);

        $delivered = $this->getUserStateFromRequest($this->context . '.filter.delivered', 'filter_delivered');
        $this->setState('filter.delivered', $delivered);

        $deviceType = $this->getUserStateFromRequest($this->context . '.filter.deviceType', 'filter_deviceType');
        $this->setState('filter.deviceType', $deviceType);

        $clientId = $this->getUserStateFromRequest($this->context . '.filter.clientId', 'filter_clientId');
        $this->setState('filter.clientId', $clientId);

        $start = $this->getUserStateFromRequest($this->context . '.filter.start', 'filter_start');
        $end   = $this->getUserStateFromRequest($this->context . '.filter.end', 'filter_end');
        if ($start && $end && ($start=strtotime($start)) && ($end=strtotime($end)) ) {
            if ($start > $end) {
              $this->setState('filter.start', date('Y-m-d',$end));
              $this->setState('filter.end', date('Y-m-d',$start));
            } else {
              $this->setState('filter.start', date('Y-m-d',$start));
              $this->setState('filter.end', date('Y-m-d',$end));
            }
        }

        // List state information.
        parent::populateState('o.id', 'desc');
    }

    public function getOrders() {
        // Create a new query object.
        $db = JFactory::getDBO();
        $db->setQuery($this->getListQuery());
        return $db->loadObjectList();
    }

    public function getClientList() {
        // Create a new query object.
        $db = JFactory::getDBO();
        $db->setQuery('SELECT `id`, `name` from `#__maint_clients`');
        return $db->loadAssocList('id', 'name');
    }

    public function getDevicesList() {
        // Create a new query object.
        $db = JFactory::getDBO();
        $db->setQuery('SELECT DISTINCT `device_type` from `#__maint_orders`');
        return $db->loadAssocList('device_type', 'device_type');
    }

}
