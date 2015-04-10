<?php
/**
 * @package		SP Download
 * @subpackage	Components
 * @copyright	SP CYEND - All rights reserved.
 * @author		SP CYEND
 * @link		http://www.cyend.com
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

// Access check.

$user = JFactory::getUser();
$asset = JRequest::getCmd('asset');
$author = JRequest::getCmd('author');
 
if (	!$user->authorise('core.manage', 'com_spdownload')
	&&	(!$asset or (
			!$user->authorise('core.edit', $asset)
		&&	!$user->authorise('core.create', $asset) 
		&& 	count($user->getAuthorisedCategories($asset, 'core.create')) == 0)
		&&	!($user->id==$author && $user->authorise('core.edit.own', $asset))))
{
	return JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
}

$params = JComponentHelper::getParams('com_spdownload');

// Load the admin HTML view
require_once JPATH_COMPONENT.'/helpers/spdownload.php';

// Set the path definitions
$popup_upload = JRequest::getCmd('pop_up',null);
$path = "file_path";

$view = JRequest::getCmd('view');
if (substr(strtolower($view),0,6) == "images" || $popup_upload == 1) {
	$path = "image_path";
}

define('COM_SPDOWNLOAD_BASE',	JPATH_ROOT.'/'.$params->get($path, 'images'));
define('COM_SPDOWNLOAD_BASEURL', JURI::root().$params->get($path, 'images'));

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JController::getInstance('SPDownload');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
