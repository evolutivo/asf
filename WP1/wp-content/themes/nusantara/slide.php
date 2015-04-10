<?php
if ( !defined('ABSPATH')) exit;
global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$slides = $nusantara_options['nusantara_slider_effect']; ?>
<div class="responsive-slider flexslider">
<ul class="slides">
<?php if($slides) { 
   foreach ($slides as $slide) { ?>
<li>
<div class="slide">
<img src="<?php echo esc_url( $slide['url']) ;?>" class="slide-thumbnail"/>     
      <h2 class="slide-title"><a href="<?php echo $slide['link']; ?>"><?php echo $slide['title']; ?></a></h2>
      <h3 class="slide-des"><?php echo $slide['description']; ?></h3>
      </div>
</li>		
 <?php }  }  ?>
</ul>
</div>
	