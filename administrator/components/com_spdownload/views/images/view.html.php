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
class SPDownloadViewImages extends JView
{
	function display($tpl = null)
	{
		$config = JComponentHelper::getParams('com_spdownload');
		$app	= JFactory::getApplication();
		$lang	= JFactory::getLanguage();
		$append = '';

		JHtml::_('behavior.framework', true);
		JHTML::_('script','com_spdownload/popup-imagemanager.js', true, true);
		JHTML::_('stylesheet','com_spdownload/popup-imagemanager.css', array(), true);

		if ($lang->isRTL()) {
			JHTML::_('stylesheet','com_spdownload/popup-imagemanager_rtl.css', array(), true);
		}

		if ($config->get('enable_flash', 1)) {
			//$fileTypes = $config->get('image_extensions', 'bmp,gif,jpg,png,jpeg');
                        $fileTypes = $config->get('upload_extensions', 'bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS');
			$types = explode(',', $fileTypes);
			$displayTypes = '';		// this is what the user sees
			$filterTypes = '';		// this is what controls the logic
			$firstType = true;

			foreach($types AS $type)
			{
				if(!$firstType) {
					$displayTypes .= ', ';
					$filterTypes .= '; ';
				}
				else {
					$firstType = false;
				}

				$displayTypes .= '*.'.$type;
				$filterTypes .= '*.'.$type;
			}
                        
			$typeString = '{ \''.JText::_('COM_SPDOWNLOAD_FILES','true').' ('.$displayTypes.')\': \''.$filterTypes.'\' }';

			JHtml::_('behavior.uploader', 'upload-flash',
				array(
					'onBeforeStart' => 'function(){ Uploader.setOptions({url: document.id(\'uploadForm\').action + \'&folder=\' + document.id(\'imageForm\').folderlist.value}); }',
					'onComplete' 	=> 'function(){ window.frames[\'imageframe\'].location.href = window.frames[\'imageframe\'].location.href; }',
					'targetURL' 	=> '\\document.id(\'uploadForm\').action',
					'typeFilter' 	=> $typeString,
					'fileSizeMax'	=> (int) ($config->get('upload_maxsize',0) * 1024 * 1024),
				)
			);
		}

		/*
		 * Display form for FTP credentials?
		 * Don't set them here, as there are other functions called before this one if there is any file write operation
		 */
		jimport('joomla.client.helper');
		$ftp = !JClientHelper::hasCredentials('ftp');

		$this->assignRef('session',	JFactory::getSession());
		$this->assignRef('config',		$config);
		$this->assignRef('state',		$this->get('state'));
		$this->assignRef('folderList',	$this->get('folderList'));
		$this->assign('require_ftp', $ftp);

		parent::display($tpl);
	}
}