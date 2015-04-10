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
<ul <?php echo $this->folders_id; ?>>
<?php foreach ($this->folders['children'] as $folder) : ?>
	<li id="<?php echo $folder['data']->relative; ?>"><a href="index.php?option=com_spdownload&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $folder['data']->relative; ?>" target="folderframe"><?php echo $folder['data']->name; ?></a><?php echo $this->getFolderLevel($folder); ?></li>        
<?php endforeach; ?>
</ul>
