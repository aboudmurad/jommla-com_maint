<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 */
class MaintViewMaints extends JView
{
	// Overwriting JView display method
	function display($tpl = null)
	{
		// Get data from the model
		$items = $this->get('Orders');
		$pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->items = $items;
		$this->pagination = $pagination;

        // Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

  /**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title('ورشة الصيانة');

    JToolBarHelper::custom( 'maint.search', 'icon-32-search.png', '', 'بحث', false, false );
    JToolBarHelper::custom( 'maint.report', 'icon-32-xml.png', '', 'التقارير', false, false );

		JToolBarHelper::deleteList('', 'maints.delete');
		JToolBarHelper::editList('maint.edit');
		JToolBarHelper::addNew('maint.add');
	}
}
