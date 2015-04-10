<?php
/**
 * Contextual help file for fonts tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('Font Options','blogBox').'</h2>';
 $html .= '<p>'.__('blogBox allows the user to select different font styles for their websites.','blogBox').'</p>';
 $html .= '<p>'.__('You can pick fonts for Header Text and for Body Text.','blogBox').' ';
 $html .= __('In each group the user can either select from a standard font in the dropdown list or the user can use a Google Web font by clicking the checkbox and selecting a Google Web Font from a dropdown list.','blogBox').'</p>';
 $html .= '<p>'.__('Make sure you "Save Settings" when your finished.','blogBox').'</p>'; 
 return $html;
 
?>