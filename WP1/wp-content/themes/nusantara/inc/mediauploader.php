<?php
     if ( !defined('ABSPATH')) exit;
	// -- Function Name : nusantara_mlu_init
	// -- Params : 
	// -- Purpose : 
	function nusantara_mlu_init () {
		register_post_type( 'options', array('labels' => array('name' => __( 'Options', 'nusantara'),),'public' => true,'show_ui' => false,'capability_type' => 'post','hierarchical' => false,'rewrite' => false,'supports' => array( 'title', 'editor' ), 'query_var' => false,'can_export' => true,'show_in_nav_menus' => false) );
	}

	add_filter( 'get_media_item_args', 'nusantara_force_send' );

	// -- Function Name : nusantara_force_send
	// -- Params : $args
	// -- Purpose : 
	function nusantara_force_send($args){
		$args['send'] = true;
		return $args;
	}

	

	// -- Function Name : nusantara_mlu_css
	// -- Params : 
	// -- Purpose : 
	function nusantara_mlu_css () {
		$_html = '';
		$_html .= '<link rel="stylesheet" href="' . get_option('siteurl') . '/' . WPINC . '/js/thickbox/thickbox.css" type="text/css" media="screen" />' . "\n";
		$_html .= '<script type="text/javascript">
		var tb_pathToImage = "' . get_option('siteurl') . '/' . WPINC . '/js/thickbox/loadingAnimation.gif";
	    var tb_closeImage = "' . get_option('siteurl') . '/' . WPINC . '/js/thickbox/tb-close.png";
	    </script>' . "\n";
		echo $_html;
	}

	// -- Registers and enqueues (loads) the necessary JavaScript file for working with the
	// -- Media Library-driven AJAX File Uploader Module.
	function nusantara_mlu_js () {
		// Registers custom scripts for the Media Library AJAX uploader.
		wp_register_script( 'medialibrary', NUSANTARA_DIR .'js/medialibrary.js', array( 'jquery', 'thickbox' ) );
		wp_enqueue_script( 'medialibrary' );
		wp_enqueue_script( 'media-upload' );
	}

	

	// -- Function Name : nusantara_mlu_get_silentpost
	// -- Params :  $_token 
	// -- Purpose : 
	function nusantara_mlu_get_silentpost ( $_token ) {
		global $wpdb;
		$_id = 0;
		// Check if the token is valid against a whitelist.
		// $_whitelist = array( 'nusantara_logo', 'nusantara_custom_favicon', 'nusantara_ad_top_image' );
		// Sanitise the token.
		$_token = strtolower( str_replace( ' ', '_', $_token ) );
		// if ( in_array( $_token, $_whitelist ) ) {
		
		if ( $_token ) {
			// Tell the function what to look for in a post.
			$_args = array( 'post_type' => 'options', 'post_name' => 'nusantara-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed' );
			// Look in the database for a "silent" post that meets our criteria.
			$query = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent = 0';
			foreach ( $_args as $k => $v ) {
				$query .= ' AND ' . $k . ' = "' . $v . '"';
			}

			// End FOREACH Loop
			$query .= ' LIMIT 1';
			$_posts = $wpdb->get_row( $query );
			// If we've got a post, loop through and get it's ID.
			
			if ( count( $_posts ) ) {
				$_id = $_posts->ID;
			} else {
				// If no post is present, insert one.
				// Prepare some additional data to go with the post insertion.
				$_words = explode( '_', $_token );
				$_title = join( ' ', $_words );
				$_title = ucwords( $_title );
				$_post_data = array( 'post_title' => $_title );
				$_post_data = array_merge( $_post_data, $_args );
				$_id = wp_insert_post( $_post_data );
			}

		}

		return $_id;
	}

	// -- Trigger code inside the Media Library popup.
	function nusantara_mlu_insidepopup () {
		
		if ( isset( $_REQUEST['is_nusantara'] ) && $_REQUEST['is_nusantara'] == 'yes' ) {
			add_action( 'nusantara_head', 'nusantara_mlu_js_popup' );
			add_filter( 'media_upload_tabs', 'nusantara_mlu_modify_tabs' );
		}

	}

	

	// -- Function Name : nusantara_mlu_js_popup
	// -- Params : 
	// -- Purpose : 
	function nusantara_mlu_js_popup () {
		$_nusantara_title = $_REQUEST['nusantara_title'];
		
		if ( ! $_nusantara_title ) {
			$_nusantara_title = 'file';
		}

		// End IF Statement
		?>
	<script type="text/javascript">
	jQuery(function($) {
		jQuery.noConflict();
		// Change the title of each tab to use the custom title text instead of "Media File".
		$( 'h3.media-title' ).each ( function () {
			var current_title = $( this ).html();
			var new_title = current_title.replace( 'media file', '<?php  echo $_nusantara_title; ?>' );
			$( this ).html( new_title );
		} );
		// Change the text of the "Insert into Post" buttons to read "Use this File".
		$( '.savesend input.button[value*="Insert into Post"], .media-item #go_button' ).attr( 'value', 'Use this File' );
		// Hide the "Insert Gallery" settings box on the "Gallery" tab.
		$( 'div#gallery-settings' ).hide();
		// Preserve the "is_nusantara" parameter on the "delete" confirmation button.
		$( '.savesend a.del-link' ).click ( function () {
			var continueButton = $( this ).next( '.del-attachment' ).children( 'a.button[id*="del"]' );
			var continueHref = continueButton.attr( 'href' );
			continueHref = continueHref + '&is_nusantara=yes';
			continueButton.attr( 'href', continueHref );
		} );
	});
	</script>
<?php
	}

	// -- Triggered inside the Media Library popup 
	// -- to modify the title of the "Gallery" tab.
	function nusantara_mlu_modify_tabs ( $tabs ) {
		$tabs['gallery'] = str_replace( __( 'Gallery', 'nusantara' ), __( 'Previously Uploaded', 'nusantara' ), $tabs['gallery'] );
		return $tabs;
	}