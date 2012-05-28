<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * MaintControllerMaints Controller
 */
class MaintControllerMaints extends JControllerAdmin
{
    
    public function Show() {
        $id = (int) $_POST['cid'][0];
        $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view=show&id='.$id, false));
    }
    
    public function pprint() {
        $id = JRequest::getInt('id');
        if ($show=JRequest::getString('show'))
            $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view=pprint&id='.$id.'&show='.$show, false));
        else
            $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view=pprint&id='.$id, false));
    }
    
    public function reports() {
        $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view=reports', false));
    }
    
    public function money() {
        $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view=money', false));
    }
    
    public function moneySW() {
        $money = $this->getModel('Money');
        $money->moneyPaySw();
        $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view=money', false));
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