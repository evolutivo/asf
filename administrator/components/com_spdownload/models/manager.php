<?php
/**
 * @package		SP Download
 * @subpackage	Components
 * @copyright	SP CYEND - All rights reserved.
 * @author		SP CYEND
 * @link		http://www.cyend.com
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

/**
 * SPDownload Component Manager Model
 *
 * @package		Joomla.Administrator
 * @subpackage	com_spdownload
 * @since 1.5
 */
class SPDownloadModelManager extends JModel
{

	function getState($property = null, $default = null)
	{
		static $set;

		if (!$set) {
			$folder = JRequest::getVar('folder', '', '', 'path');
			$this->setState('folder', $folder);

			$fieldid = JRequest::getCmd('fieldid', '');
			$this->setState('field.id', $fieldid);

			$parent = str_replace("\\", "/", dirname($folder));
			$parent = ($parent == '.') ? null : $parent;
			$this->setState('parent', $parent);
			$set = true;
		}

		return parent::getState($property, $default);
	}

	/**
	 * Image Manager Popup
	 *
	 * @param string $listFolder The image directory to display
	 * @since 1.5
	 */
	function getFolderList($base = null)
	{
		// Get some paths from the request
		if (empty($base)) {
			$base = COM_SPDOWNLOAD_BASE;
		}

		// Get the list of folders
		jimport('joomla.filesystem.folder');
		$folders = JFolder::folders($base, '.', true, true);

		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_SPDOWNLOAD_INSERT_IMAGE'));

		// Build the array of select options for the folder list
		$options[] = JHtml::_('select.option', "","/");

		foreach ($folders as $folder)
		{
			$folder		= str_replace(COM_SPDOWNLOAD_BASE, "", $folder);
			$value		= substr($folder, 1);
			$text		= str_replace(DS, "/", $folder);
			$options[]	= JHtml::_('select.option', $value, $text);
		}

		// Sort the folder list array
		if (is_array($options)) {
			sort($options);
		}

		// Create the drop-down folder select list
		$asset = JRequest::getVar('asset');
		$author = JRequest::getVar('author');
		$list = JHtml::_('select.genericlist',  $options, 'folderlist', "class=\"inputbox\" size=\"1\" onchange=\"ImageManager.setFolder(this.options[this.selectedIndex].value,'".$asset."','$author'".")\" ", 'value', 'text', $base);

		return $list;
	}

	function getFolderTree($base = null)
	{
		// Get some paths from the request
		if (empty($base)) {
			$base = COM_SPDOWNLOAD_BASE;
		}

		$spdownloadBase = str_replace(DS, '/', COM_SPDOWNLOAD_BASE.'/');

		// Get the list of folders
		jimport('joomla.filesystem.folder');
		$folders = JFolder::folders($base, '.', true, true);

		$tree = array();

		foreach ($folders as $folder)
		{
			$folder		= str_replace(DS, '/', $folder);
			$name		= substr($folder, strrpos($folder, '/') + 1);
			$relative	= str_replace($spdownloadBase, '', $folder);
			$absolute	= $folder;
			$path		= explode('/', $relative);
			$node		= (object) array('name' => $name, 'relative' => $relative, 'absolute' => $absolute);

			$tmp = &$tree;
			for ($i=0,$n=count($path); $i<$n; $i++)
			{
				if (!isset($tmp['children'])) {
					$tmp['children'] = array();
				}

				if ($i == $n-1) {
					// We need to place the node
					$tmp['children'][$relative] = array('data' =>$node, 'children' => array());
					break;
				}

				if (array_key_exists($key = implode('/', array_slice($path, 0, $i+1)), $tmp['children'])) {
					$tmp = &$tmp['children'][$key];
				}
			}
		}
		$tree['data'] = (object) array('name' => JText::_('COM_SPDOWNLOAD_MEDIA'), 'relative' => '', 'absolute' => $base);

		return $tree;
	}
}
