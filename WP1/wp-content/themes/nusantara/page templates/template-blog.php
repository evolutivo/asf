<?php 
if ( !defined('ABSPATH')) exit;
/*
Template Name: Blog Template
*/
get_header();?>
<?php
    if ( get_query_var('paged') )
	    $paged = get_query_var('paged');
	elseif ( get_query_var('page') ) 
	    $paged = get_query_var('page');
	else 
		$paged = 1;
		query_posts("post_type=post&paged=$paged"); 
?>  
<div class="clear"></div>
<section class="row">
<section class="excerpt">  
<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>         
                <h1 class="title-excerpt"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'nusantara'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h1>           
                <div class="post-meta">
                <div class="alignleft postmeta_links">
                 <?php
              printf( __( '<span class="%1$s">Posted on</span> %2$s by %3$s', 'nusantara' ),'meta-prep meta-prep-author',
                      sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
                               get_permalink(),
                               esc_attr( get_the_time() ),
                               get_the_date()
                              ),
                      sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                               get_author_posts_url( get_the_author_meta( 'ID' ) ),
                               sprintf( esc_attr__( 'View all posts by %s', 'nusantara' ), get_the_author() ),
                               get_the_author()
                              )
                     );
                 ?>          
             </div>  
  
     <div class="alignright postcomments">
     <a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'nusantara'),__('One comment','nusantara'),__('% comments','nusantara')); ?></a>
     </div>
                </div><!-- end of .post-meta -->
                
<div class="entry clearfix">
                 <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft thumbnail')); ?>
                 <?php the_excerpt(); ?>
 <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'nusantara' ) . '</span>', 'after' => '</div>' ) ); ?>
                    </div>   
                                                                                                                   
             <div class="clear"></div>
        <?php endwhile; ?> 
        
        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <div id="nav-below" class="navigation">
					<div class="nav-previous alignleft"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Next', 'nusantara' )) ?></div>
					<div class="nav-next alignright"><?php previous_posts_link(__( 'Previous <span class="meta-nav">&raquo;</span>', 'nusantara' )) ?></div>
				</div>
        <?php endif; ?>

	    <?php else : ?>

        <div class="entry">
                 <p>
                 <?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'nusantara'); ?>
                 </p>
             </div>    
        
<?php endif; ?>  
 </div>
        </div></div> </div></div>
       
</section>

<section id="javaside" class="side-right"> 
<?php get_sidebar('1c'); ?>
<?php get_sidebar('2c'); ?>
</section>
</section>
<?php get_template_part( 'footer', 'content' ); ?>
<?php 
get_footer();?>