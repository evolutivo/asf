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
<script type='text/javascript'>
var image_base_path = '<?php $params = JComponentHelper::getParams('com_spdownload');
echo $params->get('image_path', 'images');?>/';
</script>
<form action="index.php?option=com_spdownload&amp;asset=<?php echo JRequest::getCmd('asset');?>&amp;author=<?php echo JRequest::getCmd('author');?>" id="imageForm" method="post" enctype="multipart/form-data">
	<div id="messages" style="display: none;">
		<span id="message"></span><?php echo JHTML::_('image','com_spdownload/dots.gif', '...', array('width' =>22, 'height' => 12), true)?>
	</div>
	<fieldset>
		<div class="fltlft">
			<label for="folder"><?php echo JText::_('COM_SPDOWNLOAD_DIRECTORY') ?></label>
			<?php echo $this->folderList; ?>
			<button type="button" id="upbutton" title="<?php echo JText::_('COM_SPDOWNLOAD_DIRECTORY_UP') ?>"><?php echo JText::_('COM_SPDOWNLOAD_UP') ?></button>
		</div>
		<div class="fltrt">
			<button type="button" onclick="<?php if ($this->state->get('field.id')):?>window.parent.jInsertFieldValue(document.id('f_url').value,'<?php echo $this->state->get('field.id');?>');<?php else:?>ImageManager.onok();<?php endif;?>window.parent.SqueezeBox.close();"><?php echo JText::_('COM_SPDOWNLOAD_INSERT') ?></button>
			<button type="button" onclick="window.parent.SqueezeBox.close();"><?php echo JText::_('JCANCEL') ?></button>
		</div>
	</fieldset>

	<iframe id="imageframe" name="imageframe" src="index.php?option=com_spdownload&amp;view=imagesList&amp;tmpl=component&amp;folder=<?php echo $this->state->folder?>&amp;asset=<?php echo JRequest::getCmd('asset');?>&amp;author=<?php echo JRequest::getCmd('author');?>"></iframe>

	<fieldset>
		<table class="properties">
			<tr>
				<td><label for="f_url"><?php echo JText::_('COM_SPDOWNLOAD_IMAGE_URL') ?></label></td>
				<td><input type="text" id="f_url" value="" /></td>
				<?php if (!$this->state->get('field.id')):?>
					<td><label for="f_align"><?php echo JText::_('COM_SPDOWNLOAD_ALIGN') ?></label></td>
					<td>
						<select size="1" id="f_align" title="Positioning of this image">
							<option value="" selected="selected"><?php echo JText::_('COM_SPDOWNLOAD_NOT_SET') ?></option>
							<option value="left"><?php echo JText::_('JGLOBAL_LEFT') ?></option>
							<option value="right"><?php echo JText::_('JGLOBAL_RIGHT') ?></option>
						</select>
					</td>
					<td> <?php echo JText::_('COM_SPDOWNLOAD_ALIGN_DESC');?> </td>
				<?php endif;?>
			</tr>
			<?php if (!$this->state->get('field.id')):?>
				<tr>
					<td><label for="f_alt"><?php echo JText::_('COM_SPDOWNLOAD_IMAGE_DESCRIPTION') ?></label></td>
					<td><input type="text" id="f_alt" value="" /></td>
				</tr>
				<tr>
					<td><label for="f_title"><?php echo JText::_('COM_SPDOWNLOAD_TITLE') ?></label></td>
					<td><input type="text" id="f_title" value="" /></td>
					<td><label for="f_caption"><?php echo JText::_('COM_SPDOWNLOAD_CAPTION') ?></label></td>
					<td>
						<select size="1" id="f_caption" title="caption">
							<option value="" selected="selected" ><?php echo JText::_('JNO') ?></option>
							<option value="1"><?php echo JText::_('JYES') ?></option>
						</select>
					</td>
					<td> <?php echo JText::_('COM_SPDOWNLOAD_CAPTION_DESC');?> </td>
				</tr>
			<?php endif;?>
		</table>

                <input type="hidden" id="f_icon" name="f_icon" />
                <input type="hidden" id="f_name" name="f_name" />
                <input type="hidden" id="f_type" name="f_type" />
                <input type="hidden" id="dirPath" name="dirPath" />
		<input type="hidden" id="f_file" name="f_file" />
		<input type="hidden" id="tmpl" name="component" />

	</fieldset>
</form>

<?php if ($user->authorise('core.create', 'com_spdownload')): ?>
	<form action="<?php echo JURI::base(); ?>index.php?option=com_spdownload&amp;task=file.upload&amp;tmpl=component&amp;<?php echo $this->session->getName().'='.$this->session->getId(); ?>&amp;<?php echo JUtility::getToken();?>=1&amp;asset=<?php echo JRequest::getCmd('asset');?>&amp;author=<?php echo JRequest::getCmd('author');?>&amp;format=<?php echo $this->config->get('enable_flash')=='1' ? 'json' : '' ?>" id="uploadForm" name="uploadForm" method="post" enctype="multipart/form-data">
		<fieldset id="uploadform">
			<legend><?php echo $this->config->get('upload_maxsize')=='0' ? JText::_('COM_SPDOWNLOAD_UPLOAD_FILES_NOLIMIT') : JText::sprintf('COM_SPDOWNLOAD_UPLOAD_FILES', $this->config->get('upload_maxsize')); ?></legend>
			<fieldset id="upload-noflash" class="actions">
				<label for="upload-file" class="hidelabeltxt"><?php echo JText::_('COM_SPDOWNLOAD_UPLOAD_FILE'); ?></label>
				<input type="file" id="upload-file" name="Filedata" />
				<label for="upload-submit" class="hidelabeltxt"><?php echo JText::_('COM_SPDOWNLOAD_START_UPLOAD'); ?></label>
				<input type="submit" id="upload-submit" value="<?php echo JText::_('COM_SPDOWNLOAD_START_UPLOAD'); ?>"/>
			</fieldset>
			<div id="upload-flash" class="hide">
				<ul>
					<li><a href="#" id="upload-browse"><?php echo JText::_('COM_SPDOWNLOAD_BROWSE_FILES'); ?></a></li>
					<li><a href="#" id="upload-clear"><?php echo JText::_('COM_SPDOWNLOAD_CLEAR_LIST'); ?></a></li>
					<li><a href="#" id="upload-start"><?php echo JText::_('COM_SPDOWNLOAD_START_UPLOAD'); ?></a></li>
				</ul>
				<div class="clr"> </div>
				<p class="overall-title"></p>
				<?php echo JHTML::_('image','com_spdownload/bar.gif', JText::_('COM_SPDOWNLOAD_OVERALL_PROGRESS'), array('class' => 'progress overall-progress'), true); ?>
				<div class="clr"> </div>
				<p class="current-title"></p>
				<?php echo JHTML::_('image','com_spdownload/bar.gif', JText::_('COM_SPDOWNLOAD_CURRENT_PROGRESS'), array('class' => 'progress current-progress'), true); ?>
				<p class="current-text"></p>
			</div>
			<ul class="upload-queue" id="upload-queue">
				<li style="display: none"></li>
			</ul>
			<input type="hidden" name="return-url" value="<?php echo base64_encode('index.php?option=com_spdownload&view=images&tmpl=component&fieldid='.JRequest::getCmd('fieldid', '').'&e_name='.JRequest::getCmd('e_name').'&asset='.JRequest::getCmd('asset').'&author='.JRequest::getCmd('author')); ?>" />
		</fieldset>
	</form>
<?php  endif; ?>
