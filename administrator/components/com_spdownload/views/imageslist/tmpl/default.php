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
<?php if (count($this->images) > 0 || count($this->folders) > 0 || count($this->documents) > 0 ) { ?>
<div class="manager">
		<?php for ($i=0,$n=count($this->folders); $i<$n; $i++) :
			$this->setFolder($i);
			echo $this->loadTemplate('folder');
		endfor; ?>

		<?php for ($i=0,$n=count($this->images); $i<$n; $i++) :
			$this->setImage($i);
			echo $this->loadTemplate('image');
		endfor; ?>
                <?php for ($i=0,$n=count($this->documents); $i<$n; $i++) :
			$this->setDocument($i);
			echo $this->loadTemplate('document');
		endfor; ?>

</div>
<?php } else { ?>
	<div id="spdownload-noimages">
		<p><?php echo JText::_('COM_SPDOWNLOAD_NO_IMAGES_FOUND'); ?></p>
	</div>
<?php } ?>