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
				<a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->_tmp_folder->path_relative; ?>" target="folderframe">
					<?php echo JHTML::_('image','com_spdownload/folder_sm.png', $this->_tmp_folder->name, array('width' => 16, 'height' => 16), true); ?></a>
			</td>
			<td class="description">
				<a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->_tmp_folder->path_relative; ?>" target="folderframe"><?php echo $this->_tmp_folder->name; ?></a>
			</td>
			<td>&#160;

			</td>
			<td>&#160;

			</td>
		<?php if ($user->authorise('core.delete','com_spdownload')):?>
			<td>
				<a class="delete-item" target="_top" href="index.php?option=com_spdownload&amp;task=folder.delete&amp;tmpl=index&amp;folder=<?php echo $this->state->folder; ?>&amp;<?php echo JUtility::getToken(); ?>=1&amp;rm[]=<?php echo $this->_tmp_folder->name; ?>" rel="<?php echo $this->_tmp_folder->name; ?>' :: <?php echo $this->_tmp_folder->files+$this->_tmp_folder->folders; ?>"><?php echo JHTML::_('image','com_spdownload/remove.png', JText::_('Delete'), array('width' => 16, 'height' => 16), true); ?></a>
				<input type="checkbox" name="rm[]" value="<?php echo $this->_tmp_folder->name; ?>" />
			</td>
		<?php endif;?>
		</tr>
