<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
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

        JToolBarHelper::title(' الصيانة');
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $doc = JFactory::getDocument();
        $doc->setTitle('إدارة ورشة صيانة الحواسيب');

        $doc->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/datepicker/datepicker_dashboard/datepicker_dashboard.css');
        $doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Locale.ar-AA.DatePicker.js');
        $doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.js');
        $doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.Attach.js');
        $doc->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.Date.js');
        $doc->addScriptDeclaration("
		window.addEvent('domready', function(){
			Locale.use('ar-AA');
			new Picker.Date($$('input[id=jform_filter_start]'), {
			    timePicker: false,
			    positionOffset: {x: -10, y: 0},
			    pickerClass: 'datepicker_dashboard',
			    useFadeInOut: !Browser.ie ,
          format: '%Y-%m-%d'
			});
		});
        
        window.addEvent('domready', function(){
			Locale.use('ar-AA');
			new Picker.Date($$('input[id=jform_filter_end]'), {
			    timePicker: false,
			    positionOffset: {x: -10, y: 0},
			    pickerClass: 'datepicker_dashboard',
			    useFadeInOut: !Browser.ie ,
          format: '%Y-%m-%d'
			});
		});
		");
    }

}
