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
$dispatcher->trigger('onContentBeforeDisplay', array('com_spdownload.file', &$this->_tmp_doc, &$params));
?>
		<div class="imgOutline">
			<div class="imgTotal">
				<div align="center" class="imgBorder">
					<a href="<?php echo COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_doc->path_relative; ?>" title="<?php echo $this->_tmp_doc->name; ?>" style="display: block; width: 100%; height: 100%" title="<?php echo $this->_tmp_doc->name; ?>" >
						<?php echo JHTML::_('image',$this->_tmp_doc->icon_32, $this->_tmp_doc->name, null, true, true) ? JHTML::_('image',$this->_tmp_doc->icon_32, $this->_tmp_doc->title, NULL, true) : JHTML::_('image','com_spdownload/con_info.png', $this->_tmp_doc->name, NULL, true) ; ?></a>
				</div>
                        </div>
			<div class="controls">
			<?php if ($user->authorise('core.delete','com_spdownload')):?>
				<a class="delete-item" target="_top" href="index.php?option=com_spdownload&amp;task=file.delete&amp;tmpl=index&amp;<?php echo JUtility::getToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_doc->name; ?>" rel="<?php echo $this->_tmp_doc->name; ?>"><?php echo JHTML::_('image','com_spdownload/remove.png', JText::_('JACTION_DELETE'), array('width' => 16, 'height' => 16), true); ?></a>
				<input type="checkbox" name="rm[]" value="<?php echo $this->_tmp_doc->name; ?>" />
			<?php endif;?>
			</div>
			<div class="imginfoBorder" title="<?php echo $this->_tmp_doc->name; ?>" >
				<a href="<?php echo COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_doc->path_relative; ?>" title="<?php echo $this->_tmp_doc->name; ?>" class="preview"><?php echo $this->escape(substr($this->_tmp_doc->title, 0, 10) . (strlen($this->_tmp_doc->title) > 10 ? '...' : '')); ?></a>
			</div>
		</div>
<?php
$dispatcher->trigger('onContentAfterDisplay', array('com_spdownload.file', &$this->_tmp_doc, &$params));
?>
