<?php
/**
 * Contextual help file for home tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('Home Page Options','blogBox').'</h2>';
 $html .= '<p>'.__('There are quite a few options for the home page. Please refer to the user documentation.','blogBox').' ';
 $html .= __('The documentation takes you through setting up the home page step by step.','blogBox').'</p>';
 $html .= '<p>'.__('However there are a couple of points worth repeating:','blogBox').'</p>';
 $html .= '<p><strong>'.__('Small Slide Image Sizes','blogBox').'</strong>'; 
 $html .= ' - '.__('550 px wide by 275 px high','blogBox').'</p>';
 $html .= '<p><strong>'.__('Large Slide Image Sizes','blogBox').'</strong>'; 
 $html .= ' - '.__('850 px wide by 425 px high','blogBox').'</p>';
 $html .= '<p><strong>'.__('Service Box Image Sizes','blogBox').'</strong>'; 
 $html .= ' - '.__('250 px wide maximum by 100 px high maximum','blogBox').'</p>';
 $html .= '<p><strong>'.__('Service Box Links','blogBox').'</strong>'; 
 $html .= ' - '.__('The service box has been set up as a link itself so when you hover the entire box is shadowed.','blogBox').' ';
 $html .= __('It was designed this way to give the user the opportunity to put a link in regardless of which element is included in the box. ','blogBox').' ';
 $html .= __(' So if you have different content in each box, the hover highlight will be different. ','blogBox').' ';
 $html .= __('While not a big concern it is nice to have the highlighted areas the same. ','blogBox').' ';
 $html .= __('So if you add images, make them all the same size and include them for all service boxes. ','blogBox').' ';
 $html .= __('If you add a title keep it to one line, and include it for all service boxes. ','blogBox').' ';
 $html .= __('For the text section it is recommended to have the same number of lines in each service box. ','blogBox').' ';
 $html .= __('If you don\'t, just add blank lines using &lt;br/&gt;.','blogBox').'</p>';
 
 return $html;
 
?>