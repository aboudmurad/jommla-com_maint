<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HelloWorld View
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
		$this->form = $form;
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
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew      = (false==isset($this->item) || $this->item->id == 0);

		JToolBarHelper::title($isNew ? 'جديد'
		                             : 'تغيير');
		JToolBarHelper::save2new('maint.save2new');
		JToolBarHelper::save('maint.save');
		JToolBarHelper::cancel('maint.cancel', $isNew ? 'JTOOLBAR_CLOSE'
      	                                                : 'JTOOLBAR_CANCEL');
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
    }
}
