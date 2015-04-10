<?php
/**
 * @package		SP Download
 * @subpackage	Components
 * @copyright	SP CYEND - All rights reserved.
 * @author		SP CYEND
 * @link		http://www.cyend.com
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// No direct access
defined('_JEXEC') or die;
$app	= JFactory::getApplication();
$style = $app->getUserStateFromRequest('spdownload.list.layout', 'layout', 'thumbs', 'word');
?>
<div id="submenu-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div class="submenu-box">
			<div class="submenu-pad">
				<ul id="submenu" class="spdownload">
					<li><a id="thumbs" onclick="MediaManager.setViewType('thumbs')" class="<?php echo ($style == "thumbs") ? 'active' : '';?>">
					<?php echo JText::_('COM_SPDOWNLOAD_THUMBNAIL_VIEW'); ?></a></li>
					<li><a id="details" onclick="MediaManager.setViewType('details')" class="<?php echo ($style == "details") ? 'active' : '';?>">
					<?php echo JText::_('COM_SPDOWNLOAD_DETAIL_VIEW'); ?></a></li>
				</ul>
				<div class="clr"></div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>