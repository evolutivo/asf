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
		<div class="imgOutline">
			<div class="imgTotal">
				<div align="center" class="imgBorder">
					<a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->_tmp_folder->path_relative; ?>" target="folderframe">
						<?php echo JHTML::_('image','com_spdownload/folder.png', JText::_('COM_SPDOWNLOAD_FOLDER'), array('width' => 80, 'height' => 80, 'border' => 0), true); ?></a>
				</div>
			</div>
			<div class="controls">
			<?php if ($user->authorise('core.delete','com_spdownload')):?>
				<a class="delete-item" target="_top" href="index.php?option=com_spdownload&amp;task=folder.delete&amp;tmpl=index&amp;<?php echo JUtility::getToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_folder->name; ?>" rel="<?php echo $this->_tmp_folder->name; ?> :: <?php echo $this->_tmp_folder->files+$this->_tmp_folder->folders; ?>"><?php echo JHTML::_('image','com_spdownload/remove.png', JText::_('JACTION_DELETE'), array('width' => 16, 'height' => 16, 'border' => 0), true); ?></a>
				<input type="checkbox" name="rm[]" value="<?php echo $this->_tmp_folder->name; ?>" />
			<?php endif;?>
			</div>
			<div class="imginfoBorder">
				<a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->_tmp_folder->path_relative; ?>" target="folderframe"><?php echo substr($this->_tmp_folder->name, 0, 10) . (strlen($this->_tmp_folder->name) > 10 ? '...' : ''); ?></a>
			</div>
		</div>
