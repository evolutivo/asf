<?php
/*
 * Main functions file
 * 
 * This file is WordPress functions file, which which contains many of the functions 
 * for set up and operation of the theme
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* ========================================================================================================
 *                 Set Up
 * ======================================================================================================== */
 
/* ---- load files ---------------*/ 
require(get_template_directory() . '/library/blogBox_options.php');
require(get_template_directory() . '/widgets/blogBox_social_widget.php');

/* ---- Set content width --------*/
if(!isset( $content_width )) $content_width = 510;

function blogBox_translation(){
	//enable translation
    load_theme_textdomain('blogBox', get_template_directory() . '/language'); 
}
add_action('after_setup_theme', 'blogBox_translation');

/* ------------editor-style -------------------- */
 add_editor_style();
 
 
//Custom Backgrounds 

add_theme_support('custom-background');
//custom header
$bB_header_args = array(
	'flex-width' => true,
	'width' => 200,
	'flex-height' => true,
	'height' => 100,
	'header-text' => false,
	'default-image' => get_template_directory_uri().'/images/logo.png',
	'uploads' => true,
);
add_theme_support('custom-header',$bB_header_args);
//feeds
add_theme_support('automatic-feed-links');
//thumbnails
add_theme_support('post-thumbnails');
add_image_size('wide_thumbnail',180,120);
  
/*
********* Set up Menu in Dashboard under Appearance **************
*/
function blogBox_register_menu() {
	register_nav_menu('primary-nav','Primary Menu');
}
add_action( 'init', 'blogBox_register_menu' );

function blogBox_fallback_menu() {
	echo '<h4 class="menu-error">Set up your menu - see User Documentation available at <a href="http://demo1.kevinsspace.ca" target="_blank" >demo1.kevinsspace.ca</a></h4>';
}

// Sidebars and footer areas
    register_sidebar(array('name'=>'Sidebar'));
	register_sidebar(array('name'=>'Sidebar-Left'));
	register_sidebar(array('name'=>'Sidebar-Right'));
	register_sidebar(array('name'=>'Sidebar-Contact'));
    register_sidebar(array('name'=>'Footer A'));
    register_sidebar(array('name'=>'Footer B'));
    register_sidebar(array('name'=>'Footer C'));
    register_sidebar(array('name'=>'Footer D'));

/* ========================================================================================================
 *                 Scripts and Styles
 * ======================================================================================================== */

define('BLOGBOX_JS', get_template_directory_uri() . '/js' );

if ( !function_exists ('blogBox_load_js')){
	function blogBox_load_js() {
		if(!is_admin()){
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'hoverIntent');
			wp_enqueue_script( 'superfish', BLOGBOX_JS . '/menu/superfish_min.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'easing', BLOGBOX_JS . '/jquery.easing.1.3.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'slides', BLOGBOX_JS . '/slides.min.jquery.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'blogBox_custom', BLOGBOX_JS . '/doc_ready_scripts.js', array( 'jquery' ), '' );
		}
	}
	add_action('init', 'blogBox_load_js');
}

if ( !function_exists ('blogBox_styles')) {
	function blogBox_styles() {
		wp_register_style( 'main_style',get_stylesheet_directory_uri() . '/style.css',array(),'20120527','all' );
		wp_enqueue_style( 'main_style' ); 
		wp_register_style( 'feature_slider_style',get_template_directory_uri() . '/css/feature_slider.css',array(),'20120527','all' );
		wp_enqueue_style( 'feature_slider_style' );
		wp_register_style( 'superfish_style',get_template_directory_uri() . '/css/superfish.css',array(),'20120527','all' );
		wp_enqueue_style( 'superfish_style' );
	}
	add_action('wp_enqueue_scripts', 'blogBox_styles');
}

if ( !function_exists ('blogBox_setup')){// load custom styles and fonts
	function blogbox_setup(){ 
	         include( get_template_directory() . '/library/custom-fonts.php' );
	         include( get_template_directory() . '/library/custom-styles.php' );
	 }
	add_action( 'wp_print_styles', 'blogbox_setup' );
}

if ( !function_exists ('blogBox_enqueue_ie_script')){//Script for loading js shiv for ie HTML5
	function blogBox_enqueue_ie_script() {
		global $is_IE;
		if ( $is_IE ) {
			wp_register_script( 'ie_html5_shiv', BLOGBOX_JS.'/html5.js', array( 'jquery' ), '');
			wp_enqueue_script('ie_html5_shiv');
		}
	}
	add_action('wp_enqueue_scripts', 'blogBox_enqueue_ie_script');
}

if ( !function_exists ('blogBox_title_filter')){
	function blogBox_title_filter($title) {
		if(is_front_page()) {
			$return = 'home | '.get_bloginfo( 'name' );
		} else {
			$return = $title.' | '.get_bloginfo( 'name' );
		}
		
	    return $return;
	}
	add_filter( 'wp_title', 'blogBox_title_filter', 10, 3 );
}

/* ========================================================================================================
 *              Comments and Pingbacks
 * ======================================================================================================== */

if ( !function_exists ('blogBox_enqueue_comment_reply_script')){//enque of enque reply script as per http://make.wordpress.org/themes/tag/guidelines/
	function blogBox_enqueue_comment_reply_script() {
		if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'comment_form_before', 'blogBox_enqueue_comment_reply_script' );
}

if ( !function_exists ('blogBox_cleanPings')){// clean pingbacks and trackbacks
	function blogBox_cleanPings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		echo '<li>';
		echo comment_author_link().'&nbsp;&nbsp;';
		edit_comment_link('Edit');
		echo '</li><br/>';
	}
}

/* ========================================================================================================
 *              Captcha
 * ======================================================================================================== */
/*
 * ------------------- Comment Captcha ------------------------- 
 * 
 * Modified code from Chip Bennet's post 
 *  at http://www.chipbennett.net/2010/07/29/using-really-simple-captcha-plugin-for-comments/
 * Captcha from Book "Headfirst PHP & MYSQL"
 * 
 * -------------Add Captcha to comment form -------------------*/
if ( !function_exists ('blogBox_comment_captcha')){//add comment captcha 
	function blogBox_comment_captcha () { 
		$blogBox_option = blogBox_get_options();
		if (!is_user_logged_in() && $blogBox_option['bB_show_comment_captcha'] == 1) { ?>
	 		<label>Verification * </label>
			<input type="text" size="30" id="comment_captcha_response" name="comment_captcha_response" value="Enter the Captcha letters" />
			<img src="<?php echo get_template_directory_uri(); ?>/captcha.php" alt="Verification Captcha" />
			<br/><br/>
		<?php }
	}
	add_action( 'comment_form_after_fields' , 'blogBox_comment_captcha' );
}

if ( !function_exists ('blogBox_check_comment_captcha')){//Validate Captcha Entry
	function blogBox_check_comment_captcha( $comment_data  ) { 
		$blogBox_option = blogBox_get_options();
		if ( ( ! is_user_logged_in() ) && ($comment_data['comment_type'] == '') && $blogBox_option['bB_show_comment_captcha'] == 1) {
			 if(!isset($_SESSION)) session_start();
			// This variable will hold the result of the CAPTCHA validation. Set to 'false' until CAPTCHA validation passes	
			$blogBox_comment_captcha_correct = false; 		
			// Validate the CAPTCHA response
			if ($_SESSION['pass_phrase'] == SHA1($_POST['comment_captcha_response'])){
				$blogBox_comment_captcha_correct = true; 
			}	
			// If CAPTCHA validation fails (incorrect value entered in CAPTCHA field) don't process the comment.
			if ( $blogBox_comment_captcha_correct == false ) {
				wp_die('You have entered an incorrect CAPTCHA value. Click the BACK button on your browser, and try again.');
				break;
			} 
			// if CAPTCHA validation passes (correct value entered in CAPTCHA field), process the comment as per normal
			session_destroy();
			return $comment_data;
			} else {
				return $comment_data;
			}
	}
	add_filter('preprocess_comment', 'blogBox_check_comment_captcha');
}

/* ========================================================================================================
 *              Filters
 * ======================================================================================================== */

 /* THE_EXCERT modified from http://wordpress.org/support/topic/dynamic-the_excerpt?replies=22 */
if ( !function_exists ('blogBox_the_excerpt_dynamic')){// Outputs an excerpt of variable length (in characters)
	function blogBox_the_excerpt_dynamic($length) { 
		
		global $post;
		$text = $post->post_excerpt;
		if ( '' == $text ) {
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]>', $text);
		}
		//I'm checking for my own conatct-pizazz plug-in here so that you can include the shortcodes I know about.
		if (function_exists('content_pizazz_list_func()')) {
			$text = do_shortcode($text);
		} else {
			strip_shortcodes($text);
		}
		
		$output = strlen($text);
		if($output > $length ) {
			$break_pos = strpos($text, ' ', $length);//find next space after desired length
			if($break_pos == '')$break_pos = $length;
			$text = substr($text,0,$break_pos).' <a href="'. get_permalink($post->ID) . '" > [...]</a>';
		}
	
		echo apply_filters('the_excerpt',$text);
	}
}

if ( !function_exists ('blogBox_portfolio_titles')){//function to limit characters in portfolio titles
	function blogBox_portfolio_titles($content,$limit){
		$content = strip_tags($content);
		if(strlen($content) > $limit){
	    	$visible = substr($content, 0, $limit);
			$visible = $visible.'&nbsp;...';
		} else {
			$visible = $content;
		}
		//return $visible;
		echo strip_tags(apply_filters('the_excerpt',$visible));
	}
}

if ( !function_exists ('blogBox_portfolio_feature_description')){//function to limit characters in portfolio titles
	function blogBox_portfolio_feature_description($content,$limit){
		$content = do_shortcode($content);
		$content = strip_tags($content,'<p></p><ol></ol><ul></ul><br/><li></li>');
		if(strlen($content) > $limit){
			$break_pos = strpos($content, ' ', $limit);//find next space after desired length
			if($break_pos == '')$break_pos = $limit;
	    	$visible = substr($content, 0, $break_pos);
			$visible = $visible.'&nbsp;...';
		} else {
			$visible = $content;
		}
		echo apply_filters('the_content',$visible);
	}
}

/*
 * --------------------HTML Validation Filters ------------------------ 
  * the rel tag does not validate it says it does not like the term category
  * Discussion at wordpess.org suggests it is an HTML/W#C issue.Browsers do 
  * not use this attribute in any way. However, search engines can use this 
  * attribute to get more information about a link.
  */
if ( !function_exists ('blogBox_html5_fix_the_category')){//rel tag validation fix
	function blogBox_html5_fix_the_category($content) { 
	
	        $pattern = '/rel="category tag"/';
	        $replacement = 'rel="tag"';
	        $content = preg_replace($pattern, $replacement, $content);
	        return $content;
	}
	add_filter('the_category','blogBox_html5_fix_the_category');
}

/*
 * Plugin Name: Shortcode Empty Paragraph Fix
 * Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
 * Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
 * Author URI: http://www.johannheyne.de
 * Version: 0.1
 * Put this in /wp-content/plugins/ of your Wordpress installation
 */   

if ( !function_exists ('blogBox_shortcode_paragraph_insertion_fix')){//Empty Paragraph Fix
	function blogBox_shortcode_paragraph_insertion_fix($content) { 
	    $array = array (
	        '<p>[' => '[', 
	        ']</p>' => ']', 
	        ']<br />' => ']',
	        ']<br/>' => ']'
	    );
	    $content = strtr($content, $array);
	    return $content;
	}
	add_filter('the_content', 'blogBox_shortcode_paragraph_insertion_fix'); 
}

add_filter('widget_text', 'do_shortcode');// Allows shortcodes to be displayed in sidebar widgets

/* ========================================================================================================
 *              Miscelaneous
 * ======================================================================================================== */
 
class blogBox_hermit_walker extends Walker_Nav_Menu
/*custom walker that only shows the menuitem's ID's (and active items get active classes), delevering clean menu code (in WordPress > 3.0)
*/
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           
           	$current_indicators = array('current-menu-item', 'current-menu-parent', 'current_page_item', 'current_page_parent');
	
			$newClasses = array();
			
			foreach($classes as $el){
				//check if it's indicating the current page, otherwise we don't need the class
				if (in_array($el, $current_indicators)){ 
					array_push($newClasses, $el);
				}
			}

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $newClasses), $item ) );
           if($class_names!='') $class_names = ' class="'. esc_attr( $class_names ) . '"';
           

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           if($depth != 0)
           {
                     //children stuff, maybe you'd like to store the submenu's somewhere?
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}

if ( !function_exists ('blogBox_validEmail')){    
	function blogBox_validEmail($email)
	{
		$isValid = true;
		$atIndex = strrpos($email, "@");
		if (is_bool($atIndex) && !$atIndex)
		{
			$isValid = false;
		}
		else
		{
			$domain = substr($email, $atIndex+1);
			$local = substr($email, 0, $atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);
			if ($localLen < 1 || $localLen > 64)
			{
				// local part length exceeded
				$isValid = false;
			}
			else if ($domainLen < 1 || $domainLen > 255)
			{
				// domain part length exceeded
				$isValid = false;
			}
			else if ($local[0] == '.' || $local[$localLen-1] == '.')
			{
				// local part starts or ends with '.'
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $local))
			{
				// local part has two consecutive dots
				$isValid = false;
			}
			else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
			{
				// character not valid in domain part
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $domain))
			{
				// domain part has two consecutive dots
				$isValid = false;
			}
			else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
			{
				// character not valid in local part unless 
				// local part is quoted
				if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local)))
				{
					$isValid = false;
				}
			}
			if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
			{
				// domain not found in DNS
				$isValid = false;
			}
		}
		return $isValid;
	}
}


/**
 * blogBox exclude categories
 *
 * This helper function is used in page-home-blog.php and index.php.
 * It returns an exclusion string for $wp-query, and is based on user settings to
 * eclude the Feature and Portfolio categories.
 * 
 * @return $exclude_categories
 */
if ( !function_exists ('blogBox_exclude_categories')){//Exclude categories helper
	function blogBox_exclude_categories () { 
	 	$blogBox_option = blogBox_get_options();
		$exclude_categories = "'";
		$feature_cat_ID = get_cat_ID('Feature');
		$portfolioA_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioA_category']));
		$portfolioB_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioB_category']));
		$portfolioC_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioC_category']));
		$portfolioD_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioD_category']));
		$portfolioE_cat_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioE_category']));
		if ($feature_cat_ID !== 0 && $blogBox_option['bB_showfeaturepost'] == 0) $exclude_categories = $exclude_categories . "-" . $feature_cat_ID;
		if ($portfolioA_cat_ID !== 0 && $blogBox_option['bB_showfeatureApost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioA_cat_ID;
		}
		elseif ($portfolioA_cat_ID !== 0 && $blogBox_option['bB_showfeatureApost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioA_cat_ID;
		}
		if ($portfolioB_cat_ID !== 0 && $blogBox_option['bB_showfeatureBpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioB_cat_ID;
		}
		elseif ($portfolioB_cat_ID !== 0 && $blogBox_option['bB_showfeatureBpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioB_cat_ID;
		}
		if ($portfolioC_cat_ID !== 0 && $blogBox_option['bB_showfeatureCpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioC_cat_ID;
		}
		elseif ($portfolioC_cat_ID !== 0 && $blogBox_option['bB_showfeatureCpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioC_cat_ID;
		}
		if ($portfolioD_cat_ID !== 0 && $blogBox_option['bB_showfeatureDpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioD_cat_ID;
		}
		elseif ($portfolioD_cat_ID !== 0 && $blogBox_option['bB_showfeatureDpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioD_cat_ID;
		}
		if ($portfolioE_cat_ID !==0 && $blogBox_option['bB_showfeatureEpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioE_cat_ID;
		}
		elseif ($portfolioE_cat_ID !== 0 && $blogBox_option['bB_showfeatureEpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioE_cat_ID;
		}
		$exclude_categories = $exclude_categories . "'"	;
	
		return $exclude_categories;
	}
}

?>