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
		<tr>
			<td>
				<a  href="<?php echo COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_doc->path_relative; ?>" title="<?php echo $this->_tmp_doc->name; ?>">
					<?php  echo JHTML::_('image',$this->_tmp_doc->icon_16, $this->_tmp_doc->title, null, true, true) ? JHTML::_('image',$this->_tmp_doc->icon_16, $this->_tmp_doc->title, array('width' => 16, 'height' => 16), true) : JHTML::_('image','com_spdownload/con_info.png', $this->_tmp_doc->title, array('width' => 16, 'height' => 16), true);?> </a>
                                
			<td class="description"  title="<?php echo $this->_tmp_doc->name; ?>">
				<a href="<?php echo  COM_SPDOWNLOAD_BASEURL.'/'.$this->_tmp_doc->path_relative; ?>" title="<?php echo $this->_tmp_doc->name; ?>" rel="preview"><?php echo $this->escape($this->_tmp_doc->title); ?></a>
			</td>
			<td>&#160;

			</td>
			<td class="filesize">
				<?php echo SPDownloadHelper::parseSize($this->_tmp_doc->size); ?>
			</td>
		<?php if ($user->authorise('core.delete','com_spdownload')):?>
			<td>
				<a class="delete-item" target="_top" href="index.php?option=com_spdownload&amp;task=file.delete&amp;tmpl=index&amp;<?php echo JUtility::getToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_doc->name; ?>" rel="<?php echo $this->_tmp_doc->name; ?>"><?php echo JHTML::_('image','com_spdownload/remove.png', JText::_('Delete'), array('width' => 16, 'height' => 16, 'border' => 0), true);?></a>
				<input type="checkbox" name="rm[]" value="<?php echo $this->_tmp_doc->name; ?>" />
			</td>
		<?php endif;?>
		</tr>
<?php
$dispatcher->trigger('onContentAfterDisplay', array('com_spdownload.file', &$this->_tmp_doc, &$params));
?>
