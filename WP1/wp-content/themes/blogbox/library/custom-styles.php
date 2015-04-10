<?php
/**
 * Custom styles file
 *
 * This file is called by functions.php and loads the user selections for background and text colors
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php
/* Get the user choices for the theme options */
//$blogBox_option = blogBox_get_options();
?>
<?php

	define('BLOGBOX_THEME_CSS', get_template_directory_uri() . '/css' );
	$blogBox_option = blogBox_get_options();
	define('BLOGBOX_THEME_IMAGES', get_template_directory_uri() . '/images');

	if($blogBox_option['bB_use_skin'] && $blogBox_option['bB_use_skin'] == true){
		switch($blogBox_option['bB_select_skin']) {
			case "Blue" :
				function blogBox_blue_style () {
					wp_register_style( 'blogBox_blue_skin',BLOGBOX_THEME_CSS.'/blue_skin.css',array(),'20120527','all' );
					wp_enqueue_style('blogBox_blue_skin');
				}
				add_action('wp_print_styles','blogBox_blue_style',11);
				break;
			case "Brown" :
				function blogBox_brown_style () {
					wp_register_style( 'blogBox_brown_skin',BLOGBOX_THEME_CSS.'/brown_skin.css',array(),'20120527','all' );
					wp_enqueue_style('blogBox_brown_skin'); 
				}
				add_action('wp_print_styles','blogBox_brown_style',11);
				break;						
			case "Dark Gray" :
				function blogBox_dark_gray_style () {
					wp_register_style( 'blogBox_dark_gray_skin',BLOGBOX_THEME_CSS.'/dark_gray_skin.css',array(),'20120527','all' );
					wp_enqueue_style('blogBox_dark_gray_skin');
				}
				add_action('wp_print_styles','blogBox_dark_gray_style',11); 
				break;		
			case "Gray" :
				function blogBox_gray_style () {
					wp_register_style( 'blogBox_gray_skin',BLOGBOX_THEME_CSS.'/gray_skin.css',array(),'20120527','all' );
					wp_enqueue_style('blogBox_gray_skin');
				}
				add_action('wp_print_styles','blogBox_gray_style',11); 
				break;
			case "White" :
				function blogBox_white_style () {
					wp_register_style( 'blogBox_white_skin',BLOGBOX_THEME_CSS.'/white_skin.css',array(),'20120925','all' );
					wp_enqueue_style('blogBox_white_skin');
				}
				add_action('wp_print_styles','blogBox_white_style',11); 
				break;
			case "Wine" :
				function blogBox_wine_style () {
					wp_register_style( 'blogBox_wine_skin',BLOGBOX_THEME_CSS.'/wine_skin.css',array(),'20120527','all' );
					wp_enqueue_style('blogBox_wine_skin');
				}
				add_action('wp_print_styles','blogBox_wine_style',11); 
				break;												
		}
	}
	else {?>
		<style type="text/css" >
			body {
				background-color:<?php echo $blogBox_option['bB_outside_background_color']; ?>;
			<?php 
				if($blogBox_option['bB_select_gradient'] == "Dark Gradient") { 
					echo 'background-image: url('.BLOGBOX_THEME_IMAGES.'/bg1.png);';
					echo 'background-repeat: repeat-x;';
				} elseif($blogBox_option['bB_select_gradient'] == "Light Gradient") {
					echo 'background-image: url('.BLOGBOX_THEME_IMAGES.'/bg2.png);';
					echo 'background-repeat: repeat-x;';
				}	
			?>
			}
			#header {
				background-color: <?php echo $blogBox_option['bB_header_background_color']; ?>;
				border-top: 2px solid <?php echo $blogBox_option['bB_header_top_border_color']; ?>;
			}
			.main-nav {
				background-color: <?php echo $blogBox_option['bB_header_background_color']; ?>;
				border-bottom: 2px solid <?php echo $blogBox_option['bB_header_bottom_border_color']; ?>;
			}
			.main-nav ul a {color: <?php echo $blogBox_option['bB_header_link_color']; ?>;}
			.main-nav ul a:hover {font-weight: bold;color: <?php echo $blogBox_option['bB_header_hover_color']; ?>;}
			body #pagewrap {background-color: <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			#widecolumn {background-color: <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			#fullwidth {background-color: <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			#fullfeature{background-color: <?php echo $blogBox_option['bB_feature_area_background_color']; ?>;}
			#leftfeature{background-color: <?php echo $blogBox_option['bB_feature_area_background_color']; ?>;}
			#rightfeature{background-color: <?php echo $blogBox_option['bB_feature_area_background_color']; ?>;}
			#sidebar{background-color: <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			#home1post{background-color: <?php echo $blogBox_option['bB_home1_post_background_color']; ?>;}
			#slogan1, #homebuttonbox {background-color: <?php echo $blogBox_option['bB_home1_slogan1_background_color']; ?>;}
			#slogan2{background-color: <?php echo $blogBox_option['bB_home1_slogan2_background_color']; ?>;}
			#footer {background-color:<?php echo $blogBox_option['bB_footer_background_color']; ?>;}
			#copyright {background-color: <?php echo $blogBox_option['bB_copyright_background_color']; ?>;}
			#header {color:<?php echo $blogBox_option['bB_header_text_color']; ?>;}
			#leftfeature {color:<?php echo $blogBox_option['bB_feature_text_color']; ?>;}
			a:link, a:active, a:visited {color: <?php echo $blogBox_option['bB_main_link_color']; ?>;}
			a:hover { color: <?php echo $blogBox_option['bB_main_hover_color']; ?>;}
			body #pagewrap {color: <?php echo $blogBox_option['bB_main_text_color']; ?>;}
			#homesection2 h1 {color: <?php echo $blogBox_option['bB_main_text_color']; ?>;}
			#footer {color: <?php echo $blogBox_option['bB_footer_text_color']; ?>;}
			#footer a,#footer a:link {color: <?php echo $blogBox_option['bB_footer_link_color']; ?>;}
			#footer a:hover {color: <?php echo $blogBox_option['bB_footer_hover_color']; ?>;}
			#footer h1,#footer h2,#footer h3,#footer h4,#footer h5,#footer h6 {color: <?php echo $blogBox_option['bB_footer_text_color']; ?>;}
			#copyright {color: <?php echo $blogBox_option['bB_copyright_text_color']; ?>;}
			#copyright a{color: <?php echo $blogBox_option['bB_copyright_link_color']; ?>;}
			#copyright a:hover {color: <?php echo $blogBox_option['bB_copyright_hover_color']; ?>;}
			table#wp-calendar td#today {color: <?php echo $blogBox_option['bB_header_text_color']; ?>;}
			table#wp-calendar th {border: 1px solid <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			table#wp-calendar tbody td {border: 1px solid <?php echo $blogBox_option['bB_main_area_background_color']; ?>;}
			table#wp-calendar th {background-color: <?php echo $blogBox_option['bB_header_background_color']; ?>;}
			table#wp-calendar th {color: <?php echo $blogBox_option['bB_header_text_color']; ?>;}
		</style>
<?php }
?>