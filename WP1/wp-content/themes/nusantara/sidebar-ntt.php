<?php if ( !defined('ABSPATH')) exit; ?>
<?php if (!dynamic_sidebar('one-column-right')) : ?>
 <div class="line">
            
 <h3><?php _e( 'Recent Post', 'nusantara' ); ?></h3>
             <ul>
			 <?php $archive_query = new WP_Query('posts_per_page=-5');
while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
     <li>
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'nusantara'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
     </li>
<?php endwhile; ?>
             </ul>  
</div>
<?php endif; ?>