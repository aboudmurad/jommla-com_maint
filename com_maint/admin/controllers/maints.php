<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * HelloWorlds Controller
 */
class MaintControllerMaints extends JControllerAdmin
{
    public function reports() {
        $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view=reports', false));
    }
    
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Maint', $prefix = 'MaintModel')
	{

		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
