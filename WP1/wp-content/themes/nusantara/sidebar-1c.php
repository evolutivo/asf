<?php if ( !defined('ABSPATH')) exit; ?>
<?php if (!dynamic_sidebar('one-column')) : ?>
<div class="line">
<h3><?php _e( 'Meta', 'nusantara' ); ?></h3>
             <ul>
         <?php wp_register(); ?>
     <li> <?php wp_loginout(); ?> </li>
         <?php wp_meta(); ?>
             </ul>
 
</div>
<?php endif; ?>
