<?php 
get_header();?>
<div class="row">
<?php
global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$n_page = $nusantara_options['nusantara_single_page']['enabled'];
if ($n_page): foreach ($n_page as $a_page=>$x_page) {
switch($a_page) {
case 
'nusantara_content_page': ?>
<section class="excerpt"> 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>   
         <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
             <div class="entry">
                 <?php if (!empty($nusantara_options['nusantara_remove_breadcrumb']) == '1'): ?>
                 <?php echo nusantara_breadcrumb(); ?>
                 <?php endif; ?>
             <h2 class="title-single"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                 <?php if (!empty($nusantara_options['nusantara_remove_authorinfo']) == '1'): ?>
                 <p class="post-info-single">
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
                 </p>
                 <?php endif; //end author info removal ?>
                 <?php    
  if (!empty($nusantara_options['nusantara_ads_top'])and $nusantara_options['nusantara_ads_top'] <> '') {
    echo $nusantara_options['nusantara_ads_top'];
  }
                 ?>          
                 <?php the_content(); ?>
                     <div class="clearfix"></div>
<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'nusantara' ) . '</span>', 'after' => '</div>' ) ); ?>
                     <div class="clearfix"></div>
                 <?php    
          if (!empty($nusantara_options['nusantara_ads_bottom'])and $nusantara_options['nusantara_ads_bottom'] <> '') {
            echo $nusantara_options['nusantara_ads_bottom'];
          }
                 ?>
                 </div>
                     <div class="clearfix"></div>
    <div class="postinfo">        
                 <?php if (!empty($nusantara_options['nusantara_remove_category']) == '1'): ?>
                 <?php _e('Category: ', 'nusantara'); the_category(', ') ?>
                 <?php endif; ?>      
                 <?php if (!empty($nusantara_options['nusantara_remove_tags']) == '1'): ?>
                 <br/><?php if (get_the_tags()) the_tags(__('Tags: ', 'nusantara'), ', '); ?>
                 <?php endif; ?>
     </div>
     <div class="alignleft">
                 <?php if (!is_attachment()) {previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'nusantara' ) . '</span> %title' );} else {previous_image_link(array( 64, 64 ));}; ?>
     </div>
     <div class="alignright">
                 <?php if (!is_attachment()) {next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'nusantara' ) . '</span>' );} else { next_image_link(array( 64, 64 ));}; ?>
     </div>
                         <div class="clearfix"></div>
                 <?php     
                            if(isset($nusantara_options['nusantara_author_general_intro']) and $nusantara_options['nusantara_author_general_intro'] == '1') {
                              get_template_part( 'author', 'profile' );
                            }
                 ?>
  
</div>
  
<?php endwhile; ?>
     <?php comments_template('', true); ?>
                     <div class="clearfix"></div>
<?php else : ?>
     <div class="entry">
         <p><?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'nusantara'); ?></p>
     </div> 
<?php endif; ?> 
</section>
<?php
         break;
         case 'nusantara_sidebar_page':?>
<section class="side-right">
<?php get_sidebar('1c'); ?>
<?php get_sidebar('2c'); ?>
</section>
</div>
<?php
         break;
         case 'nusantara_footer_page':?> 
<?php get_template_part( 'footer', 'content' ); ?>
<?php 
        break; 
        } 
 } 

endif; ?>
<?php 
get_footer();?>