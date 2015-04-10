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
		<div class="imgOutline">
			<div class="imgTotal">
				<div class="imgBorder center">
					<a class="img-preview" href="<?php echo COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_img->path_relative; ?>" title="<?php echo $this->_tmp_img->name; ?>" style="display: block; width: 100%; height: 100%">
						<?php echo JHTML::_('image',COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_img->path_relative, JText::sprintf('COM_SPDOWNLOAD_IMAGE_TITLE', $this->_tmp_img->title, SPDownloadHelper::parseSize($this->_tmp_img->size)), array('width' => $this->_tmp_img->width_60, 'height' => $this->_tmp_img->height_60)); ?>
					</a>
				</div>
			</div>
			<div class="controls">
			<?php if ($user->authorise('core.delete','com_spdownload')):?>
				<a class="delete-item" target="_top" href="index.php?option=com_spdownload&amp;task=file.delete&amp;tmpl=index&amp;<?php echo JUtility::getToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_img->name; ?>" rel="<?php echo $this->_tmp_img->name; ?>"><?php echo JHTML::_('image','com_spdownload/remove.png', JText::_('JACTION_DELETE'), array('width' => 16, 'height' => 16), true); ?></a>
				<input type="checkbox" name="rm[]" value="<?php echo $this->_tmp_img->name; ?>" />
			<?php endif;?>
			</div>
			<div class="imginfoBorder">
				<a href="<?php echo COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_img->path_relative; ?>" title="<?php echo $this->_tmp_img->name; ?>" class="preview"><?php echo $this->escape(substr($this->_tmp_img->title, 0, 10) . (strlen($this->_tmp_img->title) > 10 ? '...' : '')); ?></a>
			</div>
		</div>
<?php
$dispatcher->trigger('onContentAfterDisplay', array('com_spdownload.file', &$this->_tmp_img, &$params));
?>
