<?php
/**
 * Contextual help file for general tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('General Options','blogBox').'</h2>';
 $html .= '<p><strong>'.__('Email','blogBox').'</strong>'; 
 $html .= ' - '.__('"Settings" => "General" email is used if left blank.is used.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Favicon','blogBox').'</strong>';
 $html .= ' - '.__('You will need to create a favicon.ico image and place it in the theme root folder.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Captcha','blogBox').'</strong>';
 $html .= ' - '.__('If the Captcha is not working you need to disable it here.','blogBox').'</p>';
 $html .= '<h2>'.__('Header Options','blogBox').'</h2>';
 $html .= '<p><strong>'.__('Blog Description','blogBox').'</strong>';
 $html .= ' - '.__('This is the Tagline under "Settings" => "General"','blogBox').'</p>';
 $html .= '<h2>'.__('Footer Options','blogBox').'</h2>';
 $html .= '<p><strong>'.__('Copyright','blogBox').'</strong>';
 $html .= ' - '.__('The copyright section is a strip at the bottom of the footer that accepts html.','blogBox').' ';
 $html .= __('Typically the copyright notice is on the left, a developer credit in the middle, and a siteplan link is on the right.','blogBox').'</p>';
 $html .= '<h2>'.__('Social Options','blogBox').'</h2>';
 $html .= '<p><strong>'.__('Header Phone Number','blogBox').'</strong>';
 $html .= ' - '.__('You can input any text here, but it is designed to be a phone contact for your business.','blogBox').'</p>';
 $html .= '<p><strong>'.__('Social Links','blogBox').'</strong>';
 $html .= ' - '.__('If you do not want the link to show leave the field blank. Make sure you test the link to ensure it works.','blogBox').'</p>';
 
 return $html;
 
?>