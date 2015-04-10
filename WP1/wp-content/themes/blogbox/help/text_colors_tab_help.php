<?php
/**
 * Contextual help file for text color tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
 
 $html = '';
 $html .= '<h2>'.__('Text Color Options','blogBox').'</h2>';
 $html .= '<p>'.__('You can change the text colors for your theme.','blogBox').'</p>'; 
 $html .= '<p>'.__('You can select the cell and then use the color wheel to pick a color.','blogBox').' '; 
 $html .= __('Select the dot on the circle and drag around the circle to get the major color you want.','blogBox').' '; 
 $html .= __(' Then drag the dot in the square to set the saturation.','blogBox').'</p>';
 $html .= '<p>'.__('You can also copy in hex color numbers from other cells.','blogBox').' '; 
 $html .= __(' When you copy in the hex color, hit your "Enter" key for the box to change color.','blogBox').'</p>';
 $html .= '<p>'.__('Make sure you "Save Settings" when you are done.','blogBox').'</p>';
 $html .= '<p>'.__('Note that if the entry is deleted and saved the default will be loaded.','blogBox').'</p>'; 
   
 return $html;
 
?>