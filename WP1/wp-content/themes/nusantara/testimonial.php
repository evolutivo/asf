<?php
if ( !defined('ABSPATH')) exit;
global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$testimon = $nusantara_options['nusantara_testimonial']; ?>
<section class="nine">
         <div class="testimonial">
<h3 class="testimontitle"><strong><?php             
      if ( isset($nusantara_options['nusantara_heading_testimoni']) and $nusantara_options['nusantara_heading_testimoni'] <> "" ) {
        echo  $nusantara_options['nusantara_heading_testimoni'];              
      } 
             ?></strong></h3>
<div class="clear"></div>
<?php if($testimon) { 
   foreach ($testimon as $testimoni) { ?>
   <p class="thre"><img class="testimonimg" src="<?php echo esc_url( $testimoni['url']) ;?>" alt=""/></p>
   <blockquote class="nine"><?php echo $testimoni['description']; ?><br/><cite><a href="<?php echo $testimoni['link']; ?>"><?php echo $testimoni['title']; ?></a></cite></blockquote>
                <div class="clear"></div>

<?php }  }  ?>
         </div>            
</section>
