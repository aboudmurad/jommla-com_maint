<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the Maint Component
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
        $canDo = MaintHelper::getActions();
        $bar = JToolBar::getInstance('toolbar');

        JToolBarHelper::title(' الصيانة');
        
        $toolbar = JToolBar::getInstance('toolbar');
        
        JToolBarHelper::custom('maints.reports', 'icon-32-xml.png', '', 'التقارير', false, false);
        
        JToolBarHelper::customX('maints.show', 'preview', '', 'عرض');
        
        if ($canDo->get('core.delete')) {
            JToolBarHelper::deleteListX('', 'maints.delete');
        }
        
        if ($canDo->get('core.edit')) {
            JToolBarHelper::editListX('maint.edit');
        }
        
        if ($canDo->get('core.create')) {
            JToolBarHelper::addNewX('maint.add');
        }
        
        if ($canDo->get('core.admin'))
        {
            JToolBarHelper::divider();
            JToolBarHelper::custom('maints.money', 'money.png', '', 'التوريد', false, false);
            JToolBarHelper::preferences('com_maint');
        }
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
        $document->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/datepicker/datepicker_dashboard/datepicker_dashboard.css');
        $document->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Locale.ar-AA.DatePicker.js');
        $document->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.js');
        $document->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.Attach.js');
        $document->addScript(JURI::base(true) . '/components/com_maint/assets/js/datepicker/Picker.Date.js');
        $document->addScriptDeclaration("
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
