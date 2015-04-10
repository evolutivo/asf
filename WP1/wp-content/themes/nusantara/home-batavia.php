<?php
if ( !defined('ABSPATH')) exit;
global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$batavia = $nusantara_options['homepage_blocks']['enabled'];
if ($batavia): foreach ($batavia as $central=>$v) {
switch($central) {
case 
'nusantara_block_area1': ?>
<div class="six">
<div class="batavia-slide">
<?php if (!empty($nusantara_options['nusantara_removal_slider']) == '1'){   		
	get_template_part( 'slide', 'index' );
}
else {
      get_template_part( '/sample/sample', 'slide' ); 
}				                              				
?>   
	                              				  				                
     </div>
 </div>
<div class="six">
     <div class="intro-home">
         <h2 class="centering"><?php             
      if ( isset($nusantara_options['nusantara_heading_intro']) and $nusantara_options['nusantara_heading_intro'] <> "" ) {
        echo  $nusantara_options['nusantara_heading_intro'];              
      } else {            
        echo 'Your welcome text here !';             
      }
             ?></h2>
<p class="centering">
         <?php              
  if ( isset($nusantara_options['nusantara_general_intro']) and $nusantara_options['nusantara_general_intro'] <> "" ) {
    echo  $nusantara_options['nusantara_general_intro'];
  } else {             
    echo 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna. Praesent sit amet ligula id orci venenatis auctor. Phasellus porttitor, metus non tincidunt dapibus, orci pede pretium neque.';
    
  }
             ?>
  </p>
<?php if (!empty($nusantara_options['nusantara_button']) == '1'): ?>
    <p class="centering">

             <?php 
      $nusantara_options = get_option('nusantara_options');      
      if (!empty($nusantara_options['nusantara_url_button']) and $nusantara_options['nusantara_text_button']) {
        echo '<a href="'.$nusantara_options['nusantara_url_button'].'" class="tombol butt">';
        echo $nusantara_options['nusantara_text_button'];
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
<?php
         break;
         case 'nusantara_big_heading':?>
<div class="intro-home2">     
 <?php             
                if ( isset($nusantara_options['nusantara_intro_two']) and $nusantara_options['nusantara_intro_two'] <> "" ) {
                  echo  $nusantara_options['nusantara_intro_two'];
                }else {             
    echo '<blockquote>';
    echo 'life is too short we dwell in the world with wonders surrounding us not knowing what is going to happen next, tomorrow, the next day just live by the day and take one day at a time expect unexpected and enjoy life to its fullest!';
    echo '</blockquote>';
    
    
  } 
         ?>  
</div>

<div class="clearfix"></div>
<?php
         break;
         case 'nusantara_aside_testimoni':?>

<?php if (!empty($nusantara_options['nusantara_removal_testimonial']) == '1'){   		
	get_template_part( 'testimonial', 'index' );
        get_template_part( 'imgland', 'index' );
}
else {
      get_template_part( '/sample/sample', 'testimonial' ); 
      get_template_part( '/sample/sample', 'imgaside' ); 
}				                              				
?>
			                              				       
    <?php
         break;
         case 'nusantara_one_column':?>
 
    <?php get_sidebar('1c'); ?>

    <?php 
         break; 
         case 'nusantara_two_column': ?>

    <?php get_sidebar('2c'); ?>
  
    <?php 
         break; 
         case 'nusantara_three_column': ?>

    <?php get_sidebar('3c'); ?>

    <?php 
         break; 
         case 'nusantara_four_column': ?>

    <?php get_sidebar('4c'); ?>
<?php
         break;
         case 'nusantara_footer_batavia':?>
   <?php get_template_part( 'footer', 'content' ); ?>
    <?php 
        break; 
        } 
 } 

endif; ?>
 
<div class="clearfix"></div> 
                                                       
                        <?php get_footer(); ?>