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

jimport('joomla.application.component.view');

/**
 * HTML View class for the SPDownload component
 *
 * @package		Joomla.Administrator
 * @subpackage	com_spdownload
 * @since 1.0
 */
class SPDownloadViewImagesList extends JView
{
	function display($tpl = null)
	{
		// Do not allow cache
		JResponse::allowCache(false);

		$app = JFactory::getApplication();

		$lang	= JFactory::getLanguage();

		JHTML::_('stylesheet','com_spdownload/popup-imagelist.css', array(), true);
		if ($lang->isRTL()) :
			JHTML::_('stylesheet','com_spdownload/popup-imagelist_rtl.css', array(), true);
		endif;

		$document = JFactory::getDocument();
		$document->addScriptDeclaration("var ImageManager = window.parent.ImageManager;");

		$images = $this->get('images');
                $documents = $this->get('documents');
		$folders = $this->get('folders');
		$state = $this->get('state');

		$this->assign('baseURL', COM_SPDOWNLOAD_BASEURL);
		$this->assignRef('images', $images);
                $this->assignRef('documents', $documents);
		$this->assignRef('folders', $folders);
		$this->assignRef('state', $state);

		parent::display($tpl);
	}


	function setFolder($index = 0)
	{
		if (isset($this->folders[$index])) {
			$this->_tmp_folder = &$this->folders[$index];
		} else {
			$this->_tmp_folder = new JObject;
		}
	}

	function setImage($index = 0)
	{
		if (isset($this->images[$index])) {
			$this->_tmp_img = &$this->images[$index];
		} else {
			$this->_tmp_img = new JObject;
		}
	}

        function setDocument($index = 0)
	{
		if (isset($this->documents[$index])) {
			$this->_tmp_doc = &$this->documents[$index];
		} else {
			$this->_tmp_doc = new JObject;
		}
	}
}
