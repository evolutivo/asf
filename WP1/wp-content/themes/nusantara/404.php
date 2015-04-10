       <?php 
if ( !defined('ABSPATH')) exit;
get_header(); 
?>
       
</head>
       
<div class="row centering bigo">

		<h2>
       <?php _e('404 Error: Not found', 'nusantara'); ?>
	   </h2>
       <p>
       <?php _e('The page you trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for', 'nusantara'); ?>
	   </p>
</div>	

					
       <?php get_template_part( 'footer', 'content' ); ?>	
       <?php get_footer(); ?>