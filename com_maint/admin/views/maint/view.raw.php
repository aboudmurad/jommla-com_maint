<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Maint View
 */
class MaintViewMaint extends JView
{
	/**
	 * display method of Hello view
	 * @return void
	 */
	public function display($tpl = null)
	{
    $query  = JRequest::getVar('query');
    $list   = JRequest::getVar('list');
    $func   = ucfirst( strtolower($list ) ).'List';

    $return = array('query'  => $query, 'suggestions'=> array());

    $result = (array) $this->get($func);

    if ($func == 'NameList') {
      $return['suggestions'] = array_keys($result);
      $return['data'] = array_values($result);
    } else {
      $return['suggestions'] = $result;
    }

    echo json_encode($return);
	}
}
