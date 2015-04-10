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
$params = new JRegistry;
$dispatcher	= JDispatcher::getInstance();
$dispatcher->trigger('onContentBeforeDisplay', array('com_spdownload.file', &$this->_tmp_img, &$params));
?>
		<div class="item">
			<a href="javascript:ImageManager.populateFields('<?php echo $this->_tmp_img->path_relative; ?>')" title="<?php echo $this->_tmp_img->name; ?>" >
				<?php echo JHTML::_('image',$this->baseURL.'/'.$this->_tmp_img->path_relative, JText::sprintf('COM_SPDOWNLOAD_IMAGE_TITLE', $this->_tmp_img->title, SPDownloadHelper::parseSize($this->_tmp_img->size)), array('width' => $this->_tmp_img->width_60, 'height' => $this->_tmp_img->height_60)); ?>
				<span title="<?php echo $this->_tmp_img->name; ?>"><?php echo $this->_tmp_img->title; ?></span></a>
		</div>
<?php
$dispatcher->trigger('onContentAfterDisplay', array('com_spdownload.file', &$this->_tmp_img, &$params));
?>
