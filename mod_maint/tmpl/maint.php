<?php
/**
 * @version		$Id: login.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<p style="text-align: right;"><span style="font-size: 10pt;"><strong>ادخل رقم الفاتوره او رقم هاتفك هنا</strong></span></p>
<p style="text-align: right;"><span style="font-size: 10pt;"><strong><form method="post" action="<?php echo JRoute::_('index.php/component/maint/') ?>" />
<input type="hidden" value="com_maint" name="option" />
<input id="num" class="inputbox email" title="رقم التليفون او الفاتورة ..." name="num" value="" size="" maxlength="" type="text" />&nbsp;<input class="button" value="عرض" type="submit" /></fom></strong></span></p>
