<?php
/**
 * @package     Joomla.Platform
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Renders a popup window button
 *
 * @package     Joomla.Platform
 * @subpackage  HTML
 * @since       11.1
 */
class JButtonPrint extends JButton
{
	/**
	 * Button type
	 *
	 * @var    string
	 */
	protected $_name = 'Print';

	public function fetchButton($type='Print', $name = '', $url = '', $width=440, $height=600)
	{
	    
	    
	    $text   = $name;
	    $text	= JText::_($text);
	    $class	 = $this->fetchIconClass($name).'';
		$onClick = "window.open(this.href, 'popupwindow', 'width=$width,height=$height'); return false;";
		$html	 = "<a id=".$this->fetchId($type, $name)." onclick=\"$onClick\" href=\"$url\" >
		                <span class=\"$class\">
		                </span>
		                $text
		            </a>\n";

		return $html;
	}

	/**
	 * Get the button id
	 *
	 * Redefined from JButton class
	 *
	 * @param   string     $name	Button name
	 * @return  string	Button CSS Id
	 * @since       11.1
	 */
	public function fetchId($type, $name)
	{
		return $this->_parent->getName().'-'."print-$name";
	}
}
