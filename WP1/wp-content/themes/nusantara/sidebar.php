<?php if ( !defined('ABSPATH')) exit; ?>
<?php if (!dynamic_sidebar('one-column-left')) : ?>
<div class="line">
 <h3><?php _e( 'Archives', 'nusantara' ); ?></h3>
             <ul>
             <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
             </ul>
</div>
<?php endif; ?>