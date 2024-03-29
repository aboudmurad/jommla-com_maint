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

    public function fetchButton($type='Print', $name = '', $url = '', $width=400, $height=600)
    {
         
        $urlParts = explode('/', $url);
        $text  = $name;
        $text	 = JText::_($text);
        $class = $this->fetchIconClass($type).'';
        $onClick = "window.open(this.href+'&show=outrecit', 'popupwindow1', 'width=$width,height=$height,resizable=no');";
        $onClick .= "window.open(this.href, 'ppp123', 'width=$width,height=$height,resizable=no');";
        $onClick .= "return false;";
        $html	 = "<a id=".$this->fetchId($type, $urlParts[count($urlParts)-1])." onclick=\"$onClick\" href=\"$url\" >
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
