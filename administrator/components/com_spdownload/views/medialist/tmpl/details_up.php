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
$user = JFactory::getUser();
?>
		<tr>
			<td class="imgTotal">
				<a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->state->parent; ?>" target="folderframe">
					<?php echo JHTML::_('image','com_spdownload/folderup_16.png', '..', array('width' => 16, 'height' => 16), true); ?></a>
			</td>
			<td class="description">
				<a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->state->parent; ?>" target="folderframe">..</a>
			</td>
			<td>&#160;</td>
			<td>&#160;</td>
		<?php if ($user->authorise('core.delete','com_spdownload')):?>
			<td>&#160;</td>
		<?php endif;?>
		</tr>
