<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the Maint Component
 */
class MaintViewMoney extends JView {

    // Overwriting JView display method
    function display($tpl = null) {

        $this->state = $this->get('State');
        
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
        JToolBarHelper::title(JText::_('COM_MAINT'));
        JToolBarHelper::back('JTOOLBAR_BACK', 'index.php?option=com_maint');
        JToolBarHelper::customX('maints.moneySW', 'alf', '', 'COM_MAINT_SW_STATE');
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_MAINT'));
        $document->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/admin.css');
    }
}
