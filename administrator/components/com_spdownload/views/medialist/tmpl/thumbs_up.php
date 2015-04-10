<?php
/**
 * @package		SP Download
 * @subpackage	Components
 * @copyright	SP CYEND - All rights reserved.
 * @author		SP CYEND
 * @link		http://www.cyend.com
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// No direct access.
defined('_JEXEC') or die;
?>
		<div class="imgOutline">
			<div class="imgTotal">
				<div align="center" class="imgBorder">
					<a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->state->parent; ?>" target="folderframe">
						<?php echo JHTML::_('image','com_spdownload/folderup_32.png', '..', array('width' => 32, 'height' => 32), true); ?></a>
				</div>
			</div>
			<div class="controls">
				<span>&#160;</span>
			</div>
			<div class="imginfoBorder">
				<a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->state->parent; ?>" target="folderframe">..</a>
			</div>
		</div>
