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
        JToolBarHelper::title(' الصيانة');
        JToolBarHelper::back('JTOOLBAR_BACK', 'index.php?option=com_maint');
        JToolBarHelper::customX('maints.moneySW', 'alf', '', 'تبديل حالة الدفع');
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle('إدارة ورشة صيانة الحواسيب');
        $document->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/admin.css');
    }
}
