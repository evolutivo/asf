<?php
/**
 * Template Name: Blog Home Page
 * 
 * The template for displaying an alternative to the the theme's static home page.
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<?php 	
	global $blogBox_option;
	$blogBox_option = blogBox_get_options();
?>

<div id="fullwidth">
	<?php if(sanitize_text_field($blogBox_option['bB_home1feature_options']) !== "No feature") { ?>
	<?php if(sanitize_text_field($blogBox_option['bB_home1feature_options']) == "Full feature slides") { ?>
	<div id="fullfeature">
		<div id="slides_full">
		    <div class="slides_container">
				<?php
					$category_ID = get_cat_ID('Feature');
					global $post;
					$args = array('category'=>$category_ID,'numberposts'=>999); 
					$custom_posts = get_posts($args);
					if ($category_ID !== 0 && $custom_posts){
						foreach($custom_posts as $post) : setup_postdata($post);
							if (has_post_thumbnail()) {
			 					echo '<a href="';the_permalink();echo '" title="';the_title_attribute(); echo '" >';
	  									the_post_thumbnail(array(850,425));
	      							echo '</a>';
		   					}
						endforeach;
					}
					else{
						echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="Default Feature Slide" title="Default Feature Slide" width="850" height="425" />';
					}
	    		?>
			</div>
		</div>
	</div>
	<?php } //close bracket for full feature slides option ?>
	<?php if(sanitize_text_field($blogBox_option['bB_home1feature_options']) == "Small slides and feature text box") { ?>
	<div id="leftfeature">
		<h1><?php echo stripslashes($blogBox_option['bB_left_feature_title']); ?></h1>
		<p><?php echo wp_kses_post(stripslashes($blogBox_option['bB_left_feature_text'])); ?></p>
	</div>
	<div id="rightfeature">
		<div id="slides">
		    <div class="slides_container">
				<?php
					$category_ID = get_cat_ID('Feature');
					global $post;
					$args = array('category'=>$category_ID,'numberposts'=>999);
					$custom_posts = get_posts($args);
					if ($category_ID !== 0 && $custom_posts){
						foreach($custom_posts as $post) : setup_postdata($post);
							if (has_post_thumbnail()) {
			 					echo '<a href="';the_permalink();echo '" title="';the_title_attribute(); echo '" >';
	  									the_post_thumbnail(array(550,275));
	      							echo '</a>';
		   					}
						endforeach;
					}
					else{
						echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="Default Feature Slide" title="Default Feature Slide" width="550" height="275" />';
					}
	    		?>
	  		</div>
		</div>
	</div>
	<?php } // close bracket for small feature option ?>
	<?php } //close bracket for no feature option ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="home1post">	
			<div class="post">
				<div class="entry">
					<?php the_content('Read more'); ?>
				</div>
			</div>
		</div>
 	<?php endwhile; else : endif; ?>
	
	<?php if ($blogBox_option['bB_home1section1_onoroff'] == 1) { ?>
	<div id="home1section1">
		<div id="slogan1">
			<h1><?php echo stripslashes($blogBox_option['bB_home1section1_slogan']); ?></h1>
		</div>
		<div id="homebuttonbox">
			<div id="button1">
				<a href="<?php if(esc_url($blogBox_option['bB_contact_link']) ==""){echo'#';}else{echo esc_url($blogBox_option['bB_contact_link']);}?>"><?php _e('Contact Me','blogBox'); ?></a>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if ($blogBox_option['bB_home1section2_onoroff'] == 1) { ?>
	<div id="homesection2">
		<div id="servicebox1" onclick="window.location='<?php echo esc_url($blogBox_option['bB_home1service1_link']); ?>'">
			<?php if(esc_url($blogBox_option['bB_home1service1_image'] !== "")) echo '<img class="servicebox" src="'.esc_url($blogBox_option['bB_home1service1_image']).'" alt="Service 1 Image" />'; ?>
			<?php if(stripslashes($blogBox_option['bB_home1service1_title'] !== "")) echo '<h4>'.stripslashes($blogBox_option['bB_home1service1_title']).'</h4>'; ?>
			<?php if(wp_kses_post(stripslashes($blogBox_option['bB_home1service1_text'] !== ""))) echo '<p>'.wp_kses_post(stripslashes($blogBox_option['bB_home1service1_text'])).'</p>'; ?>
		</div>
		<div id="servicebox2" onclick="window.location='<?php echo esc_url($blogBox_option['bB_home1service2_link']); ?>'">
			<?php if(esc_url($blogBox_option['bB_home1service2_image'] !== "")) echo '<img class="servicebox" src="'.esc_url($blogBox_option['bB_home1service2_image']).'" alt="Service 2 Image" />'; ?>
			<?php if(stripslashes($blogBox_option['bB_home1service2_title'] !== "")) echo '<h4>'.stripslashes($blogBox_option['bB_home1service2_title']).'</h4>'; ?>
			<?php if(wp_kses_post(stripslashes($blogBox_option['bB_home1service2_text'] !== ""))) echo '<p>'.wp_kses_post(stripslashes($blogBox_option['bB_home1service2_text'])).'</p>'; ?>
		</div>
		<div id="servicebox3" onclick="window.location='<?php echo esc_url($blogBox_option['bB_home1service3_link']); ?>'">
			<?php if(esc_url($blogBox_option['bB_home1service3_image'] !== "")) echo '<img class="servicebox" src="'.esc_url($blogBox_option['bB_home1service3_image']).'" alt="Service 3 Image" />'; ?>
			<?php if(stripslashes($blogBox_option['bB_home1service3_title'] !== "")) echo '<h4>'.stripslashes($blogBox_option['bB_home1service3_title']).'</h4>'; ?>
			<?php if(wp_kses_post(stripslashes($blogBox_option['bB_home1service3_text'] !== ""))) echo '<p>'.wp_kses_post(stripslashes($blogBox_option['bB_home1service3_text'])).'</p>'; ?>
		</div>
	</div>
	<?php } ?>
	<?php if ($blogBox_option['bB_home1section3_onoroff'] == 1) { ?>
	<div id="slogan2">
		<p class="slogan2line1"><?php echo stripslashes($blogBox_option['bB_home1section3_slogan']); ?></p>
		<p class="slogan2line2"><?php echo stripslashes($blogBox_option['bB_home1section3_subslogan']); ?></p>
	</div>
	<?php } ?>
<div id="full_divider"><img src="<?php echo get_template_directory_uri(); ?>/images/full_divider.png" alt="" /></div>
<div id="widecolumn">

	<?php
		$exclude_categories = blogBox_exclude_categories();
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query('cat='.$exclude_categories.'&paged='.$paged);
		if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2>
					<?php if(is_sticky()) {echo '<img src="'.get_template_directory_uri().'/images/clip.png" alt="" />';} ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="postmeta">
					<span class="timestamp"><?php the_time('M j, Y'); ?></span>
					<span class="author"><?php _e('By:','blogBox');the_author_posts_link(); ?></span>
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
					<?php if(get_the_title()=="") echo '<a href="'.get_permalink().'" rel="bookmark" title="Untitled Link" >'.__("Single Page Link","blogBox").'</a>'; ?>
				</div>
			</div>
		<?php endwhile; ?>
			<?php if(function_exists('wp_pagenavi')) {
 				echo '<div class="postpagenav">';
 					wp_pagenavi();
				echo '</div>';
			} else { ?>
			<div class="postpagenav">
				<div class="left"><?php next_posts_link(__('<< older entries','blogBox') ); ?></div>
				<div class="right"><?php previous_posts_link(__(' newer entries >>','blogBox') ); ?></div>
			<br/>
			</div>
			<?php } ?>
			<?php $wp_query = null; $wp_query = $temp;?>
		<?php else : ?>
		<?php endif; ?>

		<br/>
	</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>