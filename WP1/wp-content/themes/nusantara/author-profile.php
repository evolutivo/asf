<?php if ( !defined('ABSPATH')) exit; ?>
<section id="authorarea">
  <?php echo get_avatar( get_the_author_meta('ID'), 90 ); ?>
    <div class="authorinfo">
        <h3><?php the_author(); ?></h3>
        <p><?php the_author_meta( 'description' ); ?></p>
          
     </div>
          <div class="clearfix"></div>
</section>