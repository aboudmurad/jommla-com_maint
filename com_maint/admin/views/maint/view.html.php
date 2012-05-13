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
		// get the Data
		$form = $this->get('Form');
		$order = $this->get('Order');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->form  = $form;
		$this->order = $order;

		// Set the toolbar
		$this->addToolBar();


        // Set the document
        $this->setDocument();


		// Display the template
		parent::display($tpl);
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		JRequest::setVar('hidemainmenu', true);
		$user	 = JFactory::getUser();
		$userId	 = $user->get('id');
		if ($this->order)
		    $canDo   = MaintHelper::getActions($this->order->id);
		else
		    $canDo   = MaintHelper::getActions(0);
		$isNew   = (false == isset($this->order) || $this->order->id == 0);
		$this->canDeliver = $canDo->get('core.deliver');

		JToolBarHelper::title($isNew ? 'جديد'
		                             : 'تغيير');
		
		if ($isNew)
		{
		    // For new records, check the create permission.
		    if ($canDo->get('core.create'))
		    {
		        JToolBarHelper::apply('maint.apply', 'JTOOLBAR_APPLY');
		        JToolBarHelper::save('maint.save', 'JTOOLBAR_SAVE');
		        JToolBarHelper::save2new('maint.save2new');
		    }
		} else {
		    if ($canDo->get("core.edit")) {
		        JToolBarHelper::apply('maint.apply', 'JTOOLBAR_APPLY');
		        JToolBarHelper::save('maint.save', 'JTOOLBAR_SAVE');
		        
		        // if we can return to make a new one.
		        if ($canDo->get('core.create'))
		        {
		            JToolBarHelper::save2new('maint.save2new');
		        }
		    }
		    
		    $bar = JToolBar::getInstance('toolbar');
		    $bar->addButtonPath(JPATH_COMPONENT.'/button/');
		    $bar->appendButton('Print', 'Print', 'index.php?option=com_maint&task=maints.pprint&id='.$this->order->id);
		}
		JToolBarHelper::cancel('maint.cancel', 'JTOOLBAR_CANCEL');
	}


    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->addScriptDeclaration('var baseUrl="'.JURI::base().'"');
        $document->addScript(JURI::base(true)  . '/components/com_maint/assets/js/jquery-1.3.2.min.js');
        $document->addScript(JURI::base(true)  . '/components/com_maint/assets/js/jquery.autocomplete-min.js');
        $document->addScript(JURI::base(true)  . '/components/com_maint/assets/js/my.js?baseUrl='.JURI::base(true));
        $document->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/jquery.autocomplete.css');
        $document->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/admin.css');
    }
}
