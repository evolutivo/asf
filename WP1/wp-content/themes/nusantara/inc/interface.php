<?php 
if ( !defined('ABSPATH')) exit;
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" )
wp_redirect( 'themes.php?page=nusantara' );
	// -- Function Name : nusantara_admin_init
	// -- Params : 
	// -- Purpose : 
	function nusantara_admin_init() {
		// Rev up the Options Machine
		global $nusantara_options, $options_machine;
		$options_machine = new Options_Machine($nusantara_options);
		//if reset is pressed->replace options with defaults
    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'nusantara' ) {
		if (isset($_REQUEST['nusantara_reset']) && 'reset' == $_REQUEST['nusantara_reset']) {
			$nonce=$_POST['security'];
		if (!wp_verify_nonce($nonce, 'nusantara_ajax_nonce') ) {		
			header('Location: themes.php?page=nusantara&reset=error');
				die('Security Check'); 
				
			} 
		}
    }	
	   }	

	// -- Function Name : nusantara_add_admin
	// -- Params : 
	// -- Purpose : 
	function nusantara_add_admin() {
		$nusantara_page = add_theme_page( __('Nusantara Theme Options','nusantara'), __('Nusantara Options','nusantara'), 'edit_theme_options', 'nusantara', 
               'nusantara_options_page',NUSANTARA_DIR . 'images/icons/palette.png', '30.000' );
		// functionaily to the head individually
		add_action("admin_print_scripts-$nusantara_page", 'nusantara_load_only');
		add_action("admin_print_styles-$nusantara_page",'nusantara_style_only');
		add_action( "admin_print_styles-$nusantara_page", 'nusantara_mlu_css', 0 );
		add_action( "admin_print_scripts-$nusantara_page", 'nusantara_mlu_js', 0 );

	}

	// -- Function Name : nusantara_options_page
	// -- Params : 
	// -- Purpose : 
	function nusantara_options_page(){
		global $options_machine;

		/*
	//for debugging
	$nusantara_options = get_option(OPTIONS);
	print_r($nusantara_options);
	*/
		?>
<div class="wrap" id="nusantara_container">
       <div id="save_float"> 
		<ul>
                        <li><a href="#wpbody"><?php  _e('top', 'nusantara'); ?></a></li>	                	
			<li id ="nusantara_save"><?php  _e('Save', 'nusantara'); ?></li>			
			<li><a href="#footer"><?php  _e('bottom', 'nusantara'); ?></a></li>	   
                </ul>	
	</div>
	<div id="nusantara-popup-save" class="nusantara-save-popup">
		<div class="nusantara-save-save"><?php  _e('Nusantara Options Updated', 'nusantara'); ?></div>
	</div>
	<div id="nusantara-popup-reset" class="nusantara-save-popup">
		<div class="nusantara-save-reset"><?php  _e('Nusantara Options Reset', 'nusantara'); ?></div>
	</div>
	<div id="nusantara-popup-fail" class="nusantara-save-popup">
		<div class="nusantara-save-fail"><?php  _e('Nusantara Options Error!', 'nusantara'); ?></div>
	</div>
	<span style="display: none;" id="hooks"><?php  echo json_encode(nusantara_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php  if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php  echo wp_create_nonce('nusantara_ajax_nonce'); ?>" />
	<form id="nusantara_form" method="post" action="<?php  echo esc_attr( $_SERVER['REQUEST_URI'] )  ?>" enctype="multipart/form-data" >
		<div id="header">
			<div class="logo">
				<h2><?php  echo NUSANTARA_THEME; ?></h2>
				<span><?php  echo (''. NUSANTARA_VERSION); ?></span>
			</div>
			<div id="js-warning"><?php  _e('Warning- This options panel will not work properly without javascript!', 'nusantara'); ?></div>
			<div class="icon-option"></div>
			<div class="clear"></div>
    	</div>
		<div id="info_bar">
			<a>
				<div id="expand_options" class="expand"><?php  _e('Expand', 'nusantara'); ?></div>
			</a>
			<img style="display:none" src="<?php  echo NUSANTARA_DIR; ?>images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<button id="nusantara_save" type="button" class="button-primary">
				<?php  _e('Save All Changes', 'nusantara'); ?>
			</button>
		</div><!--.info_bar--> 	
		<div id="main">
			<div id="nusantara-nav">
				<ul>
			  <?php  echo $options_machine->Menu  ?>
				</ul>
			</div>
			<div id="content">
		  		<?php  echo $options_machine->Inputs /* Settings */ ?>
		  	</div>
			<div class="clear"></div>
		</div>
		<div class="save_bar"> 		
			<img style="display:none" src="<?php  echo NUSANTARA_DIR; ?>images/loading.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<button id ="nusantara_save" type="button" class="button-secondary"><?php  _e('Save All Changes', 'nusantara'); ?></button>			
			<button id ="nusantara_reset" type="button" class="button submit-button reset-button" ><?php  _e('Options Reset', 'nusantara'); ?></button>
			<img style="display:none" src="<?php  echo NUSANTARA_DIR; ?>images/loading.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
		</div><!--.save_bar--> 
	</form>
	<div style="clear:both;"></div>
</div><!--wrap-->	
<?php
	}
	// -- Function Name : nusantara_style_only
	// -- Params : 
	// -- Purpose : 
	function nusantara_style_only(){
		wp_enqueue_style('nusantara-admin-style', NUSANTARA_DIR . 'css/admin-style.css');
		wp_enqueue_style('color-picker', NUSANTARA_DIR . 'css/colorpicker.css');
	}

	// -- Function Name : nusantara_load_only
	// -- Params : 
	// -- Purpose : 
	function nusantara_load_only() {
		add_action('admin_head', 'nusantara_admin_head');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-input-mask', NUSANTARA_DIR .'js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
		wp_enqueue_script('nusantara-tipsy', NUSANTARA_DIR .'js/jquery.tipsy.js', array( 'jquery' ));
		wp_enqueue_script('color-picker', NUSANTARA_DIR .'js/colorpicker.js', array('jquery'));
		wp_enqueue_script('nusantara-ajaxupload', NUSANTARA_DIR .'js/ajaxupload.js', array('jquery'));
		wp_enqueue_script('nusantara-cookie', NUSANTARA_DIR . 'js/cookie.js', 'jquery');
		wp_enqueue_script('nusantara-admin', NUSANTARA_DIR .'js/nusantara.js', array( 'jquery' ));
	}

	
	// -- Function Name : nusantara_admin_head
	// -- Params : 
	// -- Purpose : 
	function nusantara_admin_head() {
		?>		
	<script type="text/javascript" language="javascript">
	jQuery.noConflict();
	jQuery(document).ready(function($){
		// COLOR Picker			
		$('.colorSelector').each(function(){
			var Othis = this; //cache a copy of the this variable for use inside nested function		
			$(this).ColorPicker({
					color: '<?php  if(isset($color)) echo $color; ?>',
					onShow: function (colpkr) {
						$(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$(Othis).children('div').css('backgroundColor', '#' + hex);
						$(Othis).next('input').attr('value','#' + hex);
					}
			});
		}); //end color picker
	}); //end doc ready
	</script>
<?php 
	}

	// -- Function Name : nusantara_ajax_callback
	// -- Params : 
	// -- Purpose : 
	function nusantara_ajax_callback() {
		global $options_machine, $nusantara_options;
		$nonce=$_POST['security'];		
		if (!isset( $_POST[ 'security' ] ) || ! wp_verify_nonce($nonce, 'nusantara_ajax_nonce') ) die('-1');
		//get options array from db
		$all = get_option(OPTIONS);
		$save_type = $_POST['type'];
                if (!isset( $_POST[ 'type' ] ) || ! wp_verify_nonce($nonce, 'nusantara_ajax_nonce') ) die('-1');		
		//echo $_POST['data'];
		//Uploads
		
		if($save_type == 'upload'){
			$clickedID = $_POST['data'];
			// Acts as the name
			$filename = $_FILES[$clickedID];
			$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);
			$override['test_form'] = false;
			$override['action'] = 'wp_handle_upload';
			$uploaded_file = wp_handle_upload($filename,$override);
			$upload_tracking[] = $clickedID;
			//update $options array w/ image URL			  
			$upload_image = $all;
			//preserve current data
			$upload_image[$clickedID] = $uploaded_file['url'];
			update_option(NUSANTARA_OPTIONS, $upload_image ) ;
			
			if(!empty($uploaded_file['error'])) {
				echo 'Upload Error: ' . $uploaded_file['error'];
			} else {
				echo $uploaded_file['url'];
			}

			// Is the Response
		}

		elseif($save_type == 'image_reset'){
			$id = $_POST['data'];
			// Acts as the name
			$delete_image = $all;
			//preserve rest of data
			$delete_image[$id] = '';
			//update array key with empty value	 
			update_option(NUSANTARA_OPTIONS, $delete_image ) ;
		}

		elseif($save_type == 'backup_options'){
			$backup = $all;
			$backup['backup_log'] = date('r');
			update_option(NUSANTARA_BACKUPS, $backup ) ;
			die('1');
		}

		elseif($save_type == 'restore_options'){
			$nusantara_options = get_option(NUSANTARA_BACKUPS);
			update_option(NUSANTARA_OPTIONS, $nusantara_options);                                                 
			die('1');
		}

		elseif ($save_type == 'save'){
			wp_parse_str(stripslashes($_POST['data']), $nusantara_options);
			unset($nusantara_options['security']);
			unset($nusantara_options['nusantara_save']);
			update_option(NUSANTARA_OPTIONS, $nusantara_options);
                        
			die('1');
		}

		elseif ($save_type == 'reset'){
                        update_option(NUSANTARA_OPTIONS,$options_machine->Defaults);
			die('1');
			//options reset
		}

		die();
	}

// -- Function Name : nusantara_head
	// -- Params : 
	// -- Purpose : 
	function nusantara_head() {
		do_action( 'nusantara_head' );
	}

	// -- Function Name : nusantara_option_setup
	// -- Params : 
	// -- Purpose : 
	function nusantara_option_setup(){
		global $nusantara_options, $options_machine;
		$options_machine = new Options_Machine($nusantara_options);
		
		if (!get_option(NUSANTARA_OPTIONS)){
                        update_option(NUSANTARA_OPTIONS,$options_machine->Defaults);
		}

	}
	
	// -- Function Name : nusantara_get_header_classes_array
	// -- Params : 
	// -- Purpose : 
	function nusantara_get_header_classes_array() {
		global $nusantara_options;
		foreach ($nusantara_options as $value) {
			
			if ($value['type'] == 'heading')$hooks[] = str_replace(' ','',strtolower($value['name']));
		}

		return $hooks;
	}

	$nusantara_options = get_option(NUSANTARA_OPTIONS);

// -- Required action filters
// -- uses add_action()
add_action('admin_head','nusantara_option_setup');
add_action('admin_init','nusantara_admin_init');
add_action('admin_menu', 'nusantara_add_admin');
add_action( 'init', 'nusantara_mlu_init');
// -- AJAX Saving Options
add_action('wp_ajax_nusantara_ajax_post_action', 'nusantara_ajax_callback');

class Options_Machine {
		function __construct($options) {
		$return = $this->nusantara_machine($options);		
		$this->Inputs = $return[0];
		$this->Menu = $return[1];
		$this->Defaults = $return[2];                				
	}
function nusantara_machine($options) {	
	        $nusantara_options = get_option(NUSANTARA_OPTIONS);
		$defaults = array();   
	        $counter = 0;
		$menu = '';
		$output = '';		
		foreach ($options as $value) {		
			$counter++;
			$val = '';
								
			if ($value['type'] == 'multicheck'){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
						$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
			}
						
			 if ( $value['type'] != "heading" )
			 {
			 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }								
				$fold='';
				if (array_key_exists("fold",$value)) {
					if ($nusantara_options[$value['fold']]) {
						$fold="f_".$value['fold']." ";
					} else {
						$fold="f_".$value['fold']." temphide ";
					}
				}
	
				$output .= '<div  class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";								
                                if(isset($value['name'])) $output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";				
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";					
			 } 			                          
			switch ( $value['type'] ) {			
				//text input
				case 'text':
					$t_value = '';
					$t_value = stripslashes($nusantara_options[$value['id']]);
					
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					
					$output .= '<input class="nusantara-input '.esc_attr($mini).'" name="'.esc_attr($value['id']).'" id="'. esc_attr($value['id']) .'" type="'. esc_attr($value['type']) .'" value="'. esc_attr($t_value) .'" />';
				break;
				
				//select option
				case 'select':
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					$output .= '<div class="select_wrapper ' . $mini . '">';
					$output .= '<select class="select nusantara-input" name="'.esc_attr($value['id']).'" id="'. esc_attr($value['id']) .'">';
					foreach ($value['options'] as $select_ID => $option) {			
						$output .= '<option id="' . esc_attr($select_ID) . '" value="'.esc_attr($option).'" ' . selected($nusantara_options[$value['id']], $option, false) . ' />'.esc_attr($option).'</option>';	 
					 } 
					$output .= '</select></div>';
				break;
				
				//textarea option
				case 'textarea':	
					$cols = '8';
					$ta_value = '';
					
					if(isset($value['options'])){
							$ta_options = $value['options'];
							if(isset($ta_options['cols'])){
							$cols = $ta_options['cols'];
							} 
						}
						
									
						$output .= '<textarea class="nusantara-input" name="'.esc_attr($value['id']).'" id="'. esc_attr($value['id']) .'" cols="'. esc_attr($cols) .'" rows="8">'.esc_textarea($nusantara_options[$value['id']]).'</textarea>';		
				break;
								
				//radiobox option
				case "radio":
					
					 foreach($value['options'] as $option=>$name) {
						$output .= '<input class="nusantara-input nusantara-radio" name="'.esc_attr($value['id']).'" type="radio" value="'.esc_attr($option).'" ' . checked($nusantara_options[$value['id']], $option, false) . ' /><label class="radio">'.esc_attr($name).'</label><br/>';				
					}
				break;

                              //multiple checkbox option
				case 'multicheck': 			
					$multi_stored = $nusantara_options[$value['id']];
								
					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$nusantara_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $nusantara_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $nusantara_key_string .'">'. esc_attr($option) .'</label><br />';								
					}			 
				break;


				
				//checkbox option
				case 'checkbox':
					if (!isset($nusantara_options[$value['id']])) {
						$nusantara_options[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
		
					$output .= '<input type="hidden" class="'.$fold.'checkbox aq-input" name="'.esc_attr($value['id']).'" id="'. esc_attr($value['id']) .'" value="0"/>';
					$output .= '<span class="checkbox"><input type="checkbox" class="'.$fold.'checkbox nusantara-input" name="'.esc_attr($value['id']).'" id="'. esc_attr($value['id']) .'" value="1" '. checked($nusantara_options[$value['id']], 1, false) .' /><label data-on="ON" data-off="OFF"></label></span>';
				break;
				
				
				
				//ajax image upload option
				case 'upload':
					if(!isset($value['mod'])) $value['mod'] = '';
					$output .= Options_Machine::nusantara_uploader_function($value['id'],$value['std'],$value['mod']);			
				break;
				
				// native media library uploader - @uses nusantara_media_uploader_function()
				case 'media':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = nusantara_mlu_get_silentpost( $_id );
					if(!isset($value['mod'])) $value['mod'] = '';
					$output .= Options_Machine::nusantara_media_uploader_function( $value['id'], $value['std'], $int, $value['mod'] ); // New AJAX Uploader using Media Library			
				break;
				
				//colorpicker option
				case 'color':		
					$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$nusantara_options[$value['id']].'"></div></div>';
					$output .= '<input class="nusantara-color" name="'.esc_attr($value['id']).'" id="'. esc_attr($value['id']) .'" type="text" value="'. esc_attr($nusantara_options[$value['id']]) .'" />';
				break;


				//typography option	
				case 'typography':				
					$typography_stored = $nusantara_options[$value['id']];

					/* Font Face */
					if(isset($typography_stored['face'])) {
					
						$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
						$output .= '<select class="nusantara-typography nusantara-typography-face select" name="'.esc_attr($value['id']).'[face]" id="'. esc_attr($value['id']).'_face">';
						
						$faces = array(
                                                               "Tinos" => "Tinos font face",
                                                               "serif" => "serif (generic only)",
                                                               "sans-serif" => "sans-serif (generic only)",
                                                               "Arial, sans-serif" => "Arial, sans-serif",
			                                       "'Arial Black', sans-serif" => "'Arial Black', sans-serif",
			                                       "'Courier New', sans-serif" => "'Courier New', sans-serif",
			                                       "Georgia, serif" => "Georgia, serif",
			                                       "Helvetica, sans-serif" => "Helvetica, sans-serif",
			                                       "Impact, sans-serif" => "Impact, sans-serif",
			                                       "'Lucidia Console', sans-serif" => "'Lucidia Console', sans-serif",
			                                       "'Lucidia grande', sans-serif" => "Lucidia grande",
			                                       "Tahoma, sans-serif" => "Tahoma, sans-serif",
			                                       "'Times New Roman', serif" => "'Times New Roman', serif",
			                                       "'Trebuchet MS', sans-serif" => "'Trebuchet MS', sans-serif",
			                                       "Verdana, sans-serif" => "Verdana, sans-serif" );			
						foreach ($faces as $i=>$face) {
							$output .= '<option value="'. esc_attr($i) .'" ' . selected($typography_stored['face'], $i, false) . '>'. esc_attr($face) .'</option>';
						}			
										
						$output .= '</select></div>';
					
					}
					/* Font Size */
					
					if(isset($typography_stored['size'])) {
						$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
						$output .= '<select class="nusantara-typography nusantara-typography-size select" name="'.esc_attr($value['id']).'[size]" id="'. esc_attr($value['id']).'_size">';
							for ($i = 9; $i < 101; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'.esc_attr($i) .'px" ' . selected($typography_stored['size'], $test, false) . '>'. esc_attr($i) .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
					
					/* Line Height */
					if(isset($typography_stored['height'])) {
					
						$output .= '<div class="select_wrapper typography-size" original-title="Line height">';
						$output .= '<select class="nusantara-typography nusantara-typography-size select" name="'.esc_attr($value['id']).'[height]" id="'. esc_attr($value['id']).'_height">';
							for ($i = 0; $i < 101; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. esc_attr($i) .'px" ' . selected($typography_stored['height'], $test, false) . '>'. esc_attr($i) .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
						
					
					
					/* Font Weight */
					if(isset($typography_stored['style'])) {
					
						$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
						$output .= '<select class="nusantara-typography nusantara-typography-style select" name="'.esc_attr($value['id']).'[style]" id="'. esc_attr($value['id']).'_style">';
						$styles = array('normal'=>'Normal',
										'italic'=>'Italic',
										'bold'=>'Bold',
										'normal'=>'normal');
										
						foreach ($styles as $i=>$style){
						
							$output .= '<option value="'. esc_attr($i) .'" ' . selected($typography_stored['style'], $i, false) . '>'. esc_attr($style) .'</option>';		
						}
						$output .= '</select></div>';
					
					}
					
					/* Font Color */
					if(isset($typography_stored['color'])) {
					
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
						$output .= '<input class="nusantara-color nusantara-typography nusantara-typography-color" original-title="Font color" name="'.esc_attr($value['id']).'[color]" id="'. esc_attr($value['id']) .'_color" type="text" value="'. esc_attr($typography_stored['color']) .'" />';
					
					}
					
				break;
				
				//border option
				case 'border':
						
					/* Border Width */
					$border_stored = $nusantara_options[$value['id']];
					if($border_stored) {
					$output .= '<div class="select_wrapper typography-size" original-title="Border Width">';
					$output .= '<select title="Border width" class="nusantara-border nusantara-border-width select" name="'.$value['id'].'[width]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 21; $i++){ 
                                                $bordering = $i.'px';
						$output .= '<option value="'. esc_attr($i) .'px" ' . selected($border_stored['width'], $bordering, false) . '>'. esc_attr($i) .'px</option>';}
					$output .= '</select></div>';
					}
					/* Border Style */
                                        if(isset($border_stored['style'])) {
					$output .= '<div class="select_wrapper typography-style" original-title="Border style">';
					$output .= '<select title="Border style" class="nusantara-border nusantara-border-style select" name="'.esc_attr($value['id']).'[style]" id="'. esc_attr($value['id']).'_style">';
					
					$styles = array('none'=>'None',
									'solid'=>'Solid',
									'dashed'=>'Dashed',
									'dotted'=>'Dotted');
									
					foreach ($styles as $i=>$style){
						$output .= '<option value="'. esc_attr($i) .'" ' . selected($border_stored['style'], $i, false) . '>'. esc_attr($style) .'</option>';		
					}
					
					$output .= '</select></div>';
					}
					/* Border Color */
                                        if(isset($border_stored['color'])) {		
					$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$border_stored['color'].'"></div></div>';
					$output .= '<input class="nusantara-color nusantara-typography nusantara-typography-color" original-title="Border color" name="'.esc_attr($value['id']).'[color]" id="'. esc_attr($value['id']) .'_color" type="text" value="'. esc_attr($border_stored['color']) .'" />';
					}
				break;				

                               //Padding and margin option
				case 'padding':
						
					/* top */
					$padding_stored = $nusantara_options[$value['id']];

					if(isset($padding_stored['top'])) {
					$output .= '<div class="select_wrapper typography-size" original-title="Top">';
					$output .= '<select class="nusantara-border nusantara-border-width select" name="'.$value['id'].'[top]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 301; $i++){ 
                                                $paddinging = $i.'px';
						$output .= '<option value="'. esc_attr($i) .'px" ' . selected($padding_stored['top'], $paddinging, false) . '>'. esc_attr($i) .'px</option>';				 }
					$output .= '</select></div>';
                                        }
					/* bottom */
                              		if(isset($padding_stored['bottom'])) {		
					$output .= '<div class="select_wrapper typography-size" original-title="Bottom">';
					$output .= '<select class="nusantara-border nusantara-border-width select" name="'.$value['id'].'[bottom]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 301; $i++){ 
                                                $paddinging = $i.'px';
						$output .= '<option value="'. esc_attr($i) .'px" ' . selected($padding_stored['bottom'], $paddinging, false) . '>'. esc_attr($i) .'px</option>';				 }
					$output .= '</select></div>';
                                         }

                                        /* left */                              
                                        if(isset($padding_stored['left'])) {					
					$output .= '<div class="select_wrapper typography-size" original-title="Left">';
					$output .= '<select class="nusantara-border nusantara-border-width select" name="'.$value['id'].'[left]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 301; $i++){ 
                                                $paddinging = $i.'px';
						$output .= '<option value="'. esc_attr($i) .'px" ' . selected($padding_stored['left'], $paddinging, false) . '>'. esc_attr($i) .'px</option>';				 }
					$output .= '</select></div>';
                                         }

                                        /* right */    
                                        if(isset($padding_stored['right'])) {                          					
					$output .= '<div class="select_wrapper typography-size" original-title="Right">';
					$output .= '<select class="nusantara-border nusantara-border-width select" name="'.$value['id'].'[right]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 301; $i++){ 
                                                $paddinging = $i.'px';
						$output .= '<option value="'. esc_attr($i) .'px" ' . selected($padding_stored['right'], $paddinging, false) . '>'. esc_attr($i) .'px</option>';				 }
					$output .= '</select></div>';
					
					}
					
					
				break;

                               //Text and box shadow CSS3
				case 'shadow':
						
					/* x shadow */
					$shadow_stored = $nusantara_options[$value['id']];

					if(isset($shadow_stored['Xshadow'])) {
					$output .= '<div class="select_wrapper typography-size" original-title="X line">';
					$output .= '<select class="nusantara-border nusantara-border-width select" name="'.$value['id'].'[Xshadow]" id="'. $value['id'].'_width">';
						for ($i = -100; $i < 151; $i++){ 
                                                $shadowing = $i.'px';
						$output .= '<option value="'. esc_attr($i) .'px" ' . selected($shadow_stored['Xshadow'], $shadowing, false) . '>'. esc_attr($i) .'px</option>';				 }
					$output .= '</select></div>';
                                        }
					/* Y shadow */
                              		if(isset($shadow_stored['Yshadow'])) {		
					$output .= '<div class="select_wrapper typography-size" original-title="Y line">';
					$output .= '<select class="nusantara-border nusantara-border-width select" name="'.$value['id'].'[Yshadow]" id="'. $value['id'].'_width">';
						for ($i = -100; $i < 151; $i++){ 
                                                $shadowing = $i.'px';
						$output .= '<option value="'. esc_attr($i) .'px" ' . selected($shadow_stored['Yshadow'], $shadowing, false) . '>'. esc_attr($i) .'px</option>';				 }
					$output .= '</select></div>';
                                         }

                                        /* Blur */                              
                                        if(isset($shadow_stored['blur'])) {					
					$output .= '<div class="select_wrapper typography-size" original-title="blur">';
					$output .= '<select class="nusantara-border nusantara-border-width select" name="'.$value['id'].'[blur]" id="'. $value['id'].'_width">';
						for ($i = -100; $i < 151; $i++){ 
                                                $shadowing = $i.'px';
						$output .= '<option value="'. esc_attr($i) .'px" ' . selected($shadow_stored['blur'], $shadowing, false) . '>'. esc_attr($i) .'px</option>';				 }
					$output .= '</select></div>';
                                         }

                                        /* Color shadow */
                                        if(isset($shadow_stored['scolor'])) {		
					$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$shadow_stored['scolor'].'"></div></div>';
					$output .= '<input class="nusantara-color nusantara-typography nusantara-typography-color" original-title="Color selection" name="'.esc_attr($value['id']).'[scolor]" id="'. $value['id'] .'_color" type="text" value="'. esc_attr($shadow_stored['scolor']) .'" />';
					
					
					}
					
					
				break;


				//images checkbox - use image as checkboxes
				case 'images':
				
					$i = 0;
					
					$select_value = $nusantara_options[$value['id']];
					
					foreach ($value['options'] as $key => $option) 
					{ 
					$i++;
			
						$checked = '';
						$selected = '';
						if(NULL!=checked($select_value, $key, false)) {
							$checked = checked($select_value, $key, false);
							$selected = 'nusantara-radio-img-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="nusantara-radio-img-' . esc_attr($value['id']) . $i . '" class="checkbox nusantara-radio-img-radio" value="'.$key.'" name="'.esc_attr($value['id']).'" '.$checked.' />';
						$output .= '<div class="nusantara-radio-img-label">'. $key .'</div>';
						$output .= '<img src="'.$option.'" alt="" class="nusantara-radio-img-img '. $selected .'" onClick="document.getElementById(\'nusantara-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
						$output .= '</span>';				
					}
					
				break;
				
				//info (for small intro box etc)
				case "info":
					$info_text = $value['std'];
					$output .= '<div class="nusantara-info">'.$info_text.'</div>';
				break;

				//setting sections
				case "info2":
					$info_text2 = $value['std'];
					$output .= '<div class="nusantara-info2">'.$info_text2.'</div>';
				break;

				//display a single image
				case "image":
					$src = $value['std'];
					$output .= '<img src="'.$src.'">';
				break;
				
				//tab heading
				case 'heading':
					if($counter >= 2){
					   $output .= '</div>'."\n";
					}
					$header_class = str_replace(' ','',strtolower($value['name']));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "nusantara-option-" . $jquery_click_hook;
					$menu .= '<li class="'. $header_class .'"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
				break;

				
				//drag & drop slide manager
				case 'slider':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = nusantara_mlu_get_silentpost( $_id );
					$output .= '<div class="slider"><ul id="'.$value['id'].'" rel="'.$int.'">';
					$slides = $nusantara_options[$value['id']];
					$count = count($slides);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::nusantara_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
					} else {
						$i = 0;
						foreach ($slides as $slide) {
							$oldorder = $slide['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::nusantara_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
						}
					}			
					$output .= '</ul>';
					$output .= '<a href="#" class="button slide_add_button">Add New</a></div>';
					
				break;
				
				//drag & drop block manager
				case 'sorter':				
					$sortlists = isset($nusantara_options[$value['id']]) && !empty($nusantara_options[$value['id']]) ? $nusantara_options[$value['id']] : $value['std'];					
					$output .= '<div id="'.$value['id'].'" class="sorter">';										
					if ($sortlists) {					
						foreach ($sortlists as $group=>$sortlist) {
							$output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
							$output .= '<h3>'.$group.'</h3>';
							foreach ($sortlist as $key => $list) {
							
								$output .= '<input class="sorter-komodo" type="hidden" name="'.$value['id'].'['.$group.'][komodo]" value="komodo">';
									
								if ($key != "komodo") {
								
									$output .= '<li id="'.$key.'" class="sortee">';
									$output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
									$output .= $list;
									$output .= '</li>';
									
								}
								
							}
							
							$output .= '</ul>';
						}
					}					
					$output .= '</div>';
				break;
								
				//backup and restore options data
				case 'backup':				
					$instructions = $value['desc'];
					$backup = get_option(NUSANTARA_BACKUPS);
					
					if(!isset($backup['backup_log'])) {
						$log = 'No backups yet';
					} else {
						$log = $backup['backup_log'];
					}
					
					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>'. __('Last Backup : ', 'nusantara').'<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="nusantara_backup_button" class="button" title="Backup Options">Backup Options</a>';
					$output .= '<a href="#" id="nusantara_restore_button" class="button" title="Restore Options">Restore Last Backup</a>';
					$output .= '</div>';
				
				break;
				
				//export or import data between different installs
				
			
			}
			
			//description of each option
			if ( $value['type'] != 'heading' ) { 
				if(!isset($value['desc'])){ $explain_value = ''; } else{ 
					$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n"; 
				} 
				$output .= '</div>'.$explain_value."\n";
				$output .= '<div class="clear"> </div></div></div>'."\n";
				}
		   
		}
		
	    $output .= '</div>';	    
	    return array($output,$menu,$defaults);
	    
	}

function nusantara_uploader_function($id,$std,$mod){	
	        $nusantara_options =get_option(NUSANTARA_OPTIONS);		
		$uploader = '';
	        $upload = $nusantara_options[$id];
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload nusantara-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">'._('Upload').'</span>';
		
		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
	    $uploader .= '<div class="clear"></div>' . "\n";
		if(!empty($upload)){
			$uploader .= '<div class="screenshot">';
	    	$uploader .= '<a class="nusantara-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="nusantara-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';
			$uploader .= '</div>';
			}
		$uploader .= '<div class="clear"></div>' . "\n"; 
	
		return $uploader;
	
	}

	
function nusantara_media_uploader_function($id,$std,$int,$mod){	
	        $nusantara_options =get_option(NUSANTARA_OPTIONS);		
		$uploader = '';
	        $upload = $nusantara_options[$id];
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload nusantara-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		$uploader .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'" rel="' . $int . '">Upload</span>';
		
		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
		$uploader .= '<div class="screenshot">';
		if(!empty($upload)){	
	    	$uploader .= '<a class="nusantara-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="nusantara-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';			
			}
		$uploader .= '</div>';
		$uploader .= '<div class="clear"></div>' . "\n"; 
	
		return $uploader;
		
	}
	
function nusantara_slider_function($id,$std,$oldorder,$order,$int){	
	        $nusantara_options = get_option(NUSANTARA_OPTIONS);		
		$slider = '';
		$slide = array();
	        $slide = $nusantara_options[$id];
		
	    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
		
		//initialize all vars
		$slidevars = array('title','url','link','description');
		
		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}
		
		//begin slider interface	
		if (!empty($val['title'])) {
			$slider .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li><div class="slide_header"><strong>slide '.$order.'</strong>';
		}
		
		$slider .= '<input type="hidden" class="slide nusantara-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	
		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
		
		$slider .= '<div class="slide_body">';
		
		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide nusantara-input nusantara-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. esc_attr($val['title']) .'" />';
		
		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="slide nusantara-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';
		
		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';
		
		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$slider .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url'])){
			
	    	$slider .= '<a class="nusantara-uploaded-image" href="'. $val['url'] . '">';
	    	$slider .= '<img class="nusantara-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
	    	$slider .= '</a>';
			
			}
		$slider .= '</div>';	
		$slider .= '<label>Link URL</label>';
		$slider .= '<input class="slide nusantara-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		
		$slider .= '<label>Description</label>';
		$slider .= '<textarea class="slide nusantara-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.esc_textarea($val['description']).'</textarea>';
	
		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
	        $slider .= '<div class="clear"></div>' . "\n";
	
		$slider .= '</div>';
		$slider .= '</li>';
	
		return $slider;
		
	}

}
