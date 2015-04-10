<?php
/*
Plugin Name: blogBox Social Links Widget
Plugin URI: http://demo1.kevinsspace.ca/
Description: A widget for the blogBox theme that displays the social links
Version: 1.0
Author: Kevin Archibald
Author URI: http://www.kevinsspace.ca/
License: GPLv3
 */
 
/**
 * Social links widget file
 *
 * This file is  widget that will load any links that have urls coded in the 
 * blogBox Options => General Tab
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

 // use widgets_init action hook to execute custom function
 add_action ( 'widgets_init','blogBox_social_links_register_widget' );

//register our widget 
 function blogBox_social_links_register_widget() {
 	register_widget ( 'blogBox_social_links_widget' );
 }
 
 //widget class
class blogBox_social_links_widget extends WP_Widget {

    //process the new widget
    function blogBox_social_links_widget() {
        $widget_ops = array( 
			'classname' => 'blogBox_social_links_widget_class', 
			'description' => __('Display social links','blogBox') 
			); 
        $this->WP_Widget( 'blogBox_social_links_widget', __('blogBox Social Links Widget','blog-Box'), $widget_ops );
    }
 	
 	// Form for widget setup
 	function form ( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : __('Social Links','blogBox');
		?>
			<p>Title :
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php	
	}
	
	//save the widget settings
	function update ( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		
		return $instance;
	}
	
	//display the widget
    function widget($args, $instance) {
    	global $blogBox_option;
		$blogBox_option = blogBox_get_options(); 
     	extract ( $args);
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( !empty( $title )) { echo $before_title.$title.$after_title;}
		$html = '';
		$html .= '<div id="social_widget">';
		If(esc_url($blogBox_option['bB_header_rss']) !=="") $html .= '<a href="' . esc_url($blogBox_option['bB_header_rss']) . '"><img src="'. get_template_directory_uri() . '/images/rss.png" alt="RSS FEED" title="RSS FEED" /></a>';
		If(esc_url($blogBox_option['bB_header_linkedin']) !=="") $html .= '<a href="' . esc_url($blogBox_option['bB_header_linkedin']) . '"><img src="'. get_template_directory_uri() . '/images/linkedin.png" alt="Linkedin" title="Linkedin" /></a>';
		If(esc_url($blogBox_option['bB_header_twitter']) !=="") $html .= '<a href="' . esc_url($blogBox_option['bB_header_twitter']) . '"><img src="'. get_template_directory_uri() . '/images/twitter.png" alt="Twitter" title="Twitter" /></a>';
		If(esc_url($blogBox_option['bB_header_facebook']) !=="") $html .= '<a href="' . esc_url($blogBox_option['bB_header_facebook']) . '"><img src="'. get_template_directory_uri() . '/images/facebook.png" alt="Facebook" title="Facebook" /></a>';
		If(esc_url($blogBox_option['bB_header_delicious']) !=="") $html .= '<a href="' . esc_url($blogBox_option['bB_header_delicious']) . '"><img src="'. get_template_directory_uri() . '/images/delicious.png" alt="Delicious" title="Delicious" /></a>';
		If(esc_url($blogBox_option['bB_header_google_plus']) !=="") $html .= '<a href="' . esc_url($blogBox_option['bB_header_google_plus']) . '"><img src="'. get_template_directory_uri() . '/images/google.png" alt="Google+" title="Google+" /></a>';
		If(esc_url($blogBox_option['bB_header_digg']) !=="") $html .= '<a href="' . esc_url($blogBox_option['bB_header_digg']) . '"><img src="'. get_template_directory_uri() . '/images/digg.png" alt="Digg" title="Digg" /></a>';
		If(esc_url($blogBox_option['bB_header_pinterest']) !=="") $html .= '<a href="' . esc_url($blogBox_option['bB_header_pinterest']) . '"><img src="'. get_template_directory_uri() . '/images/pinterest.png" alt="Pinterest" title="Pinterest" /></a>';
		$html .= '</div>';
		
		echo $html;
		echo $after_widget; 
	}
}
?>