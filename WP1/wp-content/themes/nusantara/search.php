<?php 
if ( !defined('ABSPATH')) exit;
get_header(); 
?>                  
<div class="row">
<?php
  global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$search_page = $nusantara_options['nusantara_search_page']['enabled'];
if ($search_page): foreach ($search_page as $cari=>$surabaya) {
switch($cari) {
case 
'nusantara_content_search': ?>
     <div class="excerpt">
     <h2 class="arh"><?php _e('Search results for ', 'nusantara'); echo get_search_query(); ?></h2>
<?php    
  if (!empty($nusantara_options['nusantara_ads_top_search'])and $nusantara_options['nusantara_ads_top_search'] <> '') {
    echo $nusantara_options['nusantara_ads_top_search'];
  }
                 ?>      
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         <div class="clear"></div>
         <h2 class="title-excerpt"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
         <div class="postmeta">
                 <div class="postmeta_links">
                 <?php
                  printf( __( '<span class="%1$s">Posted on</span> %2$s by %3$s', 'nusantara' ),'meta-prep meta-prep-author',
                          sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
                                   get_permalink(),
                                   esc_attr( get_the_time() ),
                                   get_the_date()
                                  ),
                          sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                                   get_author_posts_url( get_the_author_meta( 'ID' ) ),
                                   sprintf( esc_attr__( 'View all posts by %s', 'nusantara' ), get_the_author() ),
                                   get_the_author()
                                  )
                         );
				 ?>
                  </div>
         <div class="postcomments">
 <a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'nusantara'),__('One comment','nusantara'),__('% comments','nusantara')); ?></a>
         </div>
                      <div class="clear"></div>
         </div>        
         <div class="entry">
         <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
         <?php the_excerpt(); ?>
                     <div class="clearfix"></div>
         </div> 
         <div class="postinfo">
         <?php _e('Category: ', 'nusantara'); the_category(', ') ?> |
         <?php if (get_the_tags()) the_tags(__('Tags: ', 'nusantara'), ', '); ?>
         </div>                      
         </div>
                      
<?php endwhile; ?>
			

<div class="clear"></div>
<?php    
  if (!empty($nusantara_options['nusantara_ads_bottom_search'])and $nusantara_options['nusantara_ads_bottom_search'] <> '') {
    echo $nusantara_options['nusantara_ads_bottom_search'];
  }
                 ?>  

<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous alignleft"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Next', 'nusantara' )) ?></div>
					<div class="nav-next alignright"><?php previous_posts_link(__( 'Previous <span class="meta-nav">&raquo;</span>', 'nusantara' )) ?></div>
				</div>
<?php } ?>  
        
<?php else : ?>
         <div class="entry">
         <p>
         <?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'nusantara'); ?>
         </p>
         </div>      
<?php endif; ?>                                  
         </div>

<?php
         break;
         case 'nusantara_sidebar_search':?>
<section class="side-right"> 
<?php get_sidebar('1c'); ?>
</section>
<?php
         break;
         case 'nusantara_footer_search':?> 
<?php get_template_part( 'footer', 'content' ); ?>

<?php 
        break; 
        } 
 } 

endif; ?>
<?php get_footer(); ?>