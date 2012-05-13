<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * MaintControllerMaint Controller
 */
class MaintControllerMaint extends JControllerForm {
    
  public function goPrint() {
      
  }
    
  public function getList() {

  }


  /**
   * Setting the toolbar
   */
  protected function addToolBar() {
    JToolBarHelper::title('ورشة الصيانة');

    JToolBarHelper::custom('maint.report', 'icon-32-xml.png', '', 'التقارير', false, false);
    JToolBarHelper::addNewX('maint.add');
  }

}
