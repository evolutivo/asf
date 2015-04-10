<?php
/**
 * Single Page WordPress file
 *
 * This file is the Singe Page template file, which is output a single post
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
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php if (is_attachment()) { ?>
				<p class="attachmentnav"><< Back to <a href="<?php echo get_permalink($post->post_parent); ?>" title="<?php echo get_the_title($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a></p>
			<?php } else { ?>
				<div class="postmeta">
					<span class="timestamp"><?php the_time('M j,Y'); ?> </span>
					<span class="author"><?php _e('By:','blogBox'); the_author_posts_link(); ?></span>
					<span class="categories"><?php _e('In:','blogBox'); the_category(', '); ?></span>
					<?php if ( comments_open()) { ?>
						<span class="comments"><a href="<?php comments_link(); ?>"><?php _e('Comments','blogBox'); ?> [<?php echo get_comments_number(); ?>]</a></span>
					<?php } ?>
				</div>
			<?php } ?>
			<br/>
			<?php  if (has_post_thumbnail()) {
        		the_post_thumbnail(array(600,600));
    		} ?>
			<div class="entry">
				<?php the_content(__('Read more','blogBox')); ?>
			</div>
			<div class="clearfix"></div>
			<div class="postmetabottom">
				<span class="pagelist"><?php $page_text = __('Pages','blogBox'); wp_link_pages('before='.$page_text.':&after='); ?></span>
				<span class="edit"><?php edit_post_link(__('Edit','blogBox')); ?></span>
				<span class="taglist"><?php the_tags(__('Tags: ','blogBox')); ?></span>
			</div>
		</div>
		<?php comments_template('', true); ?>
		<?php endwhile; ?>
			<div class="postpagenav">
			<?php if (is_attachment()) { ?>
				<div class="left"><?php next_image_link('','&#60;&#60; View previous'); ?></div>
				<div class="right"><?php previous_image_link('','View next &#62;&#62;'); ?></div>
			<?php } else { ?>
				<?php next_post_link('<div class="right">%link &#62;&#62;</div>'); ?> 
				<?php previous_post_link('<div class="left">&#60;&#60; %link</div>'); ?> 
			<?php } ?>
			<br/>
			</div>
	<?php else : ?>
		<!-- Couldn't find the post -->
		<div class="nosearch">
			<h2><?php _e('Sorry about that - we couldn\'t find the post. Da link is not Da link!','blogBox'); ?></h2>
			<p><?php _e('Don\'t know why, but contact us and we\'ll look into it.','blogBox'); ?></p>
			<h2><?php _e('Something to read?','blogBox'); ?></h2>
			<p><?php _e('Want to read something else? These are the latest posts:','blogBox'); ?><br/><br/></p>
			<ul><?php wp_get_archives('type=postbypost&limit=20&format=html'); ?></ul>
		</div>
	<?php endif; ?>
	<br/>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>