<?php
if ( !defined('ABSPATH')) exit;
function nusantara_load_widgets() {
	register_widget("nusantara_widget_text");

}
add_action('widgets_init', 'nusantara_load_widgets');
