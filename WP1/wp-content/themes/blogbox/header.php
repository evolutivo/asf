<?php    
/**
 * Header Template Part File
 * 
 * Template part file that contains the HTML document head and 
 * opening HTML body elements, as well as the site header.
 *
 * This file is called by all primary template pages
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset=<?php bloginfo('charset'); ?> />

<title><?php wp_title(''); ?></title>

<?php 
	global $blogBox_option;
	$blogBox_option = blogBox_get_options(); 
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if( isset($blogBox_option['bB_show_favicon']) && $blogBox_option['bB_show_favicon'] == 1 ) echo '<link rel="shortcut icon" href="'. get_template_directory_uri().'/favicon.ico" />'; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="pagewrap">
		<div id="header">
			
			<?php 
				if( function_exists( 'get_custom_header' ) ) {
					$header_image = get_header_image();
					If ( $header_image ) : ?>
						<div class="header_image">
							<a href="<?php echo site_url(); ?>/">
								<img class="logo" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="logo" />
							</a>
						</div>
					<?php endif; } ?>
					
					
			<span id="social-strip">
				<?php if( $blogBox_option['bB_show_social_strip'] ) { ?>
					<?php If(esc_url($blogBox_option['bB_header_rss']) !=="") echo '<a href="' . esc_url($blogBox_option['bB_header_rss']) . '"><img src="'. get_template_directory_uri() . '/images/rss.png" alt="RSS FEED" title="RSS FEED" /></a>'; ?>
					<?php If(esc_url($blogBox_option['bB_header_linkedin']) !=="") echo '<a href="' . esc_url($blogBox_option['bB_header_linkedin']) . '"><img src="'. get_template_directory_uri() . '/images/linkedin.png" alt="Linkedin" title="Linkedin" /></a>'; ?>
					<?php If(esc_url($blogBox_option['bB_header_twitter']) !=="") echo '<a href="' . esc_url($blogBox_option['bB_header_twitter']) . '"><img src="'. get_template_directory_uri() . '/images/twitter.png" alt="Twitter" title="Twitter" /></a>'; ?>
					<?php If(esc_url($blogBox_option['bB_header_facebook']) !=="") echo '<a href="' . esc_url($blogBox_option['bB_header_facebook']) . '"><img src="'. get_template_directory_uri() . '/images/facebook.png" alt="Facebook" title="Facebook" /></a>'; ?>
					<?php If(esc_url($blogBox_option['bB_header_delicious']) !=="") echo '<a href="' . esc_url($blogBox_option['bB_header_delicious']) . '"><img src="'. get_template_directory_uri() . '/images/delicious.png" alt="Delicious" title="Delicious" /></a>'; ?>
					<?php If(esc_url($blogBox_option['bB_header_google_plus']) !=="") echo '<a href="' . esc_url($blogBox_option['bB_header_google_plus']) . '"><img src="'. get_template_directory_uri() . '/images/google.png" alt="Google+" title="Google+" /></a>'; ?>
					<?php If(esc_url($blogBox_option['bB_header_digg']) !=="") echo '<a href="' . esc_url($blogBox_option['bB_header_digg']) . '"><img src="'. get_template_directory_uri() . '/images/digg.png" alt="Digg" title="Digg" /></a>'; ?>
					<?php If(esc_url($blogBox_option['bB_header_pinterest']) !=="") echo '<a href="' . esc_url($blogBox_option['bB_header_pinterest']) . '"><img src="'. get_template_directory_uri() . '/images/pinterest.png" alt="Pinterest" title="Pinterest" /></a>'; ?>
					<?php If(sanitize_text_field($blogBox_option['bB_header_phone']) !=="") echo '<span>'.stripslashes($blogBox_option['bB_header_phone']).'</span>'; ?>
				<?php } else { ?>
					<?php If(sanitize_text_field($blogBox_option['bB_header_phone']) !=="") echo '<span>'.stripslashes($blogBox_option['bB_header_phone']).'</span>'; ?>
				<?php } ?>
			</span>
			<?php 
				if ( $blogBox_option['bB_show_blog_title'] ) { 
					if ($header_image) { ?>
						<h1 class="blog_title"><?php bloginfo('name'); ?></h1> 
				<?php } else { ?>
						<h1 class="blog_title_no_logo"><?php bloginfo('name'); ?></h1> 
			<?php } } ?>
			<?php if( $blogBox_option['bB_show_blog_description'] ) { ?><span class="blog_description"><?php bloginfo('description'); ?></span> <?php } ?>
		</div>
			<?php
				if(has_nav_menu('primary-nav')){
					wp_nav_menu(
						array(
							'theme_location' => 'primary-nav',
							'container_class' => 'main-nav',
							'container_id' => 'main_menu',
							'menu_class' => 'sf-menu',
							'menu_id' => 'main_menu_ul',
							'fallback_cb' => 'wp_page_menu',
							'walker' => new blogBox_hermit_walker()
							)
					);
				} else {
					blogBox_fallback_menu();
				}
			?>
