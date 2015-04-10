<?php
if ( !defined('ABSPATH')) exit;
global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$imgtesti = $nusantara_options['nusantara_imgasidetestimonial']; ?>
<section class="thre">
      <?php if($imgtesti) { 
   foreach ($imgtesti as $imgtestimon) { ?>
   <p class="centering"><img class="regionimg" src="<?php echo esc_url( $imgtestimon['url']) ;?>" alt="<?php echo $imgtestimon['title']; ?>"/></p>
<?php }  }  ?>                                                                     
</section>
<div class="clear"></div>
