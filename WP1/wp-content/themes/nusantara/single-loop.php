<?php 
if ( !defined('ABSPATH')) exit;
$nusantara_options = get_option('nusantara_options');
	if(isset($nusantara_options['nusantara_single_layout']))	
        {
	switch($nusantara_options['nusantara_single_layout']) {
        case "single post two column":
get_template_part( 'single', 'twocolumn' ); 
        break;
	case "single post three column":
get_template_part( 'single', 'threecolumn' ); 
        break;
	case "single post one column":
get_template_part( 'single', 'onecolumn' ); 
        break;           
        default:
get_template_part( 'single', 'twocolumn' ); 
        break;

		}
		
} 
else {
           get_template_part( 'single', 'twocolumn'  );  

          } 
?>


