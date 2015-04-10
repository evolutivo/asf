<?php
if ( !defined('ABSPATH')) exit;
add_action('init','nusantara_options');
        // -- Function Name : nusantara_options
	// -- Params : 
	// -- Purpose :
function nusantara_options()
	{
		
		//Homepage section blocks for the layout manager
	      $nusantara_homepage_batavia = array
		( 
			
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_block_area1"	=> __('slider, description, button','nusantara'),
                                "nusantara_big_heading"	=> __('Description intro one column','nusantara'),
                                "nusantara_aside_testimoni"	=> __('Testimonial Regions','nusantara'),                                
                                "nusantara_three_column" => __('Three column area widget', 'nusantara'),
                                "nusantara_two_column"	=> __('Two column area widget','nusantara'),                                				
                                "nusantara_footer_batavia" => __('Footer four columns area widget','nusantara'),                                                                               

			),
                        "disabled" => array (
				"komodo" => "komodo",                                
				"nusantara_one_column"	=> __('One column area widget','nusantara'),
                                "nusantara_four_column"	=> __('Four column area widget','nusantara'),                                     
			), 
		);

              $nusantara_homepage_andalas = array
		( 			
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_intro_andalas"	=> __('Slider, descriptions, heading, button','nusantara'),                              
                                "nusantara_content_andalas"	=> __('Content Three columns','nusantara'),
                                "nusantara_two_column_andalas"	=> __('two column area widget','nusantara'),
                                "nusantara_andalas_footer"	=> __('Sidebar footer','nusantara'),
                               
			),
                        "disabled" => array (
				"komodo" => "komodo",                                
				"nusantara_one_column_andalas"	=> __('One column area widget','nusantara'),                                
				"nusantara_four_column_andalas"	=> __('Four column area widget','nusantara'),
                                
			), 
		);
            
              $nusantara_homepage_java = array
		( 
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_content_java"	=> __('Article regions','nusantara'),                              
                                "nusantara_sidebar_java"	=> __('sidebar one column','nusantara'),                                
                                "nusantara_footer_java"	        => __('footer sidebar','nusantara'),
                              
                        ),
                        "disabled" => array (
				"komodo" => "komodo",  
                                                                				                               				                               
			), 
		);

              $nusantara_homepage_borneo = array
		( 
			
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_slider_borneo" => __('Slider responsive area','nusantara'),
                                "nusantara_borneo_content"	=>__('Content box and sidebar','nusantara'),                                
                                "nusantara_footer_borneo"	=> __('Sidebar footer','nusantara'),
                               
			),
                        "disabled" => array (
				"komodo" => "komodo",                                 
                                "nusantara_two_borneo"	  => __('two column area widget','nusantara'),
				"nusantara_three_borneo"  => __('three column area widget','nusantara'),
                                "nusantara_four_borneo"	  => __('Four column area widget','nusantara'),
                                
			), 
		);

              $nusantara_homepage_sabang = array
		( 
			
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_sabang_content"	=>__('content','nusantara'),                                
                                "nusantara_footer_sabang"	=> __('Sidebar footer','nusantara'),
                               
			),
                        "disabled" => array (
				"komodo" => "komodo", 
                                "nusantara_slider_sabang"	=> __('Slider responsive area','nusantara'),
                                                                
			), 
		);

              $nusantara_homepage_celebes = array
		( 
			
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_left_celebes"	=> __('left sidebar','nusantara'), 
                                "nusantara_content_celebes"	=> __('Content area post','nusantara'),                                                               
                                "nusantara_right_celebes"	=> __('right sidebar','nusantara'),
                                "nusantara_footer_celebes"	=> __('footer sidebar','nusantara'),
                              
                               
			),
                      "disabled" => array (
				"komodo" => "komodo",                               
				                               				                                
			), 
		);

              $nusantara_single_post = array
		( 
		        "enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_content_post"	=> __('Content area post','nusantara'),                              
                                "nusantara_sidebar_single"	=> __('sidebar one and two','nusantara'),
                                "nusantara_footer_single"	=> __('footer sidebar','nusantara'),
                                                                   
                        ),

                       "disabled" => array (
				"komodo" => "komodo",
                                                            				                               				                                
			), 
		);

              $nusantara_single_ntt = array
		( 
			
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_ntt_left"	=> __('left sidebar','nusantara'), 
                                "nusantara_content_ntt"	=> __('Content area post','nusantara'),                                                               
                                "nusantara_ntt_right"	=> __('right sidebar','nusantara'),
                                "nusantara_footer_nusa"	=> __('footer sidebar','nusantara'),
                              
                               
			),
                      "disabled" => array (
				"komodo" => "komodo",                               
				                               				                                
			), 
		);

              $nusantara_single_celebes = array
		( 
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_content_celebes"	=> __('Content area post','nusantara'),                                                               
                                "nusantara_footer_celebes"	=> __('footer sidebar','nusantara'),
                              
                               
			),
                        "disabled" => array (
				"komodo" => "komodo",              
                   				                               				                               
			), 
		);

              $nusantara_search_page = array
		( 
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_content_search"	=> __('Content area post','nusantara'),                                                               
                                "nusantara_sidebar_search"	=> __('sidebar','nusantara'),
                                "nusantara_footer_search"	=> __('footer sidebar','nusantara'),
                              
                               
			),
                        "disabled" => array (
				"komodo" => "komodo",              
                   				                               				                               
			), 
		);
             
              $nusantara_site_map = array
		( 
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_content_sitemap"	=> __('Content area post','nusantara'),                                                               
                                "nusantara_sidebar_sitemap"	=> __('sidebar','nusantara'),
                                "nusantara_footer_sitemap"	=> __('footer sidebar','nusantara'),
                              
                               
			),
                        "disabled" => array (
				"komodo" => "komodo",             
                   				                               				                               
			), 
		);

              $nusantara_single_page = array
		( 
		        "enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_content_page"	=> __('Content area post','nusantara'),                              
                                "nusantara_sidebar_page"	=> __('sidebar one and two','nusantara'),                                 
                                "nusantara_footer_page" 	=> __('footer sidebar','nusantara'),
                              
                        ),

                       "disabled" => array (
				"komodo" => "komodo",                                
				                               				                                
			), 
		);

              $nusantara_page_3coloumn = array
		( 
			
			"enabled" => array (
				"komodo" => "komodo", 
                                "nusantara_left_page3column"	=> __('left sidebar','nusantara'), 
                                "nusantara_content_page3column"	=> __('Content area post','nusantara'),                                                               
                                "nusantara_right_page3column"	=> __('right sidebar','nusantara'),
                                "nusantara_footer_page3column"	=> __('footer sidebar','nusantara'),
                              
                               
			),
                      "disabled" => array (
				"komodo" => "komodo",                               
				                               				                                
			), 
		);

              $nusantara_header_section = array
		( 
			
			"enabled" => array (
				"komodo" => "komodo", 
				"nusantara_header_area1"	=> __('Primary menu','nusantara'),
                                "nusantara_header_area2"	=> __('Title and search form','nusantara'),
                                "nusantara_header_area3"	=> __('secondary menu','nusantara'),
                               
			),
                        "disabled" => array (
				"komodo" => "komodo",
				
                        ), 
		);		
		
                //options for primary menu and secondary menu
                $nusantara_primary_menu = array("left primary menu","right primary menu");
                $nusantara_secondary_menu = array("right secondary menu","left secondary menu");
		$nusantara_selection_width = array("Select a layout width:","fluid responsive","960px","900px","800px","750px","700px","680px","650px","550px","400px","320px");				
                $nusantara_body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$nusantara_positioning = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Single post sidebar aligment
		$nusantara_single_sidebar = array("single post two column" => "single post two column","single post three column" => "single post three column","single post one column" => "single post one column"); 
		
                // Alignment text
		$nusantara_text_align = array("alignleft" => "left","alignright" => "right","aligncenter" => "center"); 
                $nusantara_slide_flex = array(
                                      __('select your effect','nusantara'),
                                      __('Fade effect responsive','nusantara')=>"Fade effect",
                                      __('Slide effect responsive','nusantara')=>"Slide effect"); 
		
// Set the Options Tabber
global $nusantara_options;
$nusantara_options = array();  
$nusantara_options[] = array(
    "name" => __('Introductions', 'nusantara'),
    "type" => "heading"
);

$nusantara_options[] = array(
    "desc" => "",
    "id" => "",
    "std" => __('<p class="bigo">Welcome to Nusantara WordPress Theme</p>
            <p class="intro-admin centering">Thank you for choice Nusantara WordPress theme, you might think the theme is hard to use,
actually its not, you probably just might jump to the options page and explore everything yourself. You can get all documentations for Nusantara theme on my website <a href="http://amdhas.com/">amdhas.com</a>.  If you have any questions, please feel free to post your questions on my support forum at <a href="http://amdhas.com/support/">http://amdhas.com/support</a>. You can also upgrade this theme to <a href="http://amdhas.com/shop">premium version</a>. Thanks so much!</p>
           
   <div class="clear"></div>
', 'nusantara'),
    "type" => "info"
); 

// LOGICAL ELEMENT CONFIGURATIONS
$nusantara_options[] = array(
    "name" => __('Logical Element', 'nusantara'),
    "type" => "heading"
);

$nusantara_options[] = array(
    "std" => __('<div class="bigo">TWO MAGIC BUTTON!</div>
                                                     <p class="intro-admin centering">You should enable both of them, if you disable logical element you can not setup your element like font, border, margin, color, menu, etc.</p>
                                                      <p class="intro-admin centering">This very important for your Nusantara Theme, If you want make elegant site without open your code file.</p>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Logical Element', 'nusantara'),
    "desc" => __('<b>Click here to enable Logical Element</b>', 'nusantara'),
    "id" => "nusantara_remove_logicale",
    "std" => "1",
    "folds" => 1,
    "type" => "checkbox"
);

$nusantara_options[] = array(
    "desc" => "",
    "id" => "",
    "fold" => "nusantara_remove_logicale",
    "std" => __('<div class=bigo>The best way to create dynamic CSS for your theme</div>
            <p class="intro-admin centering">Source article : <a href="http://vatuma.com/tutorials-tips-and-tricks/for-developers/creating-dynamic-css-for-wp-theme.html">vatuma.com</a></p>                                                  
            <p>When you design your own WordPress theme you probably use an option page with options that affect your theme appearance. If so, you need to create dynamic css for the theme and insert it into pages. When you make the call to get the page, it creates the page and outputs all the dynamic stuff in one shot. Some people find the CSS in the html to be aesthetically displeasing, but the fact of the matter is that this is the fastest, simplest, and best way to do it.</p><p>The most sensible thing to do is to go ahead and generate the dynamic part of the CSS right now as well. Just make that dynamic part as small as possible. Minify it into one-line if you want. Note that WordPress itself uses this metodh for the custom background image and custom header image stuff. It does it this way because it is the best way to do it.</p><div class="clear"></div>', 'nusantara'),
    "type" => "info"
);

$nusantara_options[] = array(
    "name" => __('Compressor', 'nusantara'),
    "desc" => __('<b>Click here to Enable Compression</b>', 'nusantara'),
    "id" => "nusantara_compress",
    "std" => 0,
    "type" => "checkbox"
);

// YOU CAN GO ON THE TAB HERE
require_once dirname( __FILE__ ) . '/tab/landing.php';
require_once dirname( __FILE__ ) . '/tab/general.php';
require_once dirname( __FILE__ ) . '/tab/section-header.php';
require_once dirname( __FILE__ ) . '/tab/menu-element.php';
require_once dirname( __FILE__ ) . '/tab/batavia.php';
require_once dirname( __FILE__ ) . '/tab/java.php';
require_once dirname( __FILE__ ) . '/tab/andalas.php';
require_once dirname( __FILE__ ) . '/tab/borneo.php';
require_once dirname( __FILE__ ) . '/tab/papua.php';
require_once dirname( __FILE__ ) . '/tab/celebes.php';
require_once dirname( __FILE__ ) . '/tab/slider.php';
require_once dirname( __FILE__ ) . '/tab/single-layout.php';
require_once dirname( __FILE__ ) . '/tab/page-templates.php'; 
require_once dirname( __FILE__ ) . '/tab/search-page.php';        
require_once dirname( __FILE__ ) . '/tab/network.php'; 
require_once dirname( __FILE__ ) . '/tab/ads-tab.php';
require_once dirname( __FILE__ ) . '/tab/backup.php';                                                          					
	}
