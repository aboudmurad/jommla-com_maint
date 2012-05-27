<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the Maint Component
 */
class MaintViewReports extends JView {

    // Overwriting JView display method
    function display($tpl = null) {

        $this->state = $this->get('State');
        
        $this->totalMoney = array(
            'in'        => $this->get('moneyIn'),
            'discount'  => $this->get('moneyDiscount'),
            'left'      => $this->get('moneyLeft')
        );
        
        $this->totalDevices = array(
            'in'    => $this->get('devicesIn'),
            'out'   => $this->get('devicesOut'),
            'fixed' => $this->get('devicesFixed')
        );

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

        JToolBarHelper::title(JText::_('COM_MAINT'));
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $doc = JFactory::getDocument();
        $doc->setTitle(JText::_('COM_MAINT'));
        
        JToolBarHelper::back('JTOOLBAR_BACK', 'index.php?option=com_maint');
        $doc->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/admin.css');
        $doc->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/datepicker/datepicker_dashboard/datepicker_dashboard.css');
        $doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Locale.ar-AA.DatePicker.js');
        $doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.js');
        $doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.Attach.js');
        $doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.Date.js');
        $document->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker_loader.js');
    }

}
