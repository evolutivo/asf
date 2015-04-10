<?php if ( !defined('ABSPATH')) exit; ?>
 <div class="clearfix"></div>
 <?php $nusantara_options = get_option('nusantara_options'); ?>
 <?php if (!empty($nusantara_options['nusantara_remove_footer']) == '1'): ?>    
<section class="row below">
         
 <?php if (!dynamic_sidebar('footer left')) : ?>
<div class="thre">
             <div class="line-below">
             <h3><?php _e( 'Tag Cloud', 'nusantara' ); ?></h3>          
                <?php wp_tag_cloud(); ?>
                  
             </div>
              </div>    
<?php endif; ?>
             
         
<?php if (!dynamic_sidebar('footer midlle')) : ?>
<div class="thre">
             <div class="line-below">
             <h3><?php _e( 'Archives', 'nusantara' ); ?></h3>
             <ul>
             <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
             </ul>
             </div> </div>
<?php endif; ?>
            
         
<?php if (!dynamic_sidebar('footer right')) : ?>
<div class="thre">
         <div class="line-below">
             <h3><?php _e( 'Recent Post', 'nusantara' ); ?></h3>
             <ul>
			 <?php $archive_query = new WP_Query('posts_per_page=-5');
while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
     <li>
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'nusantara'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
     </li>
<?php endwhile; ?>
             </ul>  
      
         </div></div>
<?php endif; ?>  
         
         
<?php if (!dynamic_sidebar('footer right last')) : ?>
<div class="thre">
         <div class="line-below">
     <h3><?php _e( 'Meta', 'nusantara' ); ?></h3>
             <ul>
         <?php wp_register(); ?>
     <li> <?php wp_loginout(); ?> </li>
         <?php wp_meta(); ?>
             </ul>
         </div></div>
<?php endif; ?>  
         
                     <div class="clearfix"></div>
</section>
<?php endif; ?>