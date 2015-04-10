<?php 
if ( !defined('ABSPATH')) exit;
get_header(); 
?>
     <div class="row">
     <div class="excerpt">
     <h2 class="arh">
        <?php
        if ( is_day() ) {
          printf( __( 'Daily Archives: %s', 'nusantara' ), '<span>' . get_the_date() . '</span>' );
        } elseif ( is_month() ) {
          printf( __( 'Monthly Archives: %s', 'nusantara' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'nusantara' ) ) . '</span>' );
        } elseif ( is_year() ) {
          printf( __( 'Yearly Archives: %s', 'nusantara' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'nusantara' ) ) . '</span>' );
        } elseif ( is_tag() ) {
          printf( __( 'Tag Archives: %s', 'nusantara' ), '<span>' . single_tag_title( '', false ) . '</span>' );
          // Show an optional tag description
          $tag_description = tag_description();
          if ( $tag_description )
            echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
        } elseif ( is_category() ) {
          printf( __( 'Category Archives: %s', 'nusantara' ), '<span>' . single_cat_title( '', false ) . '</span>' );
          // Show an optional category description
          $category_description = category_description();
          if ( $category_description )
            echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
        } else {
          _e( 'Blog Archives', 'nusantara' );
        }
?>
     </h2>

                                 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>   
 
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
     <h2 class="title-excerpt"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
             <div class="postmeta">
                 <div class="postmeta_links">
            <?php
            printf( __( '<span class="%1$s">Posted on</span> %2$s by %3$s', 'nusantara' ),'meta-prep meta-prep-author',
                    sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
                             get_permalink(),
                             esc_attr( get_the_time() ),
                             get_the_date()
                            ),
                    sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', get_author_posts_url( get_the_author_meta( 'ID' ) ),
                             sprintf( esc_attr__( 'View all posts by %s', 'nusantara' ), get_the_author() ),
                             get_the_author()
                            )
                   );
?>
                 </div>
     <div class="postcomments">
     <a href="<?php the_permalink() ?>#comments"><?php comments_number(__('No comments', 'nusantara'),__('One comment','nusantara'),__('% comments','nusantara')); ?></a>
     </div>
                     <div class="clearfix"></div>
     </div>
         <div class="entry">
             <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
             <?php the_excerpt(); ?>
                     <div class="clearfix"></div>
         </div>
                
         <div class="postinfo">
             <?php _e('Category: ', 'nusantara'); the_category(', ') ?> |
             <?php if (get_the_tags()) the_tags(__('Tags: ', 'nusantara'), ', '); ?>
         </div>                      
             </div>
                     <div class="clear"></div>
<?php endwhile; ?>
<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous alignleft"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Next', 'nusantara' )) ?></div>
					<div class="nav-next alignright"><?php previous_posts_link(__( 'Previous <span class="meta-nav">&raquo;</span>', 'nusantara' )) ?></div>
				</div>
<?php } ?>  
        <?php endif; ?>                                                            
         </div>
<section class="side-right"> 
<?php get_sidebar('1c'); ?>
</section>
<?php get_template_part( 'footer', 'content' ); ?>
<?php get_footer(); ?>