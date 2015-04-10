<?php 
if ( !defined('ABSPATH')) exit;
$nusantara_options = get_option('nusantara_options');
	if(isset($nusantara_options['nusantara_layout_options']))	
        {
	switch($nusantara_options['nusantara_layout_options']) {
        case "batavia":
get_template_part( 'home', 'batavia' ); 
        break;
	case "java":
get_template_part( 'home', 'java' ); 
        break;
	case "andalas":
get_template_part( 'home', 'andalas' ); 
        break;      
        case "borneo":
get_template_part( 'home', 'borneo' ); 
        break;       
        case "papua":
get_template_part( 'home', 'papua' ); 
        break;
        case "celebes":
get_template_part( 'home', 'celebes' ); 
        break;
        default:
get_template_part( 'home', 'batavia' ); 
        break;

		}
		
} 
else {
           get_template_part( 'home', 'batavia' );  

          } 
?>


