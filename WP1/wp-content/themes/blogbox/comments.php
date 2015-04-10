<?php
/**
 * Category Page template file
 *
 * This file delivers all the comments, pingbacks, trackbacks, and the 
 * comment form when called. It is the default file called in the comments_template() call
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!','blogBox') );

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','blogBox'); ?></p>
	<?php
		return;
	}
?>

<?php if(comments_open()) { ?>
	<?php $number_comments = count($wp_query->comments_by_type['comment']); ?>
	<h4 id="comments"><?php If($number_comments==0){ echo 'No Comments Yet';}elseif($number_comments==1){echo '1 Comment So Far';}else{echo $number_comments.' Comments';}  ?></h4>
	<div class="commentlist">
		<?php wp_list_comments('type=comment&avatar_size=64&style=div'); ?>
	</div>
	<div class="commentnav">
		<div class="left"><?php previous_comments_link() ?></div>
		<div class="right"><?php next_comments_link() ?></div>
	</div>
	<?php if(!empty($comments_by_type['pings']) && pings_open() ) : ?>
		<h4 is="comments">Pings and Trackbacks (<?php echo count($wp_query->comments_by_type['pings']); ?> )</h4>
		<ul class="pingslist">
			<?php wp_list_comments('type=pings&callback=blogBox_cleanPings'); ?>
		</ul>
	<?php endif; ?>

<?php } else {  ?>
			<p class="nocomments"><?php _e('Comments are closed.','blogBox'); ?></p>
	<?php } ?>

<?php comment_form(); ?>