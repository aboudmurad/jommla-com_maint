<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the Maint Component
 */
class maintViewPprint extends JView {

    // Overwriting JView display method
    function display($tpl = null) {
        $this->id    = JRequest::getInt('id');
        $this->order = $this->get('Order');
        $this->state = $this->get('State');


        ob_end_clean();
        ob_start();
        include JPATH_COMPONENT.'/views/pprint/tmpl/default.php';
        $op = ob_get_contents();
        ob_end_clean();

        echo $op;
        exit();
    }
}
