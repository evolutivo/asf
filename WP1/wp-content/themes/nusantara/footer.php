<?php if ( !defined('ABSPATH')) exit; ?>
                     <div class="clearfix"></div>
     <footer class="row credit">
         <div id="socialmedia_icons">
<?php get_template_part( 'social', 'button' );?>                
         </div>        
         <div class="alignleft">
         <p class="brand-note">
<a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
<?php bloginfo('name'); ?></a> | <a href="<?php echo esc_url(__('http://amdhas.com','nusantara')); ?>" title="<?php esc_attr_e('nusantara', 'nusantara'); ?>"><?php  echo NUSANTARA_THEME; ?></a> <?php  _e( 'Proudly powered by', 'nusantara' ); ?>  <a href="<?php echo esc_url(__('http://wordpress.org','nusantara')); ?>" title="<?php esc_attr_e('WordPress', 'nusantara'); ?>"><?php printf('WordPress', 'nusantara'); ?></a>
</p>
         </div>
                     <div class="clearfix"></div>
     </footer>

</section>
<?php wp_footer(); ?>
</body>
</html>