<?php if ( !defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
     <meta charset="<?php bloginfo( 'charset' ); ?>" />
     <title><?php wp_title( '|', true, 'right' ); ?></title>
     <meta name="viewport" content="width=device-width" />
     <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />     
     <link rel="stylesheet" href="<?php 
	/**
	 * Return the URL for the default stylesheet
	 * 
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_stylesheet_uri get_stylesheet_uri}
	 * 
	 * Returns the value for the URI of the Theme default style sheet (style.css).
	 * 
	 * @param	null 
	 * @return	string	URL of default stylesheet
	 */
	echo get_stylesheet_uri(); 
	?>" type="text/css" media="all" />
     <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<section id="main-content">
                 <div class="row batas">

<section id="header">    
<?php
global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$li = $nusantara_options['nusantara_header_section']['enabled'];
if ($li): foreach ($li as $ki=>$vi) {
switch($ki) {
case 
'nusantara_header_area1': ?>
<?php if (!empty($nusantara_options['nusantara_remove_primarymenu'])== '1'): ?>
                        <?php           
                        wp_nav_menu(array('theme_location' => 'navi', 'container' => false, 'menu_id' => 'secondary', 'echo' => true, 'fallback_cb' => 'nusantara_default_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'depth' => 0));
?>
<?php endif; ?>
<?php 
break; 
case 
'nusantara_header_area2': ?>
 
  <div class="heading-menu">
    <div id="head">
<?php if ( get_header_image() != '' ) : ?>
         <div class="alignleft">
             <h1 class="site-title"><span><a href="<?php echo home_url( '/' ); ?>"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('description'); ?>" /></a></span></h1>
            
         </div>
<?php endif; ?>
<?php if ( !get_header_image() ) : ?>
         <div class="alignleft">
             <h1 class="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
             <p class="site-description">
<?php bloginfo( 'description' ); ?>
             </p>
        </div>                  
<?php endif; ?>
                          </div>
                         <div class="alignright">    
<?php $nusantara_options = get_option('nusantara_options'); ?>
<?php if (!empty($nusantara_options['nusantara_remove_searchform'])== '1'): ?>
<?php get_search_form(); ?>
<?php endif; ?>
                         </div>    
                 </div>  
                     <div class="clearfix"></div>

<?php 
break; 
case 
'nusantara_header_area3': ?>
<?php if (!empty($nusantara_options['nusantara_remove_secondarymenu'])== '1'): ?>
 <section class="second">
                         <?php           
                                      wp_nav_menu(array('theme_location' => 'secondary', 'container' => false, 'menu_id' => 'navmenu', 'echo' => true, 'fallback_cb' => 'nusantara_secondary_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'depth' => 0));
                                     ?>
   <div class="clearfix"></div>                 
</section>
<?php endif; ?>
<?php 
break; 
} } 

endif; ?>       
   <div class="clearfix"></div>

     </section>
                 </div>          