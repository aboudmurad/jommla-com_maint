<?php
// No direct access to this file
defined('_JEXEC') or die;
 
/**
 * Maint component helper.
 */
abstract class MaintHelper
{
	/**
	 * Configure the Linkbar.
	 */
	/*public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_MAINT_SUBMENU_MESSAGES'),
		                         'index.php?option=com_maint', $submenu == 'messages');
		JSubMenuHelper::addEntry(JText::_('COM_MAINT_SUBMENU_CATEGORIES'),
		                         'index.php?option=com_categories&view=categories&extension=com_maint',
		                         $submenu == 'categories');
		// set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-maint ' .
		                               '{background-image: url(../media/com_maint/images/tux-48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_MAINT_ADMINISTRATION_CATEGORIES'));
		}
	}*/
	/**
	 * Get the actions
	 */
	public static function getActions($messageId = 0)
	{	
		jimport('joomla.access.access');
		$user	= JFactory::getUser();
		$result	= new JObject;
 
		if (empty($messageId)) {
			$assetName = 'com_maint';
		}
		else {
			$assetName = 'com_maint.message.'.(int) $messageId;
		}
 
		$actions = JAccess::getActions('com_maint', 'component');
 
		foreach ($actions as $action) {
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}
 
		return $result;
	}
}

