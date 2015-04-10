<?php
if ( !defined('ABSPATH')) exit;
global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$sulawesi = $nusantara_options['nusantara_homecelebes']['enabled'];
if ($sulawesi): foreach ($sulawesi as $celeb=>$nope) {
switch($celeb) {
case 
'nusantara_left_celebes': ?>
<section class="two celebes">
<?php get_sidebar(); ?>
</section >
<?php
         break;
         case 'nusantara_content_celebes':?>
<section class="eight"> 
<?php if (!empty($nusantara_options['nusantara_removal_slider']) == '1'){   		
	get_template_part( 'slide', 'index' );
}
			                              				
?>
     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                         <div class="clear"></div>
         <h2 class="title-excerpt"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php if (!empty($nusantara_options['nusantara_remove_celebesauthorinfo']) == '1'): ?>    
         <div class="postmeta">
             <div class="alignleft postmeta_links">
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
  
     <div class="alignright postcomments">
     <a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'nusantara'),__('One comment','nusantara'),__('% comments','nusantara')); ?></a>
     </div>
     </div> 
<?php endif; //end author info removal ?>               
                     <div class="entry clearfix">
                 <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
                 <?php nusantara_content_choices(); ?>
                     </div>                               
            </div>           
     <?php endwhile; ?>
                 <?php nusantara_content_nav();?>  
     <?php else : ?>
             <div class="entry">
                 <p>
                 <?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'nusantara'); ?>
                 </p>
             </div>    
     <?php endif; ?>
</section>

<?php
         break;
         case 'nusantara_right_celebes':?>
<section class="two celebes2">
<?php get_sidebar('ntt'); ?>
</section >
<?php
         break;
         case 'nusantara_footer_celebes':?>

<?php get_template_part( 'footer', 'content' ); ?>
<?php 
        break; 
        } 
 } 

endif; ?>
<?php get_footer(); ?>