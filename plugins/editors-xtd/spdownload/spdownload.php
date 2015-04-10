<?php
/**
 * @package		SP Download
 * @subpackage	Plugins
 * @copyright	SP CYEND - All rights reserved.
 * @author		SP CYEND
 * @link		http://www.cyend.com
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Editor Image buton
 *
 * @package Editors-xtd
 * @since 1.5
 */
class plgButtonSPDownload extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * Display the button
	 *
	 * @return array A two element array of (imageName, textToInsert)
	 */
	function onDisplay($name, $asset, $author)
	{
		$app = JFactory::getApplication();
		$params = JComponentHelper::getParams('com_spdownload');
 		$user = JFactory::getUser();
		if (	$user->authorise('core.edit', $asset)
			||	$user->authorise('core.create', $asset)
			||  count($user->getAuthorisedCategories($asset, 'core.create')) > 0
			|| ($user->authorise('core.edit.own', $asset) && $author == $user->id)) 
		{
			$link = 'index.php?option=com_spdownload&amp;view=images&amp;tmpl=component&amp;e_name=' . $name . '&amp;asset=' . $asset . '&amp;author=' . $author;
			JHtml::_('behavior.modal');
			$button = new JObject;
			$button->set('modal', true);
			$button->set('link', $link);
			$button->set('text', JText::_('PLG_SPDOWNLOAD_BUTTON_DOWNLOAD'));
			$button->set('name', 'image');
			$button->set('options', "{handler: 'iframe', size: {x: 800, y: 500}}");
			return $button;
		}
				else
		{
			return false;
		}
	}
}
