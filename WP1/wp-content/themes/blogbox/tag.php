<?php
/**
 * Tag Page WordPress file
 *
 * This file is used when a tag link is clicked
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>
<div id="widecolumn">
	<h1 class="listhead"><?php _e('Posts for Tag : ','blogBox'); ?><?php single_cat_title(); ?></h1>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="postmeta">
				<span class="timestamp"><?php the_time('M j, Y'); ?></span>
				<span class="author"><?php _e('By:','blogBox'); the_author_posts_link(); ?></span>
				<span class="categories"><?php _e('In:','blogBox'); the_category(', '); ?></span>
				<?php if ( comments_open()) { ?>
					<span class="comments"><a href="<?php comments_link(); ?>"><?php _e('Comments','blogBox'); ?> [<?php echo get_comments_number(); ?>]</a></span>
				<?php } ?>
			</div>
			<?php  if (has_post_thumbnail()) {
        		the_post_thumbnail(array(600,600));
    		} ?>
			<div class="entry">
				<?php the_content(__('Read more','blogBox')); ?>
			</div>
			<div class="postmetabottom">
				<span class="pagelist"><?php $page_text = __('Pages','blogBox'); wp_link_pages('before='.$page_text.':&after='); ?></span>
				<span class="edit"><?php edit_post_link(__('Edit','blogBox')); ?></span>
				<span class="taglist"><?php the_tags(__('Tags: ','blogBox')); ?></span>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php endwhile; ?>
			<?php if(function_exists('wp_pagenavi')) {
 				echo '<div class="postpagenav">';
 					wp_pagenavi();
				echo '</div>';
			} else { ?>
			<div class="postpagenav">
				<div class="left"><?php next_posts_link('<< older entries'); ?></div>
				<div class="right"><?php previous_posts_link(' newer entries >>'); ?></div>
			<br/>
			</div>
			<?php } ?>
	<?php else : ?>
		<!-- search found nothing -->
		<div class="nosearch">
			<h2><?php _e('Sorry about that but we didn\'t find anything posted with that tag!','blogBox'); ?></h2>
			<p><?php _e('You may want to try another tag.','blogBox'); ?></p>
			<h2><?php _e('Something to read?','blogBox'); ?></h2>
			<p><?php _e('Want to read something else? These are the latest posts:','blogBox'); ?><br/><br/></p>
			<ul><?php wp_get_archives('type=postbypost&limit=20&format=html'); ?></ul>
			<p></p>
		</div>
	<?php endif; ?>
	<br/>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>