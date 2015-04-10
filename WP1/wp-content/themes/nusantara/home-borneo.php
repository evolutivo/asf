<?php
if ( !defined('ABSPATH')) exit;
global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$borneo = $nusantara_options['homepage_borneo']['enabled'];
if ($borneo): foreach ($borneo as $mandau=>$batu) {
switch($mandau) {
case 
'nusantara_slider_borneo': ?>
<div class="clearfix"></div>
<?php if (!empty($nusantara_options['nusantara_removal_slider']) == '1'){   		
	get_template_part( 'slide', 'index' );
}			                              				
?> 
<?php
         break;
         case 'nusantara_borneo_content':?>   

<div class="row">			
<section class="eight">
              
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="six">   
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="grid3">
<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>		
           <?php if ( has_post_thumbnail() ) : ?>
        <p class="thumbnail-center">
<?php the_post_thumbnail('thumbnail', array('class' => 'thumb-medium')); ?>
         </p>
 <?php else : ?>
         <p class="thumbnail-center">
<img src="<?php echo get_template_directory_uri(); ?>/images/wp-badge.png" alt="<?php the_title_attribute(); ?>" class="thumb-medium"/>
          </p>
<?php endif; ?>
    <div class="postmeta">
        <div class="alignright postmeta_links">
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
    </div>

</div>
</section>
       
	 <?php endwhile; ?>
	  <?php nusantara_content_nav();?>	
            <div class="clear"></div>   
		           <?php endif; ?>

</section>
<section id="borneoside" class="four">
<?php get_sidebar('1c'); ?>	    
</section>		         
<?php 
         break; 
         case 'nusantara_two_borneo': ?>

    <?php get_sidebar('2c'); ?>

<?php 
         break; 
         case 'nusantara_three_borneo': ?>

    <?php get_sidebar('3c'); ?>

<?php 
         break; 
         case 'nusantara_four_borneo': ?>

    <?php get_sidebar('4c'); ?>

<?php
         break;
         case 'nusantara_footer_borneo':?>
   <?php get_template_part( 'footer', 'content' ); ?>
<?php 
        break; 
        } 
 } 

endif; ?>
                   <?php get_footer(); ?>	