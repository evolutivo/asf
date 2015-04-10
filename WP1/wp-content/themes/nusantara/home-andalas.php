<?php
if ( !defined('ABSPATH')) exit;
  global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$andalas = $nusantara_options['homepage_andalas']['enabled'];
if ($andalas): foreach ($andalas as $sumatra=>$aceh) {
switch($sumatra) {
case 
'nusantara_intro_andalas': ?>

<div class="row">

                     <div class='clear'></div>

    <div class="six"> 
 <?php if (!empty($nusantara_options['nusantara_removal_slider']) == '1'){   		
	get_template_part( 'slide', 'index' );
}
else {
      get_template_part( '/sample/sample', 'slide' ); 
}				                              				
?> 
    </div>


        <div class="six">
     <div class="intro-home">
         <h2 class="centering"><?php             
      if ( isset($nusantara_options['nusantara_heading_intro_andalas']) and $nusantara_options['nusantara_heading_intro_andalas'] <> "" ) {
        echo  $nusantara_options['nusantara_heading_intro_andalas'];              
      } else {            
        echo 'Welcome to nusantara theme';             
      }
             ?></h2>
         <?php              
  if ( isset($nusantara_options['nusantara_general_intro_andalas']) and $nusantara_options['nusantara_general_intro_andalas'] <> "" ) {
    echo  $nusantara_options['nusantara_general_intro_andalas'];
  } else {             
    echo '<p class="centering">';
    echo 'Nusantara Theme is designed for use by all WordPress user, whether newbie or a professional who wants the ease of customization without the need for coding expertise, elegant responsive design of its use and attractive. You can be free to be creative with 6 different homepage and try to customize the layout without having to open the theme file, reset button is also available if you want to go back to the default layout.';
    echo '</p>';
    
    
  }
             ?>
  
<?php if (!empty($nusantara_options['nusantara_button_andalas']) == '1'): ?>
    <p class="centering">

             <?php 
      $nusantara_options = get_option('nusantara_options');      
      if (!empty($nusantara_options['nusantara_url_button_andalas']) and $nusantara_options['nusantara_text_button_andalas']) {
        echo '<a href="'.$nusantara_options['nusantara_url_button_andalas'].'" class="tombol butt">';
        echo $nusantara_options['nusantara_text_button_andalas'];
        echo '</a>';
      } else {
        echo '<a href="#header" class="tombol butt">';
        echo __('Your button here','nusantara');
        echo '</a>';   
      }
             ?>  
<?php endif; ?>  
    </p>       
    </div>
    </div> 
                    
<div class="clear"></div>  
      
                     
         </div>
<?php
         break;
         case 'nusantara_content_andalas':?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
             <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<section class="home-grid">
             <div class="grid3">
     <h2 class="andalas-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>    
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
      
</section>
 <?php endwhile; ?>
                     <div class="clear"></div>
 <?php nusantara_content_nav();?>                                                                            
             </div>
            
<?php endif; ?>

<?php 
         break; 
         case 'nusantara_one_column_andalas': ?>

         <?php get_sidebar('1c'); ?>

<?php 
         break; 
         case 'nusantara_two_column_andalas': ?>

         <?php get_sidebar('2c'); ?>
<?php 
         break; 
         case 'nusantara_four_column_andalas': ?>

         <?php get_sidebar('4c'); ?>
                                      
                     <div class="clearfix"></div>

<?php 
         break; 
         case 'nusantara_andalas_footer': ?>
 <?php get_template_part( 'footer', 'content' ); ?>
<?php 
        break; 
        } 
 } 

endif; ?>
 <?php get_footer(); ?>  