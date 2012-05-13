<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the Maint Component
 */
class maintViewShow extends JView {

    // Overwriting JView display method
    function display($tpl = null) {
        $this->id    = JRequest::getInt('id');
        $this->order = $this->get('Order');
        $this->state = $this->get('State');
        
        $this->setLayout('popup');
        
        // Display the template
        parent::display($tpl);

        // Set the document
        $this->setDocument();
    }


    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $canDo = MaintHelper::getActions();
        $document = JFactory::getDocument();
        $document->setTitle('إدارة ورشة صيانة الحواسيب');
        JToolBarHelper::title(' الصيانة');
        $document->addStyleSheet(JURI::base(true)  . '/components/com_maint/assets/css/admin.css');
        JToolBarHelper::back('JTOOLBAR_BACK', 'index.php?option=com_maint');
        
        $bar = JToolBar::getInstance('toolbar');
        $bar->addButtonPath(JPATH_COMPONENT.'/button/');
        $bar->appendButton('Print', 'Print', 'index.php?option=com_maint&task=maints.pprint&id='.$this->id, false);
        
        if ($canDo->get('core.edit')) {
            JToolBarHelper::editList('maint.edit');
        }
        
        
    }

}
