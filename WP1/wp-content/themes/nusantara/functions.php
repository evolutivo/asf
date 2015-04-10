<?php
if ( !defined('ABSPATH')) exit;
if ( ! isset( $content_width ) )$content_width = 625;
// -- Sets up the theme and provides some helper functions. Some helper functions
// -- are used in the theme as custom template tags. Others are attached to action and
// --  filter hooks in WordPress to change core functionality.

// -- When using a child theme (see http://codex.wordpress.org/Theme_Development
// -- and http://codex.wordpress.org/Child_Themes), you can override certain functions
// -- (those wrapped in a function_exists() call) by defining them first in your child theme's
// -- functions.php file. The child theme's functions.php file is included before the parent
// -- theme's file, so the child theme functions would be used.

// -- Functions that are not pluggable (not wrapped in function_exists()) are instead attached
// -- to a filter or action hook. The hook can be removed by using remove_action() or
// -- remove_filter() and you can attach your own function to the hook.


// -- define() is a PHP function
// -- define() is used to define a named constant
// -- Code Reference: http://php.net/manual/en/function.define.php

      define( 'NUSANTARA_PATH', get_template_directory(). '/inc/' );
      define( 'NUSANTARA_DIR', get_template_directory_uri() . '/inc/' );
      define( 'NUSANTARA_THEME', 'Nusantara' );
      define( 'NUSANTARA_VERSION', '0.2.4' );
      define( 'THEMEURI', '' );
      define( 'THEMEAUTHORURI', 'Hendro Prayitno' );
      define( 'NUSANTARA_OPTIONS', 'nusantara_options' );
      define( 'NUSANTARA_BACKUPS','nusantara_backups' );

// -- Function Name : nusantara_setup
// -- is used to define and setup all of the custom Theme features, including Theme support for optional WordPress features. 
// --  This function is designed to be over-ridden by a Child Theme, if necessary.
      
	function nusantara_setup(){               
		load_theme_textdomain('nusantara', get_template_directory() . '/lang' );
		register_nav_menus(array('navi'         => __('Primary Menu', 'nusantara'),        'secondary'      => __('Secondary Menu', 'nusantara')    )    );
		add_theme_support('custom-background');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_editor_style();
	}

// -- add_filter() is a WordPress function.
// -- add_filter() is used to hook a function into a WordPress action
// -- add_filter( \$tag, \$function_to_add, \$priority, \$accepted_args ) accepts four arguments
         
	add_filter('excerpt_more', 'nusantara_excerpt_more');
	add_filter('excerpt_length', 'nusantara_excerpt_length');
	add_filter('the_title', 'nusantara_takberjudul');
	add_filter( 'wp_title', 'nusantara_filter_title', 10, 2 );
	add_filter( 'body_class', 'nusantara_layout_classes' );
	add_filter( 'body_class', 'nusantara_menu_primary_classes' );
	add_filter( 'body_class', 'nusantara_menu_classes' );

// -- add_action() is a WordPress function.
// -- add_action() is used to hook a function into a WordPress action
// -- add_action( \$tag, \$function_to_add, \$priority, \$accepted_args ) accepts four arguments
 
	add_action('widgets_init', 'nusantara_widgets_init');
	add_action('after_setup_theme', 'nusantara_setup' );	
	add_action('wp_footer', 'nusantara_statistics_code');		  
	add_action('wp_enqueue_scripts', 'nusantara_enqueue_comment_reply');	
        add_action( 'wp_head', 'nusantara_print_ie_scripts');
        add_action('wp_enqueue_scripts', 'nusantara_slider_enqueue_scripts_style');

// -- require_once( \$file ) will include the file specified by the \$file argument
// -- require_once() will return a fatal error if the specified file cannot be included. 
// -- Also, if theme specified file has already been included, require_once() will not attempt to include it again 
// -- require_once( \$file ) accepts one argument 
	
	require( get_template_directory() . '/inc/widgets/widgets.php' );
	require( get_template_directory(). '/inc/widgets/text.php');	
	require( get_template_directory(). '/inc/mediauploader.php');
        require( get_template_directory(). '/inc/logical-element.php');        
	require( get_template_directory(). '/inc/options.php');        
	require( get_template_directory(). '/inc/interface.php');		
	require( get_template_directory() . '/inc/compress.php' );
        require( get_template_directory() .'/script/jscript.php' );                                           
	
    
// -- Function Name : nusantara_enqueue_comment_reply       
// -- Code Reference: http://codex.wordpress.org/Function_Reference/wp_enqueue_script

	function nusantara_enqueue_comment_reply() {		
		if ( is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
	
// -- Function Name : nusantara_slider_enqueue_scripts_style	 
// -- Code Reference: http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 
	function nusantara_slider_enqueue_scripts_style(){           	
		if ( is_home() || is_front_page()) {
			wp_enqueue_script('jquery');
			wp_enqueue_script('nusantara_slideshow', get_template_directory_uri() .'/script/jquery.flexslider-min.js');
			wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/script/slider.css');
                        nusantara_include_jscript();
			}
}
function nusantara_print_ie_scripts() {
  ?>
<!--[if lt IE 9]> <script src="<?php echo get_template_directory_uri(); ?>/script/html5.js" type="text/javascript"></script> <![endif]-->
  <?php
}

// -- Function Name : nusantara_widgets_init						
// -- widgets_init is a WordPress action hook
// -- widgets_init is used by Themes/Plugins, 
// -- usually to define and register custom Widgets 
// -- and to register dynamic sidebars.
 
	function nusantara_widgets_init() {
		//one column area widget
		register_sidebar(array(     
                                       'name' => __('one-column','nusantara'),     
                                       'description' => __('One column area', 'nusantara'),     
                                       'before_widget' => '<div class="line"> ',     
                                       'after_widget' => '</div>',     
                                       'before_title' => '<h3>',     
                                       'after_title' => '</h3>'));
		register_sidebar(array(     
                                       'name' => __('one-column-left','nusantara'),     
                                       'description' => __('One column left area', 'nusantara'),     
                                       'before_widget' => '<div class="line-ntt">',     
                                       'after_widget' => '</div>',     
                                       'before_title' => '<h3>',     
                                       'after_title' => '</h3>'));
		register_sidebar(array(     
                                       'name' => __('one-column-right','nusantara'),     
                                       'description' => __('One column right area', 'nusantara'),     
                                       'before_widget' => '<div class="line-ntt">',     
                                       'after_widget' => '</div>',     
                                       'before_title' => '<h3>',     
                                       'after_title' => '</h3>'));
               
		//two column area widget
		register_sidebar(array(     
                                       'name' => __('two-columns-region1','nusantara'),     
                                       'description' => __('Two columns area - 1', 'nusantara'),     
                                       'before_widget' => '<div class="six"><div class="line">',     
                                       'after_widget' => '</div></div>',     
                                       'before_title' => '<h3>',     
                                       'after_title' => '</h3>'));
		register_sidebar(array(     
                                       'name' => __('two-columns-region2','nusantara'),     
                                       'description' => __('Two columns area - 2', 'nusantara'),     
                                       'before_widget' => '<div class="six"><div class="line">',     
                                       'after_widget' => '</div></div>',     
                                       'before_title' => '<h3>',     
                                       'after_title' => '</h3>'));

		//Three column area widget
		register_sidebar(array(     
                                      'name' => __('three-columns-region1','nusantara'),     
                                      'description' => __('Three columns area - 1', 'nusantara'),     
                                      'before_widget' => '<div class="four"><div class="line side-home">',     
                                      'after_widget' => '</div></div>',     
                                      'before_title' => '<h3>',     
                                      'after_title' => '</h3>'));
		register_sidebar(array(     
                                      'name' => __('three-columns-region2','nusantara'),     
                                      'description' => __('Three columns area - 2', 'nusantara'),     
                                      'before_widget' => '<div class="four"><div class="line side-home">',     
                                      'after_widget' => '</div></div>',     
                                      'before_title' => '<h3>',     
                                      'after_title' => '</h3>'));
		register_sidebar(array(     
                                      'name' => __('three-columns-region3','nusantara'),     
                                      'description' => __('Three columns area - 3', 'nusantara'),     
                                      'before_widget' => '<div class="four"><div class="line side-home">',     
                                      'after_widget' => '</div></div>',     
                                      'before_title' => '<h3>',     
                                      'after_title' => '</h3>'));

		//four columns area widgets
		register_sidebar(array(     
                                      'name' => __('four-columns-region1','nusantara'),     
                                      'description' => __('Four columns area - 3', 'nusantara'),     
                                      'before_widget' => '<div class="thre"><div class="line side-home">',     
                                      'after_widget' => '</div></div>',     
                                      'before_title' => '<h3>',     
                                      'after_title' => '</h3>'));
		register_sidebar(array(     
                                      'name' => __('four-columns-region2','nusantara'),     
                                      'description' => __('Four columns area - 3', 'nusantara'),     
                                      'before_widget' => '<div class="thre"><div class="line side-home">',     
                                      'after_widget' => '</div></div>',     
                                      'before_title' => '<h3>',     
                                      'after_title' => '</h3>'));
		register_sidebar(array(     
                                      'name' => __('four-columns-region3','nusantara'),     
                                      'description' => __('Four columns area - 3', 'nusantara'),     
                                      'before_widget' => '<div class="thre"><div class="line side-home">',     
                                      'after_widget' => '</div></div>',     
                                      'before_title' => '<h3>',     
                                      'after_title' => '</h3>'));
		register_sidebar(array(     
                                      'name' => __('four-columns-region4','nusantara'),     
                                      'description' => __('Four columns area - 4', 'nusantara'),     
                                      'before_widget' => '<div class="thre"><div class="line side-home">',     
                                      'after_widget' => '</div></div>',     
                                      'before_title' => '<h3>',     
                                      'after_title' => '</h3>'));

		//footer area widgets
		register_sidebar(array(     
                                     'name' => __('footer left','nusantara'),     
                                     'description' => __('footer left area', 'nusantara'),     
                                     'before_widget' => '<div class="thre"><div class="line-below">',     
                                     'after_widget' => '</div></div>',     
                                     'before_title' => '<h3>',     
                                     'after_title' => '</h3>'));
		register_sidebar(array(     
                                    'name' => __('footer midlle','nusantara'),     
                                    'description' => __('footer midle area', 'nusantara'),     
                                    'before_widget' => '<div class="thre"><div class="line-below">',     
                                    'after_widget' => '</div></div>',     
                                    'before_title' => '<h3>',     
                                    'after_title' => '</h3>'));
		register_sidebar(array(     
                                    'name' => __('footer right','nusantara'),     
                                    'description' => __('fotter right area', 'nusantara'),     
                                    'before_widget' => '<div class="thre"><div class="line-below">',     
                                    'after_widget' => '</div></div>',     
                                    'before_title' => '<h3>',     
                                    'after_title' => '</h3>'));
		register_sidebar(array(     
                                    'name' => __('footer right last','nusantara'),     
                                    'description' => __('fotter right area - the last', 'nusantara'),     
                                    'before_widget' => '<div class="thre"><div class="line-below">',     
                                    'after_widget' => '</div></div>',     
                                    'before_title' => '<h3>',     
                                    'after_title' => '</h3>'));
	}
	
// -- Function Name : nusantara_takberjudul
// -- Params : $title
// -- Code Reference: 

	function nusantara_takberjudul($title) {		
		if ($title == '') {
			return 'Untitled';
		} else {
			return $title;
		}
	}
	
// -- Function Name : nusantara_default_menu
// -- Params : 
// -- Code Reference:
 
	function nusantara_default_menu() {
		echo '<ul id="secondary">'. wp_list_pages('title_li=&echo=0') .'</ul>';
	}
	
// -- Function Name : nusantara_secondary_menu
// -- Params : 
// -- Code Reference:
 
	function nusantara_secondary_menu() {
		echo '<ul id="navmenu" class="menu"><li><a href="'. home_url().'" >Home</a>'.'</li></ul>';
	}	

// -- Function Name : nusantara_excerpt_length
// -- Params :  $length 
// -- Code Reference:
 
	function nusantara_excerpt_length( $length ) {
		return 100;
	}

// -- Function Name : nusantara_continue_reading_link
// -- Params : 
// -- Code Reference: 

	function nusantara_continue_reading_link() {
		return '<span class="clear"></span><span class="read-more"><a href="'. esc_url(get_permalink()) . '">' . __( 'Read more &raquo;', 'nusantara' ) . '</a></span>';
	}

// -- Function Name : nusantara_excerpt_more
// -- Params :  $more 
// -- Code Reference: 

	function nusantara_excerpt_more( $more ) {
		return ' &hellip;' . nusantara_continue_reading_link();
	}
	add_theme_support( 'custom-header', array(     
               'default-image'=> get_template_directory_uri() . '/images/logo-nusantara.png',     
               'header-text'=> false,     
               'flex-width'    => true,     
               'width'=> 280,     
               'flex-height'   => true,     
               'height'=> 53));	
	if ( ! function_exists( 'get_custom_header' ) ) {
		define('HEADER_TEXTCOLOR', '');
		define('HEADER_IMAGE', '%s/images/logo-nusantara.png');
		define('HEADER_IMAGE_WIDTH', 280);
		define('HEADER_IMAGE_HEIGHT', 53);
		define('NO_HEADER_TEXT', true);
	}

// -- Function Name : nusantara_comment
// -- Params :  $comment, $args, $depth 
// -- Code Reference: 

	function nusantara_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
				?>
             <li class="post pingback">
<p><?php  _e( 'Pingback:', 'nusantara' ); ?> <?php  comment_author_link(); ?><?php  edit_comment_link( __( 'Edit', 'nusantara' ), '<span class="edit-link">', '</span>' ); ?></p>
<?php
 break;default : ?>
             <li <?php  comment_class(); ?> id="li-comment-<?php  comment_ID(); ?>">
<article id="comment-<?php  comment_ID(); ?>" class="comment">
<footer class="comment-meta">
         <div class="comment-author vcard">
<?php
				$avatar_size = 68;				
				if ( '0' != $comment->comment_parent )    $avatar_size = 39;
				echo get_avatar( $comment, $avatar_size );
				printf( __( '%1$s on %2$s <span class="says">said:</span>', 'nusantara' ),       sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),       sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',       esc_url( get_comment_link( $comment->comment_ID ) ),       get_comment_time( 'c' ),       sprintf( __( '%1$s at %2$s', 'nusantara' ), get_comment_date(), get_comment_time() )));
				?>
<?php  edit_comment_link( __( 'Edit', 'nusantara' ), '<span class="edit-link">', '</span>' ); ?>
         </div>
<?php  if ( $comment->comment_approved == '0' ) : ?>
     <em class="comment-awaiting-moderation"><?php  _e( 'Your comment is awaiting moderation.', 'nusantara' ); ?></em>
<br />
<?php  endif; ?>
</footer>
                     <div class="clearfix"></div>
         <div class="comment-content">
		 <?php  comment_text(); ?>
		 </div>
                     <div class="clearfix"></div>
         <div class="reply alignright">
         <?php  comment_reply_link( array_merge( $args, array( 
                'reply_text' => __( 'Reply <span>&darr;</span>', 'nusantara' ), 
                'depth' => $depth, 
                'max_depth' => $args['max_depth'] ) ) ); ?>
         </div>
                     <div class="clearfix"></div>
</article>
<?php
					break;
				endswitch;
			}

// -- Function Name : nusantara_content_choices
// -- Params : 
// -- Code Reference: 

			function nusantara_content_choices() {
				$nusantara_options = get_option('nusantara_options');				
				if(!empty($nusantara_options['nusantara_content_choices']))        {
					switch($nusantara_options['nusantara_content_choices']) {
						case 1:
							$nusantara_con = the_excerpt();
							break;
						case 2:
							$nusantara_con = the_content(__( '<span class="clearfix"></span><span class="read-more">Read more &raquo;</span>', 'nusantara' ));
							break;
						default:
							$nusantara_con = the_excerpt();
							break;
					}

			} else{
				$nusantara_con = the_excerpt();
			}

			return $nusantara_con;
		}
		
// -- Function Name : nusantara_filter_title
// -- Params :  $filter_title 
// -- Code Reference: 

		function nusantara_filter_title( $title,$sep ) {
			global $paged, $page;
                        
	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'nusantara' ), max( $paged, $page ) );

	return $title;

		}

// -- Function Name : nusantara_content_nav
// -- Params : 
// -- Code Reference:
 
		function nusantara_content_nav() {
			global $wp_query;
	$paged			=	( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link	        =	         get_pagenum_link();
	$url_parts		=	parse_url( $pagenum_link );
	$format			=	( get_option('permalink_structure') ) ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';
	
	if ( isset($url_parts['query']) ) {
		$pagenum_link	=	"{$url_parts['scheme']}://{$url_parts['host']}{$url_parts['path']}%_%?{$url_parts['query']}";
	} else {
		$pagenum_link	.=	'%_%';
	}
	
	$links	=	paginate_links( array(
		'base'		=>	$pagenum_link,
		'format'	=>	$format,
		'total'		=>	$wp_query->max_num_pages,
		'current'	=>	$paged,
		'mid_size'	=>	2,
		'type'		=>	'list'
	) );
	
	if ( $links ) {
		echo "<div class=\"nav-page\">{$links}</div>";
	}
}

// -- Function Name : nusantara_menu_classes
// -- Params :  $classes 
// -- Code Reference: 

   function nusantara_menu_classes( $classes ) {
	$nusantara_options = get_option('nusantara_options');	
	if(!empty($nusantara_options['nusantara_menu_layout']))        {
		switch($nusantara_options['nusantara_menu_layout']) {
			case 'right secondary menu':
				$classes[] = '';
				break;
			case 'left secondary menu':
				$classes[] = 'lmenu';
				break;
			default:
				$classes[] = '';
				break;
		}

} else{
	$classes[] = 'lmenu';
}

return $classes;
}

// -- Function Name : nusantara_menu_primary_classes
// -- Params :  $classes 
// -- Code Reference: 

   function nusantara_menu_primary_classes( $classes ) {
	$nusantara_options = get_option('nusantara_options');	
	if(!empty($nusantara_options['nusantara_primary_menu_layout']))        {
		switch($nusantara_options['nusantara_primary_menu_layout']) {
			case 'left primary menu':
				$classes[] = '';
				break;
			case 'right primary menu':
				$classes[] = 'rprimary';
				break;
			default:
				$classes[] = '';
				break;
		}

} else{
	$classes[] = '';
}

return $classes;
}

// -- Function Name : nusantara_layout_classes
// -- Params :  $classes 
// -- Code Reference: 

    function nusantara_layout_classes( $classes ) {
	$nusantara_options = get_option('nusantara_options');
	if(!empty($nusantara_options['nusantara_layout_flex']))        {
		switch($nusantara_options['nusantara_layout_flex']) {
			case 'fluid responsive':
				$classes[] = 'flex0';
				break;
			case '960px':
				$classes[] = 'flex1';
				break;
			case '900px':
				$classes[] = 'flex2';
				break;
			case '800px':
				$classes[] = 'flex3';
				break;
			case '750px':
				$classes[] = 'flex4';
				break;
			case '700px':
				$classes[] = 'flex5';
				break;
			case '680px':
				$classes[] = 'flex6';
				break;
			case '650px':
				$classes[] = 'flex7';
				break;
			case '550px':
				$classes[] = 'flex8';
				break;
			case '400px':
				$classes[] = 'flex9';
				break;
			case '320px':
				$classes[] = 'flex10';
				break;
			default:
				$classes[] = '';
				break;
		}

} else{
	$classes[] = '';
}

return $classes;
}

// -- Function Name : nusantara_statistics_code
// -- Params : 
// -- Code Reference:
 
   function nusantara_statistics_code() {
	$nusantara_options = get_option('nusantara_options');
	if (!empty($nusantara_options['nusantara_analitic_code'])and $nusantara_options['nusantara_analitic_code'] <> '') {
		echo $nusantara_options['nusantara_analitic_code'];
	}
}

// -- Function Name : nusantara_breadcrumb
// -- I got from responsive theme by emiluzelac, thank's emil this great for bbpress 
// -- bbPress compatibility patch by Dan Smith 

   function nusantara_breadcrumb () {
  
  $nusantara = '<span>&#8250;</span>';
  $home = __('Home','nusantara'); // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div class="breadcrumb">';
 
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $nusantara . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $nusantara . ' '));
      echo $before . __('Archive for ','nusantara') . single_cat_title('', false) . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $nusantara . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $nusantara . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $nusantara . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $nusantara . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $nusantara . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $nusantara . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $nusantara . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $nusantara . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . __('Search results for ','nusantara') . get_search_query() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . __('Posts tagged ','nusantara') . single_tag_title('', false) . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __('All posts by ','nusantara') . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . __('Error 404 ','nusantara') . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','nusantara') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} 
