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
$params = new JRegistry;
$dispatcher	= JDispatcher::getInstance();
$dispatcher->trigger('onContentBeforeDisplay', array('com_spdownload.file', &$this->_tmp_img, &$params));
?>
		<tr>
			<td>
				<a class="img-preview" href="<?php echo COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_img->path_relative; ?>" title="<?php echo $this->_tmp_img->name; ?>"><?php echo JHTML::_('image',COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_img->path_relative, JText::sprintf('COM_SPDOWNLOAD_IMAGE_TITLE', $this->_tmp_img->title, SPDownloadHelper::parseSize($this->_tmp_img->size)), array('width' => $this->_tmp_img->width_16, 'height' => $this->_tmp_img->height_16)); ?></a>
			</td>
			<td class="description">
				<a href="<?php echo  COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_img->path_relative; ?>" title="<?php echo $this->_tmp_img->name; ?>" rel="preview"><?php echo $this->escape($this->_tmp_img->title); ?></a>
			</td>
			<td>
				<?php echo JText::sprintf('COM_SPDOWNLOAD_IMAGE_DIMENSIONS', $this->_tmp_img->width, $this->_tmp_img->height); ?>
			</td>
			<td class="filesize">
				<?php echo SPDownloadHelper::parseSize($this->_tmp_img->size); ?>
			</td>
		<?php if ($user->authorise('core.delete','com_spdownload')):?>
			<td>
				<a class="delete-item" target="_top" href="index.php?option=com_spdownload&amp;task=file.delete&amp;tmpl=index&amp;<?php echo JUtility::getToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_img->name; ?>" rel="<?php echo $this->_tmp_img->name; ?>"><?php echo JHTML::_('image','com_spdownload/remove.png', JText::_('JACTION_DELETE'), array('width' => 16, 'height' => 16), true); ?></a>
				<input type="checkbox" name="rm[]" value="<?php echo $this->_tmp_img->name; ?>" />
			</td>
		<?php endif;?>
		</tr>
<?php
$dispatcher->trigger('onContentAfterDisplay', array('com_spdownload.file', &$this->_tmp_img, &$params));
?>
