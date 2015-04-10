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
<div class="item">
	<a href="index.php?option=com_spdownload&amp;view=imagesList&amp;tmpl=component&amp;folder=<?php echo $this->_tmp_folder->path_relative; ?>&amp;asset=<?php echo JRequest::getCmd('asset');?>&amp;author=<?php echo JRequest::getCmd('author');?>">
		<?php echo JHTML::_('image','com_spdownload/folder.gif', $this->_tmp_folder->name, array('height' => 80, 'width' => 80), true); ?>
		<span><?php echo $this->_tmp_folder->name; ?></span></a>
</div>
