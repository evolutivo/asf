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

jimport('joomla.application.component.controller');

/**
 * SPDownload Manager Component Controller
 *
 * @package		Joomla.Administrator
 * @subpackage	com_spdownload
 * @version 1.5
 */
class SPDownloadController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		JPluginHelper::importPlugin('content');
		$vName = JRequest::getCmd('view', 'media');
		switch ($vName)
		{
			case 'images':
				$vLayout = JRequest::getCmd('layout', 'default');
				$mName = 'manager';

				break;

			case 'imagesList':
				$mName = 'list';
				$vLayout = JRequest::getCmd('layout', 'default');

				break;

			case 'mediaList':
				$app	= JFactory::getApplication();
				$mName = 'list';
				$vLayout = $app->getUserStateFromRequest('media.list.layout', 'layout', 'thumbs', 'word');

				break;

			case 'spdownload':
			default:
				$vName = 'media';
				$vLayout = JRequest::getCmd('layout', 'default');
				$mName = 'manager';
				break;
		}

		$document = JFactory::getDocument();
		$vType		= $document->getType();

		// Get/Create the view
		$view = $this->getView($vName, $vType);

		// Get/Create the model
		if ($model = $this->getModel($mName)) {
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}

		// Set the layout
		$view->setLayout($vLayout);

		// Display the view
		$view->display();

		return $this;
	}

	function ftpValidate()
	{
		// Set FTP credentials, if given
		jimport('joomla.client.helper');
		JClientHelper::setCredentialsFromRequest('ftp');
	}
}
