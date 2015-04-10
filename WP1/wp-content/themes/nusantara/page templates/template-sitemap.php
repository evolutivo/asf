<?php 
if ( !defined('ABSPATH')) exit;
/*
Template Name: Sitemap Template
*/

get_header(); ?>                   
<?php
  global $nusantara_options;
$nusantara_options = get_option('nusantara_options');
$sitemap_page = $nusantara_options['nusantara_site_map']['enabled'];
if ($sitemap_page): foreach ($sitemap_page as $peta=>$daerah) {
switch($peta) {
case 
'nusantara_content_sitemap': ?>                  
<div class="row">
<section class="six">
<?php echo nusantara_breadcrumb(); ?>
</section>
<div class="clear"></div>
<?php
         break;
         case 'nusantara_sidebar_sitemap':?>			
<section class="six">
<div class="side-home">
<h3><?php _e('Latest Posts', 'nusantara'); ?></h3>
                            <ul><?php $archive_query = new WP_Query('posts_per_page=-1');
                                    while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'nusantara'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
                                        </li>
                                    <?php endwhile; ?>
                            </ul>
     
                 </div>
                   </section>
		  <section class="four">
<div class="side-home">   
        <h3><?php _e('Pages', 'nusantara'); ?></h3>      
	<ul><?php wp_list_pages("title_li=" ); ?></ul>               	           	
	               </div>
		      </section>
</div>     
<div class="clearfix"></div>
       <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'nusantara' ) . '</span>', 'after' => '</div>' ) ); ?>
<div class="clearfix"></div>         
<div class="alignleft">
       <?php if (!is_attachment()) {previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'nusantara' ) . '</span> %title' );} else {previous_image_link(array( 64, 64 ));}; ?>
</div>
<div class="alignright">
       <?php if (!is_attachment()) {next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'nusantara' ) . '</span>' );} else { next_image_link(array( 64, 64 ));}; ?>
</div>     
<?php
         break;
         case 'nusantara_footer_sitemap':?> 
<?php get_template_part( 'footer', 'content' ); ?>

<?php 
        break; 
        } 
 } 

endif; ?>   
                   <?php get_footer(); ?>	               