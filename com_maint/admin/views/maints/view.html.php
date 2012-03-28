<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 */
class MaintViewMaints extends JView {

    // Overwriting JView display method
    function display($tpl = null) {
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        // Assign data to the view
        $this->items = $this->get('Items');
        //$this->pagination = $pagination;
        // Set the toolbar
        $this->addToolBar();

        // Display the template
        parent::display($tpl);

        // Set the document
        $this->setDocument();
    }

    /**
     * Setting the toolbar
     */
    protected function addToolBar() {
        //$canDo = MessagesHelper::getActions();

        JToolBarHelper::title(' الصيانة');
        
        $bar = JToolBar::getInstance('toolbar');
        //$bar->appendButton('Popup', 'icon-32-xml', 'التقارير', 'index.php?option=com_messages&amp;view=config&amp;tmpl=component', 850, 400);
        JToolBarHelper::custom('maints.reports', 'icon-32-xml.png', '', 'التقارير', false, false);

        JToolBarHelper::deleteListX('', 'maints.delete');
        JToolBarHelper::editListX('maint.edit');
        JToolBarHelper::addNewX('maint.add');
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle('إدارة ورشة صيانة الحواسيب');
    }

}
