<?php
/*
 * 
 * blogBox Theme Options
 *
 * This file defines the Options for the blogBox Theme.
 * 
 * Theme Options Functions
 * 
 *  - Define Default Theme Options
 *  - Register/Initialize Theme Options
 *  - Define Admin Settings Page
 *  - Register Contextual Help
 * 
 * @package 	blogBox
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		GNU General Public License, v3 (or newer) http://www.gnu.org/licenses/">http://www.gnu.org/licenses/ 
 *
 * 
 * blogBox Options has been set-up using  the tutorial by Chip Bennet
 * http://www.chipbennett.net/2011/02/17/incorporating-the-settings-api-in-wordpress-themes/
 * Followed the theme options settup in Oenology, a fabulous teaching theme by Chip Benett
 */

global $blogBox_options; // This is the array that holds all the options

function blogBox_enqueue_admin_style($hook) {// Enqueue Custom Admin Page Stylesheet
	//Only enqueue if the admin page is loaded
	 if( 'appearance_page_blogBox-settings' != $hook ) return;
	//Page is loaded so go ahead	
	wp_enqueue_style( 'blogBox_admin_stylesheet', get_template_directory_uri() . '/library/blogBox_options_css.css', '', false );
	wp_enqueue_script( 'blogBox_theme_settings_js', get_template_directory_uri() . '/library/blogBox_options_js.js', array('jquery'), '1', true );
	wp_enqueue_style('farbtastic');
	wp_enqueue_script('farbtastic');
	wp_enqueue_script('thickbox');  
    wp_enqueue_style('thickbox');  
    wp_enqueue_script('media-upload'); 

}
add_action( 'admin_enqueue_scripts', 'blogBox_enqueue_admin_style' );


/**
 * blogBox Theme Settings API Implementation
 *
 * Implement the WordPress Settings API for the 
 * blogBox Theme Settings.
 * 
 * @link	http://codex.wordpress.org/Settings_API	Codex Reference: Settings API
 * @link	http://ottopress.com/2009/wordpress-settings-api-tutorial/	Otto
 * @link	http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/	Ozh
 */
function blogBox_register_options(){//loads blogBox_options_register.php
	require( get_template_directory() . '/library/blogBox_options_register.php' );
}
add_action( 'admin_init', 'blogBox_register_options' );// Settings API options initilization and validation


/* Add "blogBox Options" link to the "Appearance" menu
  add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function ) function accepts five arguments:
    $page_title: the HTML page title
    $menu_title: the title displayed in the "Appearance" menu
    $capability: the appropriate user capability for access to the Settings page. Use edit_theme_options, not edit_themes
    $menu_slug: the slug added to the Settings page URL, i.e. "...themes.php?page=$menu_slug"
    $function: the callback function in which the Settings page markup is defined
 * 
 * */
function blogBox_add_theme_page() {
	global $blogBox_settings_page;
	$blogBox_settings_page= add_theme_page(__('blogBox Options','blogBox'), __('blogBox Options','blogBox'), 'edit_theme_options', 'blogBox-settings', 'blogBox_admin_options_page');
	add_action( 'load-' . $blogBox_settings_page, 'blogBox_settings_page_contextual_help' );
}
add_action('admin_menu', 'blogBox_add_theme_page');// Load the Admin Options page


/**
 * blogBox Theme Settings Page Markup
 * 
 * @uses	blogBox_get_current_tab()	defined in \functions\custom.php
 * @uses	blogBox_get_page_tab_markup()	defined in \functions\custom.php
 */
function blogBox_admin_options_page() { // Admin settings page markup
	// Determine the current page tab
	$currenttab = blogBox_get_current_tab();
	// Define the page section accordingly
	$settings_section = 'blogBox_' . $currenttab . '_tab';
	?>
	<div class="wrap blogBox_admin_<?php echo $currenttab; ?>">
		<?php blogBox_get_page_tab_markup(); ?>
		<form action="options.php" method="post">
		<?php
			if($currenttab == 'background_colors' || $currenttab == 'text_colors') echo '<div id="picker"></div>'; 
			// Implement settings field security, nonces, etc.
			settings_fields('theme_blogBox_options');
			// Output each settings section, and each
			// Settings field in each section
			do_settings_sections( $settings_section );
		?>
			<br/>
			<?php submit_button( __( 'Save Settings', 'blogBox' ), 'primary', 'theme_blogBox_options[submit-' . $currenttab . ']', false ); ?>
			<?php submit_button( __( 'Reset Defaults', 'blogBox' ), 'secondary', 'theme_blogBox_options[reset-' . $currenttab . ']', false ); ?>
		</form>
	</div>
<?php }


function blogBox_get_option_defaults() {
	// Get the array that holds all
	// Theme option parameters
	$blogBox_option_parameters = blogBox_get_option_parameters();
	// Initialize the array to hold
	// the default values for all
	// Theme options
	$blogBox_option_defaults = array();
	// Loop through the option
	// parameters array
	foreach ( $blogBox_option_parameters as $blogBox_option_parameter ) {
		$name = $blogBox_option_parameter['name'];
		// Add an associative array key
		// to the defaults array for each
		// option in the parameters array
		$blogBox_option_defaults[$name] = $blogBox_option_parameter['default'];
	}
	// Return the defaults array
	return $blogBox_option_defaults;
}


function blogBox_get_option_parameters() {
	
	$options = array (
/* ----------------------------- General Tab ------------------------------------ */
		'bB_show_blog_title' => array(
			'name' => 'bB_show_blog_title',
			'title' => __( 'Show Blog Title' , 'blogBox' ),
			'type' => 'checkbox',
			'description' => __('Check to show blog title in header','blogBox'),
			'section' =>'header',
			'tab' =>'general',
			'default' =>0, // 0 for off
			'class' => 'checkbox'
		),				
		'bB_show_blog_description' => array(
			'name' => 'bB_show_blog_description',
			'title' => __( 'Show Blog Description' , 'blogBox' ),
			'type' => 'checkbox',
			'description' => __('Check to show description under logo','blogBox'),
			'section' =>'header',
			'tab' =>'general',
			'default' =>0, // 0 for off
			'class' => 'checkbox'
		),
		'bB_show_social_strip' => array(
			'name' => 'bB_show_social_strip',
			'title' => __( 'Show Social Strip' , 'blogBox' ),
			'type' => 'checkbox',
			'description' => __('Check to show social strip in header','blogBox'),
			'section' =>'header',
			'tab' =>'general',
			'default' =>1, // 0 for off
			'class' => 'checkbox'
		),
		'bB_header_phone' => array(
			'name' => 'bB_header_phone',
			'title' => __('Header Phone Number','blogBox'),
			'type' => 'text',
			'description' => __('Enter your phone number if you want it in the header.','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'nohtml'
		),	
		'bB_header_facebook' => array(
			'name' => 'bB_header_facebook',
			'title' => __('Header Facebook URL','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://www.facebook.com/your_profile/','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'url'
		),	
		'bB_header_twitter' => array(
			'name' => 'bB_header_twitter',
			'title' => __('Header Twitter URL','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://twitter.com/your_twitter/','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'url'
		),						
		'bB_header_rss' => array(
			'name' => 'bB_header_rss',
			'title' => __('Header RSS URL','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://your.feed.url/feed/','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'url'
		),		
		'bB_header_linkedin' => array(
			'name' => 'bB_header_linkedin',
			'title' => __('Header Linkedin URL','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://ca.linkedin.com/profile link/','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'url'
		),		
		'bB_header_delicious' => array(
			'name' => 'bB_header_delicious',
			'title' => __('Header Delicious URL','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://www.delicious.com/save/','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'url'
		),		
		'bB_header_digg' => array(
			'name' => 'bB_header_digg',
			'title' => __('Header Digg URL','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://digg.com/user','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'url'
		),		
		'bB_header_pinterest' => array(
			'name' => 'bB_header_pinterest',
			'title' => __('Header Pinterest URL','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://pinterest.com/username/','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'url'
		),		
		'bB_header_google_plus' => array(
			'name' => 'bB_header_google_plus',
			'title' => __('Header Google Plus URL','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:https://plus.google.com/your_page_number/posts','blogBox'),
			'section' => 'social',
			'tab' => 'general',
			'default' => '',
			'class' => 'url'
		),
		'bB_left_copyright_text' => array(
			'name' => 'bB_left_copyright_text',
			'title' => __('Copyright left text','blogBox'),
			'type' => 'text',
			'description' => __('Some HTML allowed, suggest : &#38;copy; copyright &#60;a href="#"&#62;www.yoursite.url&#60;/a&#62;','blogBox'),
			'section' => 'footer',
			'tab' => 'general',
			'default' => '',
			'class' => 'html'
		),	
		'bB_middle_copyright_text' => array(
			'name' => 'bB_middle_copyright_text',
			'title' => __('Copyright middle text','blogBox'),
			'type' => 'text',
			'description' => __('Some HTML allowed, suggest : site by &#38;nbsp; &#60;a href="#"&#62;www.developer.url&#60;/a&#62;','blogBox'),
			'section' => 'footer',
			'tab' => 'general',
			'default' => '',
			'class' => 'html'
		),	
		'bB_right_copyright_text' => array(
			'name' => 'bB_right_copyright_text',
			'title' => __('Copyright right text','blogBox'),
			'type' => 'text',
			'description' => __('Some HTML allowed, suggest : &#60;a href="#"&#62;sitemap&#60;/a&#62;','blogBox'),
			'section' => 'footer',
			'tab' => 'general',
			'default' => '',
			'class' => 'html'
		),													
		'bB_contact_email' => array(
			'name' => 'bB_contact_email',
			'title' => __('Email address for contact page','blogBox'),
			'type' => 'text',
			'description' => __('Must be a valid email address.','blogBox'),
			'section' => 'general',
			'tab' => 'general',
			'default' => '',
			'class' => 'email'
		),	
		'bB_show_favicon' => array(
			'name' => 'bB_show_favicon',
			'title' => __('Show Favicon','blogBox'),
			'type' => 'checkbox',
			'description' => __('You must put favicon.ico in theme folder.','blogBox'),
			'section' => 'general',
			'tab' => 'general',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),	
		'bB_show_comment_captcha' => array(
			'name' => 'bB_show_comment_captcha',
			'title' => __('Include Captcha in Comments Form','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to include a captcha in your comments form.','blogBox'),
			'section' => 'general',
			'tab' => 'general',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),	
		'bB_show_contact_captcha' => array(
			'name' => 'bB_show_contact_captcha',
			'title' => __('Include Captcha in Contact Form','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to include a captcha in your contact form.','blogBox'),
			'section' => 'general',
			'tab' => 'general',
			'default' => 0,// 0 for off
			'class' => 'checkbox' 
		),
/* ---------------------------- Skins Tab ----------------------------------------- */					
		'bB_use_skin' => array(
			'name' => 'bB_use_skin',
			'title' => __('Use Skin For Colors','blogBox'),
			'type' => 'checkbox',
			'description' => __('Use a skin for background and text colors?','blogBox'),
			'section' => 'general',
			'tab' => 'skins',
			'default' => 0,// 0 for off
			'class' => 'checkbox' 
		),					
		'bB_select_skin' => array(
			'name' => 'bB_select_skin',
			'title' => __('Skin For Theme','blogBox'),
			'type' => 'select',
			'valid_options' => array( 
				'Blue',
				'Brown',
				'Dark Gray',
				'Gray',
				'White',
				'Wine'
			),
			'description' => __('Select a skin to use.','blogBox'),
			'section' => 'general',
			'tab' => 'skins',
			'default' => 'blue',
			'class' => 'select' 
		),
/* ----------------------- Background Colors Tab ---------------------------------*/											
		'bB_outside_background_color' => array(
			'name' => 'bB_outside_background_color',
			'title' => __('Outside Background Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #FFFFFF','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#FFFFFF',
			'class' => 'hexcolor'
		),
		'bB_select_gradient' => array(
			'name' => 'bB_select_gradient',
			'title' => __('Background Gradient','blogBox'),
			'type' => 'select',
			'valid_options' => array( 
				'No Gradient',
				'Dark Gradient',
				'Light Gradient'
			),
			'description' => __('Select a gradient','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => 'No Gradient',
			'class' => 'select' 
		),
		'bB_header_background_color' => array(
			'name' => 'bB_header_background_color',
			'title' => __('Header Background Color','blogBox'),
			'type' => 'text',
			'description' => __("default: #576C9C",'blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#576C9C',
			'class' => 'hexcolor'
		),												
		'bB_header_top_border_color' => array(
			'name' => 'bB_header_top_border_color',
			'title' => __('Header Top Border Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #091C47','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#091C47',
			'class' => 'hexcolor'
		),
		'bB_header_bottom_border_color' => array(
			'name' => 'bB_header_bottom_border_color',
			'title' => __('Header Bottom Border Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #091C47','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#091C47',
			'class' => 'hexcolor'
		),
		'bB_feature_area_background_color' => array(
			'name' => 'bB_feature_area_background_color',
			'title' => __('Feature Area Background Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),
		'bB_main_area_background_color' => array(
			'name' => 'bB_main_area_background_color',
			'title' => __('Main Area Background Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),
		'bB_home1_post_background_color' => array(
			'name' => 'bB_home1_post_background_color',
			'title' => __('Home Page Post Area Background Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),
		'bB_home1_slogan1_background_color' => array(
			'name' => 'bB_home1_slogan1_background_color',
			'title' => __('Home Page Slogan 1 Background Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #C6D8FF','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#C6D8FF',
			'class' => 'hexcolor'
		),
		'bB_home1_slogan2_background_color' => array(
			'name' => 'bB_home1_slogan2_background_color',
			'title' => __('Home Page Slogan 2 Background Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #C6D8FF','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#C6D8FF',
			'class' => 'hexcolor'
		),
		'bB_footer_background_color' => array(
			'name' => 'bB_footer_background_color',
			'title' => __('Footer Section Background Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #091C47','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#091C47',
			'class' => 'hexcolor'
		),	 
		'bB_copyright_background_color' => array(
			'name' => 'bB_copyright_background_color',
			'title' => __('Copyright Section Background Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #091C47','blogBox'),
			'section' => 'general',
			'tab' => 'background_colors',
			'default' => '#091C47',
			'class' => 'hexcolor'
		),
/* ------------------------------------- Text Colors Tab ---------------------------------------- */
		'bB_header_text_color' => array(
			'name' => 'bB_header_text_color',
			'title' => __('Header Text Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),	
		'bB_header_link_color' => array(
			'name' => 'bB_header_link_color',
			'title' => __('Header Link Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),
		'bB_header_hover_color' => array(
			'name' => 'bB_header_hover_color',
			'title' => __('Header Hover Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),
		'bB_feature_text_color' => array(
			'name' => 'bB_feature_text_color',
			'title' => __('Feature Text Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #091C47','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#091C47',
			'class' => 'hexcolor'
		),						
		'bB_main_text_color' => array(
			'name' => 'bB_main_text_color',
			'title' => __('Main Text Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #091C47','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#091C47',
			'class' => 'hexcolor'
		),
		'bB_main_link_color' => array(
			'name' => 'bB_main_link_color',
			'title' => __('Main Link Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #576C9C','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#576C9C',
			'class' => 'hexcolor'
		),
		'bB_main_hover_color' => array(
			'name' => 'bB_main_hover_color',
			'title' => __('Main Hover Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #8E7763','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#8E7763',
			'class' => 'hexcolor'
		),
		'bB_footer_text_color' => array(
			'name' => 'bB_footer_text_color',
			'title' => __('Footer Text Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),					  
		'bB_footer_link_color' => array(
			'name' => 'bB_footer_link_color',
			'title' => __('Footer Link Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #C6D8FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#C6D8FF',
			'class' => 'hexcolor'
		),			  
		'bB_footer_hover_color' => array(
			'name' => 'bB_footer_hover_color',
			'title' => __('Footer Hover Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),
		'bB_copyright_text_color' => array(
			'name' => 'bB_copyright_text_color',
			'title' => __('Copyright Text Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),		
		'bB_copyright_link_color' => array(
			'name' => 'bB_copyright_link_color',
			'title' => __('Copyright Link Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #C6D8FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#C6D8FF',
			'class' => 'hexcolor'
		),
		'bB_copyright_hover_color' => array(
			'name' => 'bB_copyright_hover_color',
			'title' => __('Copyright Hover Color','blogBox'),
			'type' => 'text',
			'description' => __('default: #F4F7FF','blogBox'),
			'section' => 'general',
			'tab' => 'text_colors',
			'default' => '#F4F7FF',
			'class' => 'hexcolor'
		),
/* --------------------- Fonts Tab -------------------------------------------*/
		'bB_header_font' => array(
			'name' => 'bB_header_font',
			'title' => __('Font for Headers','blogBox'),
			'type' => 'select',
			'valid_options' => array( 
				"Verdana, Geneva, sans-serif", 
				"Arial, Helvetica, sans-serif",
				"'Book Antiqua', 'Palatino Linotype', Palatino, serif",
				"Cambria, Georgia, serif",
				"'Comic Sans MS', sans-serif",
				"Georgia, serif",
				"Tahoma, Geneva, sans-serif",
				"'Times New Roman', Times, serif",
				"'Trebuchet MS', Helvetica, sans-serif"									
			),
			'description' => __('Select a font for headers (default: Verdana)','blogBox'),
			'section' => 'general',
			'tab' => 'fonts',
			'default' => 'Verdana, Geneva, sans-serif',
			'class' => 'select'
		), 			
		'bB_use_google_header' => array(
			'name' => 'bB_use_google_header',
			'title' => __('Use Google Header Font','blogBox'),
			'type' => 'checkbox',
			'description' => __('Use a Google Font for Headers?','blogBox'),
			'section' => 'general',
			'tab' => 'fonts',
			'default' => 0,// 0 for off
			'class' => 'checkbox' 
		),					
		'bB_google_header_font' => array(
			'name' => 'bB_google_header_font',
			'title' => __('Google Font for Headers','blogBox'),
			'type' => 'select',
			'valid_options' => array( 
				"'Allerta', Helvetica, Arial, sans-serif",
				"'Arvo', Georgia, Times, serif",
				"'Cabin', Helvetica, Arial, sans-serif",
				"'Corben', Georgia, Times, serif",
				"'Droid Sans', Helvetica, Arial, sans-serif",
				"'Droid Serif', Georgia, Times, serif",
				"'Lekton', Helvetica, Arial, sans-serif",
				"'Molengo', Georgia, Times, serif",
				"'Nobile', Helvetica, Arial, sans-serif",
				"'PT Sans', Helvetica, Arial, sans-serif",
				"'Raleway', Helvetica, Arial, sans-serif",
				"'Ubuntu', Helvetica, Arial, sans-serif",
				"'Vollkorn', Georgia, Times, serif"							
			),
			'description' => __('Select a Google font for headers (default: Droid Serif)','blogBox'),
			'section' => 'general',
			'tab' => 'fonts',
			'default' => "'Droid Serif', Georgia, Times, serif",
			'class' => 'select'
		), 			
		'bB_body_font' => array(
			'name' => 'bB_body_font',
			'title' => __('Font for Body Text','blogBox'),
			'type' => 'select',
			'valid_options' => array( 
				"'Book Antiqua', 'Palatino Linotype', Palatino, serif",
				"Arial, Helvetica, sans-serif",
				"Cambria, Georgia, serif",
				"'Comic Sans MS', sans-serif",
				"Georgia, serif",
				"Tahoma, Geneva, sans-serif",
				"'Times New Roman', Times, serif",
				"'Trebuchet MS', Helvetica, sans-serif",
				"Verdana, Geneva, sans-serif"								
			),
			'description' => __('Select a font for body text (default: Book Antiqua)','blogBox'),
			'section' => 'general',
			'tab' => 'fonts',
			'default' => "'Book Antiqua', 'Palatino Linotype', Palatino, serif",
			'class' => 'select'
		), 			
		'bB_use_google_body' => array(
			'name' => 'bB_use_google_body',
			'title' => __('Use Google Body Font','blogBox'),
			'type' => 'checkbox',
			'description' => __('Use a Google Font for Body Text?','blogBox'),
			'section' => 'general',
			'tab' => 'fonts',
			'default' => 0,// 0 for off
			'class' => 'checkbox' 
		),					
		'bB_google_body_font' => array(
			'name' => 'bB_google_body_font',
			'title' => __('Google Font for Body','blogBox'),
			'type' => 'select',
			'valid_options' => array( 
				"'Allerta', Helvetica, Arial, sans-serif",
				"'Arvo', Georgia, Times, serif",
				"'Cabin', Helvetica, Arial, sans-serif",
				"'Corben', Georgia, Times, serif",
				"'Droid Sans', Helvetica, Arial, sans-serif",
				"'Droid Serif', Georgia, Times, serif",
				"'Lekton', Helvetica, Arial, sans-serif",
				"'Molengo', Georgia, Times, serif",
				"'Nobile', Helvetica, Arial, sans-serif",
				"'PT Sans', Helvetica, Arial, sans-serif",
				"'Raleway', Helvetica, Arial, sans-serif",
				"'Ubuntu', Helvetica, Arial, sans-serif",
				"'Vollkorn', Georgia, Times, serif"							
			),
			'description' => __('Select a Google font for Body Text (default: Droid Sans)','blogBox'),
			'section' => 'general',
			'tab' => 'fonts',
			'default' => "'Droid Sans', Helvetica, Arial, sans-serif",
			'class' => 'select'
		), 			
/* ---------------------------- Static Home Page Options ----------------------------------- */
/* Feature */
		'bB_home1feature_options' => array(
			'name' => 'bB_home1feature_options',
			'title' => __('Home Page Feature Options','blogBox'),
			'type' => 'select',
			'valid_options' => array( 
				'Small slides and feature text box',
				'Full feature slides',
				'No feature'
			),
			'description' => __('Select the feature option','blogBox'),
			'section' => 'feature',
			'tab' => 'home',
			'default' => __('Small slides and feature text box','blogBox'),
			'class' => 'select' 
		),
		'bB_left_feature_title' => array(
			'name' => 'bB_left_feature_title',
			'title' => __('Feature Title','blogBox'),
			'type' => 'text',
			'description' => __('Enter a title for the Feature Text Box','blogBox'),
			'section' => 'feature',
			'tab' => 'home',
			'default' => 'Welcome to blogBox',
			'class' => 'nohtml'
		),
		'bB_left_feature_text' => array(
			'name' => 'bB_left_feature_text',
			'title' => __('Feature Text','blogBox'),
			'type' => 'textarea',
			'description' => __('Keep length less than 200 characters.','blogBox'),
			'section' => 'feature',
			'tab' => 'home',
			'default' => 'Use this box to set up the site with a mission statement, summary, or purpose.',
			'class' => 'textarea'
		),
		'bB_showfeaturepost' => array(
			'name' => 'bB_showfeaturepost',
			'title' => __('Show Feature Posts','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to include Feature Posts in Blog','blogBox'),
			'section' => 'feature',
			'tab' => 'home',
			'default' => 0,// 0 for off
			'class' => 'checkbox' 
		),
/* Section 1 */
		'bB_home1section1_onoroff' => array(
			'name' => 'bB_home1section1_onoroff',
			'title' => __('Enable Section 1','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to display Section 1','blogBox'),
			'section' => 'section_1',
			'tab' => 'home',
			'default' => 1,// 0 for off
			'class' => 'checkbox' 
		),
		'bB_home1section1_slogan' => array(
			'name' => 'bB_home1section1_slogan',
			'title' => __('Home Section 1 Slogan','blogBox'),
			'type' => 'text',
			'description' => __('Enter your text for your slogan.','blogBox'),
			'section' => 'section_1',
			'tab' => 'home',
			'default' => 'blogBox offers many features and options.',
			'class' => 'nohtml'
		),
		'bB_contact_link' => array(
			'name' => 'bB_contact_link',
			'title' => __('Contact Link','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://your.website.url/contact/','blogBox'),
			'section' => 'section_1',
			'tab' => 'home',
			'default' => '',
			'class' => 'url'
		),
/* Section 2 */
		'bB_home1section2_onoroff' => array(
			'name' => 'bB_home1section2_onoroff',
			'title' => __('Enable Section 2','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to display Section 2','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => 1,// 0 for off
			'class' => 'checkbox' 
		),
		'bB_home1service1_image' => array(
			'name' => 'bB_home1service1_image',
			'title' => __('Service Box 1 Image URL','blogBox'),
			'type' => 'text',
			'description' => '',
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'img'
		),
		'bB_home1service1_title' => array(
			'name' => 'bB_home1service1_title',
			'title' => __('Service Box 1 Title','blogBox'),
			'type' => 'text',
			'description' => __('Enter a title for Service Box 1','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'nohtml'
		),
		'bB_home1service1_link' => array(
			'name' => 'bB_home1service1_link',
			'title' => __('Service Box 1 Link','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://your.website.url/page/','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '#',
			'class' => 'url'
		),
		'bB_home1service1_text' => array(
			'name' => 'bB_home1service1_text',
			'title' => __('Service Box 1 Text','blogBox'),
			'type' => 'textarea',
			'description' => __('Enter text for your service box - html allowed','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'html'
		),
		'bB_home1service2_image' => array(
			'name' => 'bB_home1service2_image',
			'title' => __('Service Box 2 Image URL','blogBox'),
			'type' => 'text',
			'description' => '',
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'img'
		),
		'bB_home1service2_title' => array(
			'name' => 'bB_home1service2_title',
			'title' => __('Service Box 2 Title','blogBox'),
			'type' => 'text',
			'description' => __('Enter a title for Service Box 2','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'nohtml'
		),
		'bB_home1service2_link' => array(
			'name' => 'bB_home1service2_link',
			'title' => __('Service Box 2 Link','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://your.website.url/page/','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '#',
			'class' => 'url'
		),
		'bB_home1service2_text' => array(
			'name' => 'bB_home1service2_text',
			'title' => __('Service Box 2 Text','blogBox'),
			'type' => 'textarea',
			'description' => __('Enter text for your service box - html allowed','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'html'
		),
		'bB_home1service3_image' => array(
			'name' => 'bB_home1service3_image',
			'title' => __('Service Box 3 Image URL','blogBox'),
			'type' => 'text',
			'description' => '',
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'img'
		),
		'bB_home1service3_title' => array(
			'name' => 'bB_home1service3_title',
			'title' => __('Service Box 3 Title','blogBox'),
			'type' => 'text',
			'description' => __('Enter a title for Service Box 3','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'nohtml'
		),
		'bB_home1service3_link' => array(
			'name' => 'bB_home1service3_link',
			'title' => __('Service Box 3 Link','blogBox'),
			'type' => 'text',
			'description' => __('Suggested Format:http://your.website.url/page/','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '#',
			'class' => 'url'
		),
		'bB_home1service3_text' => array(
			'name' => 'bB_home1service3_text',
			'title' => __('Service Box 3 Text','blogBox'),
			'type' => 'textarea',
			'description' => __('Enter text for your service box - html allowed','blogBox'),
			'section' => 'section_2',
			'tab' => 'home',
			'default' => '',
			'class' => 'html'
		),
/* Section 3 */
		'bB_home1section3_onoroff' => array(
			'name' => 'bB_home1section3_onoroff',
			'title' => __('Enable Section 3','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to display Section 3','blogBox'),
			'section' => 'section_3',
			'tab' => 'home',
			'default' => 1,// 0 for off
			'class' => 'checkbox' 
		),
		'bB_home1section3_slogan' => array(
			'name' => 'bB_home1section3_slogan',
			'title' => __('Section 3 Slogan','blogBox'),
			'type' => 'text',
			'description' => __('Enter your text for your slogan','blogBox'),
			'section' => 'section_3',
			'tab' => 'home',
			'default' => 'blogBox allows you to have a small slider or large slider home page',
			'class' => 'nohtml'
		),
		'bB_home1section3_subslogan' => array(
			'name' => 'bB_home1section3_subslogan',
			'title' => __('Section 3 Sub Slogan','blogBox'),
			'type' => 'text',
			'description' => __('Enter your text for your slogan','blogBox'),
			'section' => 'section_3',
			'tab' => 'home',
			'default' => 'You can also have a static page with no slider, or a blog style home page',
			'class' => 'nohtml'
		),																								

/* --------------------------------------- Portfolio Pages Options --------------------------------- */
/* Portfolio A */
		'bB_portfolioA_cols' => array(
			'name' => 'bB_portfolioA_cols',
			'title' => __('Portfolio Columns','blogBox'),
			'type' => 'select',
			'valid_options' => array( "1", "2","3","4"),
			'description' => __('How many columns do you want?','blogBox'),
			'section' => 'portfolio_a',
			'tab' => 'portfolios',
			'default' => '1',
			'class' => 'select' 
		),						
		'bB_portfolioA_category' => array(
			'name' => 'bB_portfolioA_category',
			'title' => __('Portfolio Post Category','blogBox'),
			'type' => 'text',
			'description' => __('Enter Post Category for Portfolio A','blogBox'),
			'section' => 'portfolio_a',
			'tab' => 'portfolios',
			'default' => 'Portfolio A',
			'class' => 'nohtml'
		),			  
		'bB_portfolioA_content' => array(
			'name' => 'bB_portfolioA_content',
			'title' => __('Show Post Content','blogBox'),
			'type' => 'checkbox',
			'description' => __('note: content is always shown in 1 column portfolios.','blogBox'),
			'section' => 'portfolio_a',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),	
		'bB_portfolioA_feature_caption' => array(
			'name' => 'bB_portfolioA_feature_caption',
			'title' => __('Show Feature Image Caption','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image caption','blogBox'),
			'section' => 'portfolio_a',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
		'bB_portfolioA_feature_description' => array(
			'name' => 'bB_portfolioA_feature_description',
			'title' => __('Show Feature Image Description','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image description','blogBox'),
			'section' => 'portfolio_a',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),		
		'bB_showfeatureApost' => array(
			'name' => 'bB_showfeatureApost',
			'title' => __('Show Posts in Blog','blogBox'),
			'type' => 'checkbox',
			'description' => __('Include Portfolio A posts in blog?','blogBox'),
			'section' => 'portfolio_a',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
/* Portfolio B */		
		'bB_portfolioB_cols' => array(
			'name' => 'bB_portfolioB_cols',
			'title' => __('Portfolio Columns','blogBox'),
			'type' => 'select',
			'valid_options' => array( "1", "2","3","4"),
			'description' => __('How many columns do you want?','blogBox'),
			'section' => 'portfolio_b',
			'tab' => 'portfolios',
			'default' => '1',
			'class' => 'select' 
		),						
		'bB_portfolioB_category' => array(
			'name' => 'bB_portfolioB_category',
			'title' => __('Portfolio Post Category','blogBox'),
			'type' => 'text',
			'description' => __('Enter Post Category for Portfolio B','blogBox'),
			'section' => 'portfolio_b',
			'tab' => 'portfolios',
			'default' => 'Portfolio B',
			'class' => 'nohtml'
		),			  
		'bB_portfolioB_content' => array(
			'name' => 'bB_portfolioB_content',
			'title' => __('Show Post Content','blogBox'),
			'type' => 'checkbox',
			'description' => __('note: content is always shown in 1 column portfolios.','blogBox'),
			'section' => 'portfolio_b',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),	
		'bB_portfolioB_feature_caption' => array(
			'name' => 'bB_portfolioB_feature_caption',
			'title' => __('Show Feature Image Caption','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image caption','blogBox'),
			'section' => 'portfolio_b',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
		'bB_portfolioB_feature_description' => array(
			'name' => 'bB_portfolioB_feature_description',
			'title' => __('Show Feature Image Description','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image description','blogBox'),
			'section' => 'portfolio_b',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),		
		'bB_showfeatureBpost' => array(
			'name' => 'bB_showfeatureBpost',
			'title' => __('Show Posts in Blog','blogBox'),
			'type' => 'checkbox',
			'description' => __('Include Portfolio B posts in blog?','blogBox'),
			'section' => 'portfolio_b',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
/* Portfolio C */
		'bB_portfolioC_cols' => array(
			'name' => 'bB_portfolioC_cols',
			'title' => __('Portfolio Columns','blogBox'),
			'type' => 'select',
			'valid_options' => array( "1", "2","3","4"),
			'description' => __('How many columns do you want?','blogBox'),
			'section' => 'portfolio_c',
			'tab' => 'portfolios',
			'default' => '1',
			'class' => 'select' 
		),						
		'bB_portfolioC_category' => array(
			'name' => 'bB_portfolioC_category',
			'title' => __('Portfolio Post Category','blogBox'),
			'type' => 'text',
			'description' => __('Enter Post Category for Portfolio C','blogBox'),
			'section' => 'portfolio_c',
			'tab' => 'portfolios',
			'default' => 'Portfolio C',
			'class' => 'nohtml'
		),			  
		'bB_portfolioC_content' => array(
			'name' => 'bB_portfolioC_content',
			'title' => __('Show Post Content','blogBox'),
			'type' => 'checkbox',
			'description' => __('note: content is always shown in 1 column portfolios.','blogBox'),
			'section' => 'portfolio_c',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),	
		'bB_portfolioC_feature_caption' => array(
			'name' => 'bB_portfolioC_feature_caption',
			'title' => __('Show Feature Image Caption','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image caption','blogBox'),
			'section' => 'portfolio_c',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
		'bB_portfolioC_feature_description' => array(
			'name' => 'bB_portfolioC_feature_description',
			'title' => __('Show Feature Image Description','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image description','blogBox'),
			'section' => 'portfolio_c',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),		
		'bB_showfeatureCpost' => array(
			'name' => 'bB_showfeatureCpost',
			'title' => __('Show Posts in Blog','blogBox'),
			'type' => 'checkbox',
			'description' => __('Include Portfolio C posts in blog?','blogBox'),
			'section' => 'portfolio_c',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
/* Portfolio D */
		'bB_portfolioD_cols' => array(
			'name' => 'bB_portfolioD_cols',
			'title' => __('Portfolio Columns','blogBox'),
			'type' => 'select',
			'valid_options' => array( "1", "2","3","4"),
			'description' => __('How many columns do you want?','blogBox'),
			'section' => 'portfolio_d',
			'tab' => 'portfolios',
			'default' => '1',
			'class' => 'select' 
		),						
		'bB_portfolioD_category' => array(
			'name' => 'bB_portfolioD_category',
			'title' => __('Portfolio Post Category','blogBox'),
			'type' => 'text',
			'description' => __('Enter Post Category for Portfolio D','blogBox'),
			'section' => 'portfolio_d',
			'tab' => 'portfolios',
			'default' => 'Portfolio D',
			'class' => 'nohtml'
		),			  
		'bB_portfolioD_content' => array(
			'name' => 'bB_portfolioD_content',
			'title' => __('Show Post Content','blogBox'),
			'type' => 'checkbox',
			'description' => __('note: content is always shown in 1 column portfolios.','blogBox'),
			'section' => 'portfolio_d',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),	
		'bB_portfolioD_feature_caption' => array(
			'name' => 'bB_portfolioD_feature_caption',
			'title' => __('Show Feature Image Caption','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image caption','blogBox'),
			'section' => 'portfolio_d',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
		'bB_portfolioD_feature_description' => array(
			'name' => 'bB_portfolioD_feature_description',
			'title' => __('Show Feature Image Description','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image description','blogBox'),
			'section' => 'portfolio_d',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),		
		'bB_showfeatureDpost' => array(
			'name' => 'bB_showfeatureDpost',
			'title' => __('Show Posts in Blog','blogBox'),
			'type' => 'checkbox',
			'description' => __('Include Portfolio D posts in blog?','blogBox'),
			'section' => 'portfolio_d',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
/* Portfolio E */
		'bB_portfolioE_cols' => array(
			'name' => 'bB_portfolioE_cols',
			'title' => __('Portfolio Columns','blogBox'),
			'type' => 'select',
			'valid_options' => array( "1", "2","3","4"),
			'description' => __('How many columns do you want?','blogBox'),
			'section' => 'portfolio_e',
			'tab' => 'portfolios',
			'default' => '1',
			'class' => 'select' 
		),						
		'bB_portfolioE_category' => array(
			'name' => 'bB_portfolioE_category',
			'title' => __('Portfolio Post Category','blogBox'),
			'type' => 'text',
			'description' => __('Enter Post Category for Portfolio E','blogBox'),
			'section' => 'portfolio_e',
			'tab' => 'portfolios',
			'default' => 'Portfolio E',
			'class' => 'nohtml'
		),			  
		'bB_portfolioE_content' => array(
			'name' => 'bB_portfolioE_content',
			'title' => __('Show Post Content','blogBox'),
			'type' => 'checkbox',
			'description' => __('note: content is always shown in 1 column portfolios.','blogBox'),
			'section' => 'portfolio_e',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),	
		'bB_portfolioE_feature_caption' => array(
			'name' => 'bB_portfolioE_feature_caption',
			'title' => __('Show Feature Image Caption','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image caption','blogBox'),
			'section' => 'portfolio_e',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),
		'bB_portfolioE_feature_description' => array(
			'name' => 'bB_portfolioE_feature_description',
			'title' => __('Show Feature Image Description','blogBox'),
			'type' => 'checkbox',
			'description' => __('Check to show feature image description','blogBox'),
			'section' => 'portfolio_e',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		),		
		'bB_showfeatureEpost' => array(
			'name' => 'bB_showfeatureEpost',
			'title' => __('Show Posts in Blog','blogBox'),
			'type' => 'checkbox',
			'description' => __('Include Portfolio E posts in blog?','blogBox'),
			'section' => 'portfolio_e',
			'tab' => 'portfolios',
			'default' => 0, // 0 for off
			'class' => 'checkbox'
		)										

	 );
    return apply_filters( 'blogBox_get_option_parameters', $options );
}

function blogBox_get_options() {
	/**
	 * Get blogBox Theme Options
	 * 
	 * Array that holds all of the defined values
	 * for blogBox Theme options. If the user 
	 * has not specified a value for a given Theme 
	 * option, then the option's default value is
	 * used instead.
	 *
	 * @uses	blogBox_get_option_defaults()	defined in \functions\options.php
	 * 
	 * @uses	get_option()
	 * @uses	wp_parse_args()
	 * 
	 * @return	array	$blogBox_options	current values for all Theme options
	 */
	// Get the option defaults
	$blogBox_option_defaults = blogBox_get_option_defaults();
	// Globalize the variable that holds the Theme options
	global $blogBox_options;
	// Parse the stored options with the defaults
	$blogBox_options = wp_parse_args( get_option( 'theme_blogBox_options', array() ), $blogBox_option_defaults );
	//now lets check for a "" entry and put in the default if it is there
	//$blogBox_option_parameters = blogBox_get_option_parameters();
	//foreach( $blogBox_option_parameters as $blogBox_option_parameter ) {
		//$name = $blogBox_option_parameter['name'];
		//if ( $blogBox_options[$name] === '' ) $blogBox_options[$name] = $blogBox_option_parameter['default'];
	//}
	// Return the parsed array
	return $blogBox_options;
}


/**
 * Separate settings by tab
 * 
 * Returns an array of tabs, each of
 * which is an indexed array of settings
 * included with the specified tab.
 *
 * @uses	blogBox_get_option_parameters()	defined in \functions\options.php
 * @uses	blogBox_get_settings_page_tabs()	defined in \functions\options.php
 * 
 * @return	array	$settingsbytab	array of arrays of settings by tab
 */
function blogBox_get_settings_by_tab() {
	// Get the list of settings page tabs
	$tabs = blogBox_get_settings_page_tabs();
	// Initialize an array to hold
	// an indexed array of tabnames
	$settingsbytab = array();
	// Loop through the array of tabs
	foreach ( $tabs as $tab ) {
		$tabname = $tab['name'];
		// Add an indexed array key
		// to the settings-by-tab 
		// array for each tab name
		$settingsbytab[] = $tabname;
	}
	// Get the array of option parameters
	$option_parameters = blogBox_get_option_parameters();
	// Loop through the option parameters
	// array
	foreach ( $option_parameters as $option_parameter ) {
		$optiontab = $option_parameter['tab'];
		$optionname = $option_parameter['name'];
		// Add an indexed array key to the 
		// settings-by-tab array for each
		// setting associated with each tab
		$settingsbytab[$optiontab][] = $optionname;
		$settingsbytab['all'][] = $optionname;
	}
	// Return the settings-by-tab
	// array
	return $settingsbytab;
}


/**
 * blogBox Theme Admin Settings Page Tabs
 * 
 * Array that holds all of the tabs for the
 * blogBox Theme Settings Page. Each tab
 * key holds an array that defines the 
 * sections for each tab, including the
 * description text.
 * 
 * @return	array	$tabs	array of arrays of tab parameters
 */	
function blogBox_get_settings_page_tabs() {
	$tabs = array( 
        'general' => array(
			'name' => 'general',
			'title' => __( 'General', 'blogBox' ),
			'sections' => array(
				'general' => array(
					'name' => 'general',
					'title' => __( 'General Options', 'blogBox' ),
					'description' => ''
				),
				'header' => array(
					'name' => 'header',
					'title' => __( 'Header Options', 'blogBox' ),
					'description' => ''
				),
				'footer' => array(
					'name' => 'footer',
					'title' => __( 'Footer Options', 'blogBox' ),
					'description' => ''
				),
				'social' => array(
					'name' => 'social',
					'title' => __( 'Social Options', 'blogBox' ),
					'description' => ''
				)
			)
		),
        'skins' => array(
			'name' => 'skins',
			'title' => __( 'Skins', 'blogBox' ),
			'sections' => array(
				'skins' => array(
					'name' => 'general',
					'title' => __( 'Skin Options', 'blogBox' ),
					'description' => __( 'Instead of picking color options you can select a predefined skin.', 'blogBox' )
				)
			)
		),
        'background_colors' => array(
			'name' => 'background_colors',
			'title' => __( 'Background Colors', 'blogBox' ),
			'sections' => array(
				'background_colors' => array(
					'name' => 'general',
					'title' => __( 'Background Color Options', 'blogBox' ),
					'description' => __( 'Input a hex color number or use the color wheel.', 'blogBox' )
				)
			)
		),
		'text_colors' => array(
			'name' => 'text_colors',
			'title' => __( 'Text Colors', 'blogBox' ),
			'sections' => array(
				'text_colors' => array(
					'name' => 'general',
					'title' => __( 'Text Color Options', 'blogBox' ),
					'description' => __( 'Input a hex color number or use the color wheel.', 'blogBox' )
				)
			)
		),
		'fonts' => array(
			'name' => 'fonts',
			'title' => __( 'Fonts', 'blogBox' ),
			'sections' => array(
				'fonts' => array(
					'name' => 'general',
					'title' => __( 'Font Options', 'blogBox' ),
					'description' => __( 'You can use standard web fonts or a selection of Google fonts.', 'blogBox' )
				)
			)
		),
		'home' => array(
			'name' => 'home',
			'title' => __( 'Home Page', 'blogBox' ),
			'sections' => array(
				'feature' => array(
					'name' => 'feature',
					'title' => __( 'Feature Options', 'blogBox' ),
					'description' => __( 'These options set up the feature section right below the header section.', 'blogBox' )
				),
				'section_1' => array(
					'name' => 'section_1',
					'title' => __( 'Section 1 Options', 'blogBox' ),
					'description' => __( 'Section 1 contains a slogan and a contact button, and is located right under the Feature Section.', 'blogBox' )
				),
				'section_2' => array(
					'name' => 'section_2',
					'title' => __( 'Section 2 Options', 'blogBox' ),
					'description' => __( 'Section 2 contains 3 service boxes, and is located right under Section 1.', 'blogBox' )
				),
				'section_3' => array(
					'name' => 'section_3',
					'title' => __( 'Section 3 Options', 'blogBox' ),
					'description' => __( 'Section 3 contains a slogan and a sub slogan and is located right under Section 2.', 'blogBox' )
				)
			)
		),
		'portfolios' => array(
			'name' => 'portfolios',
			'title' => __( 'Portfolio Pages', 'blogBox' ),
			'sections' => array(
				'portfolio_a' => array(
					'name' => 'portfolio_a',
					'title' => __( 'Portfolio A Options', 'blogBox' ),
					'description' => ''
				),
				'portfolio_b' => array(
					'name' => 'portfolio_b',
					'title' => __( 'Portfolio B Options', 'blogBox' ),
					'description' => ''
				),
				'portfolio_c' => array(
					'name' => 'portfolio_c',
					'title' => __( 'Portfolio C Options', 'blogBox' ),
					'description' => ''
				),
				'portfolio_d' => array(
					'name' => 'portfolio_d',
					'title' => __( 'Portfolio D Options', 'blogBox' ),
					'description' => ''
				),
				'portfolio_e' => array(
					'name' => 'portfolio_e',
					'title' => __( 'Portfolio E Options', 'blogBox' ),
					'description' => ''
				)
			)
		)
    );
	return apply_filters( 'blogBox_get_settings_page_tabs', $tabs );
}
 
function blogBox_get_current_tab() {
	/**
	 * Get current settings page tab
	 */
	$page = 'blogBox-settings';
    if ( isset( $_GET['tab'] ) ) {
        $current = $_GET['tab'];
    } else {
		$current = 'general';
    }
	return $current;
}


/**
 * Define blogBox Admin Page Tab Markup
 * 
 * @uses	blogBox_get_current_tab()	defined in \functions\options.php
 * @uses	blogBox_get_settings_page_tabs()	defined in \functions\options.php
 * 
 * @link	http://www.onedesigns.com/tutorials/separate-multiple-theme-options-pages-using-tabs	Daniel Tara
 */
function blogBox_get_page_tab_markup() {
	$page = 'blogBox-settings';

    $current = blogBox_get_current_tab();
	
	$tabs = blogBox_get_settings_page_tabs();
    
    $links = array();
    
    foreach( $tabs as $tab ) {
		$tabname = $tab['name'];
		$tabtitle = $tab['title'];
        if ( $tabname == $current ) {
            $links[] = "<a class='nav-tab nav-tab-active' href='?page=$page&tab=$tabname'>$tabtitle</a>";
        } else {
            $links[] = "<a class='nav-tab' href='?page=$page&tab=$tabname'>$tabtitle</a>";
        }
    }
    
    echo '<div id="icon-themes" class="icon32"><br /></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $links as $link )
        echo $link;
    echo '</h2>';
    
}


/**
 * Settings Page Contextual Help
 * 
 * Contextual help, WordPress 3.3-compatible
 * 
 * This callback is hooked into the load-$blogBox_settings_page hook,
 * via the blogBox_add_theme_page() callback, which is hooked into the
 * admin_menu hook.
 * 
 * This callback works by calling the current screen object, via the WP_Screen() 
 * class via get_current_screen(), and then adding contextual help tabs to the 
 * screen object, via add_help_tab().
 * 
 * The add_help_tab() function is a member of the WP_Screen() class, and must be 
 * referenced from the class. The function accepts four arguments:
 *     add_help_tab( 
 *     		$id,		// string		(required) HTML ID attribute
 *     		$title,		// string		(required) Tab title
 *     		$content,	// string		(optional) Tab content
 *     		$callback	// callback		(optional) function that returns tab content
 *     )
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/add_help_tab				add_help_tab()
 * @link 		http://codex.wordpress.org/Function_Reference/get_current_screen		get_current_screen()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_directory	get_template_directory()
 * 
 * @link 		http://php.net/manual/en/function.file.php								file()
 * @link 		http://php.net/manual/en/function.implode.php							implode()
 * @link 		http://php.net/manual/en/function.include.php							include()
 */	
function blogBox_settings_page_contextual_help() {
	// Globalize settings page
	global $blogBox_settings_page;
	// Get the current screen object
	$screen = get_current_screen();
	// Ensure current page is blogBox settings page
	if ( $screen->id != $blogBox_settings_page ) {
		return;
	}
	// Add Settings - Varietals help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'blogBox-settings-general',
		// Tab Title
		'title'   => __( 'General', 'blogBox' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/general_tab_help.php' ) ,
	) );
	// Add Settings - Layout help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'blogBox-settings-skins',
		// Tab title
		'title'   => __( 'Skins', 'blogBox' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/skins_tab_help.php' ) ,
	) );
	// Add Settings - General help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'blogBox-settings-background-colors',
		// Tab Title
		'title'   => __( 'Background Colors', 'blogBox' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/background_colors_tab_help.php' ) ,
	) );
	// Add Theme Features help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'blogBox-settings-text-colors',
		// Tab title
		'title'   => __( 'Text Colors', 'blogBox' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/text_colors_tab_help.php' ) ,
	) );
	// Add FAQ Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'blogBox-settings-fonts',
		// Tab title
		'title'   => __( 'Fonts', 'blogBox' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/fonts_tab_help.php' ) ,
	) );
	// Add Code Ref Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'blogBox-settings-home',
		// Tab title
		'title'   => __( 'Home Page', 'blogBox' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/home_tab_help.php' ) ,
	) );
	// Add License Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'blogBox-settings-portfolios',
		// Tab title
		'title'   => __( 'Portfolio Pages', 'blogBox' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/portfolio_tab_help.php' ) ,
	) );
	// Add Support Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'blogBox-faq',
		// Tab title
		'title'   => __( 'blogBox Faq', 'blogBox' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/faq_tab_help.php' ) ,
	) );
}
?>