<?php
/*
 Plugin Name: Excel Interactive View Plugin
 Plugin URI: http://www.harrisonmgordon.com
 Description: Adds a shortcode so you can add the Excel Interactive View to tables in WordPress.
 Version: 0.4.1 BETA
 Author: Harrison M Gordon
 Author URI: http://www.harrisonmgordon.com
 */

/*
 Excel Interactive View (Wordpress Plugin)
 Copyright (C) 2012 Harrison M Gordon
 */
 
 add_action( 'init' , 'register_my_script' );
 add_action( 'wp_footer' , 'print_my_script' );
 
 function register_my_script()
 {
	wp_register_script( 'ExcelInteractiveView' , "http://r.office.microsoft.com/r/rlidExcelButton?v=1&kip=1", array() , "1.0" , true );
	wp_register_style( 'ExcelInteractiveViewButtonStyle' , plugins_url("css/ExcelInteractiveViewButton.css" , __FILE__ ) , array() , "1.0" , "all" );
 }
 
 function print_my_script()
 {
	global $add_ExcelInteractiveViewScript;
	
	if( !$add_ExcelInteractiveViewScript )
	{
		return;
	};
	
	wp_print_scripts( 'ExcelInteractiveView' );
	wp_print_styles( 'ExcelInteractiveViewButtonStyle' );
 }
 

//tell wordpress to register the demolistposts shortcode
add_shortcode( 'excel-interactive-view' , 'addExcelInteractiveView' );

function addExcelInteractiveView( $atts )
{
	global $add_ExcelInteractiveViewScript;
	
	$add_ExcelInteractiveViewScript = true;
	
	$attributes = shortcode_atts( array(
									'title' => '',
									'style' => 'Standard',
									'filename' => 'Book 1',
									'attribution' => '',
									'id' => '' ) , $atts );
	
	return '<a href="#" name="MicrosoftExcelButton" data-xl-tableTitle="' . $attributes['title'] . '" data-xl-buttonStyle="' . $attributes['style'] . '" data-xl-fileName="' . $attributes['filename'] . '" data-xl-attribution="' . $attributes['attribution'] . '" data-xl-dataTableID="' . $attributes['id'] . '" ></a>';

}
?>