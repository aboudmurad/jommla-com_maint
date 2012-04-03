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
