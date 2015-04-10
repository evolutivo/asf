<?php 
if ( !defined('ABSPATH')) exit;
function nusantara_include_jscript() {
$options = get_option('nusantara_options');	
  switch($options['nusantara_slider_mode']) {
case 'Fade effect':
$return = "<script type=\"text/javascript\">	
// Fade Slider 					
        var slider = {
        'effect':'fade',
        'delay':'7000',
        'duration':'600',
        'start':'1'};	
	</script>";

break;
case 'Slide effect':
$return = "<script type=\"text/javascript\">	
// Slide Slider
	var slider = {
        'effect':'slide',
        'delay':'7000',
        'duration':'600',
        'start':'1'};	
	</script>";

break;
		
default:
$return = "<script type=\"text/javascript\">	
// default Slider
	var slider = {
        'effect':'fade',
        'delay':'7000',
        'duration':'600',
        'start':'1'};	
	</script>";
break;							
		}
			
	echo $return;
	}
