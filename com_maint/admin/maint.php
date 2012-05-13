<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');



// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_maint')) 
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('MaintHelper', dirname(__FILE__) . DS . 'helper' . DS . 'maint.php');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by Maint
$controller = JController::getInstance('Maint');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
