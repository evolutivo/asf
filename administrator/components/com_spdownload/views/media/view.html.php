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
class SPDownloadViewMedia extends JView
{
	function display($tpl = null)
	{
		$app	= JFactory::getApplication();
		$config = JComponentHelper::getParams('com_spdownload');
		
		$lang	= JFactory::getLanguage();

		$style = $app->getUserStateFromRequest('spdownload.list.layout', 'layout', 'thumbs', 'word');

		$document = JFactory::getDocument();
		$document->setBuffer($this->loadTemplate('navigation'), 'modules', 'submenu');

		JHtml::_('behavior.framework', true);

		JHTML::_('script','com_spdownload/mediamanager.js', true, true);
		JHTML::_('stylesheet','com_spdownload/mediamanager.css', array(), true);
		if ($lang->isRTL()) :
			JHTML::_('stylesheet','com_spdownload/mediamanager_rtl.css', array(), true);
		endif;

		JHtml::_('behavior.modal');
		$document->addScriptDeclaration("
		window.addEvent('domready', function() {
			document.preview = SqueezeBox;
		});");

		JHTML::_('script','system/mootree.js', true, true, false, false);
		JHTML::_('stylesheet','system/mootree.css', array(), true);	
		if ($lang->isRTL()) :
			JHTML::_('stylesheet','system/mootree_rtl.css', array(), true);
		endif;

		if ($config->get('enable_flash', 1)) {
			$fileTypes = $config->get('upload_extensions', 'bmp,gif,jpg,png,jpeg');
			$types = explode(',', $fileTypes);
			$displayTypes = '';		// this is what the user sees
			$filterTypes = '';		// this is what controls the logic
			$firstType = true;
			foreach($types AS $type) {
				if(!$firstType) {
					$displayTypes .= ', ';
					$filterTypes .= '; ';
				} else {
					$firstType = false;
				}
				$displayTypes .= '*.'.$type;
				$filterTypes .= '*.'.$type;
			}
			$typeString = '{ \''.JText::_('COM_SPDOWNLOAD_FILES','true').' ('.$displayTypes.')\': \''.$filterTypes.'\' }';

			JHtml::_('behavior.uploader', 'upload-flash',
				array(
					'onBeforeStart' => 'function(){ Uploader.setOptions({url: document.id(\'uploadForm\').action + \'&folder=\' + document.id(\'spdownloadmanager-form\').folder.value}); }',
					'onComplete' 	=> 'function(){ SPDownloadManager.refreshFrame(); }',
					'targetURL' 	=> '\\document.id(\'uploadForm\').action',
					'typeFilter' 	=> $typeString,
					'fileSizeMax'	=> (int) ($config->get('upload_maxsize',0) * 1024 * 1024),
				)
			);
		}

		if (DS == '\\')
		{
			$base = str_replace(DS,"\\\\",COM_SPDOWNLOAD_BASE);
		} else {
			$base = COM_SPDOWNLOAD_BASE;
		}

		$js = "
			var basepath = '".$base."';
			var viewstyle = '".$style."';
		" ;
		$document->addScriptDeclaration($js);

		/*
		 * Display form for FTP credentials?
		 * Don't set them here, as there are other functions called before this one if there is any file write operation
		 */
		jimport('joomla.client.helper');
		$ftp = !JClientHelper::hasCredentials('ftp');

		$session	= JFactory::getSession();
		$state		= $this->get('state');
		$this->assignRef('session', $session);
		$this->assignRef('config', $config);
		$this->assignRef('state', $state);
		$this->assign('require_ftp', $ftp);
		$this->assign('folders_id', ' id="spdownload-tree"');
		$this->assign('folders', $this->get('folderTree'));

		// Set the toolbar
		$this->addToolbar();

		parent::display($tpl);
		echo JHtml::_('behavior.keepalive');
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
		$user = JFactory::getUser();

		// Set the titlebar text
		JToolBarHelper::title(JText::_('COM_SPDOWNLOAD'), 'mediamanager.png');

		// Add a delete button
		if ($user->authorise('core.delete','com_spdownload'))
		{
			$title = JText::_('JTOOLBAR_DELETE');
			$dhtml = "<a href=\"#\" onclick=\"MediaManager.submit('folder.delete')\" class=\"toolbar\">
						<span class=\"icon-32-delete\" title=\"$title\"></span>
						$title</a>";
			$bar->appendButton('Custom', $dhtml, 'delete');
			JToolBarHelper::divider();
		}
		// Add a delete button
		if ($user->authorise('core.admin','com_spdownload'))
		{
			JToolBarHelper::preferences('com_spdownload', 450, 800, 'JToolbar_Options', '', 'window.location.reload()');
			JToolBarHelper::divider();
		}
		$bar=& JToolBar::getInstance( 'toolbar' );
                $bar->appendButton( 'Help', 'help', 'JTOOLBAR_HELP', 'http://cyend.com/extensions/extensions/components/documentation/48-user-guide-sp-download', 640, 480 );
	}

	function getFolderLevel($folder)
	{
		$this->folders_id = null;
		$txt = null;
		if (isset($folder['children']) && count($folder['children'])) {
			$tmp = $this->folders;
			$this->folders = $folder;
			$txt = $this->loadTemplate('folders');
			$this->folders = $tmp;
		}
		return $txt;
	}
}
