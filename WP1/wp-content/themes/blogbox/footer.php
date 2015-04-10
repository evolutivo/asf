<?php 
/**
 * Footer Template Part File
 * 
 * Template part file that contains the site footer and
 * closing HTML body elements
 *
 * This file is called by all primary template pages
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php
/* Get the user choices for the theme options */

	global $blogBox_option;
	$blogBox_option = blogBox_get_options(); 
?>
	<div id="footer">
		<div class="footer_col_wrap">
		    <div class="footercol">
		    	<ul>
		    		<?php if ( !dynamic_sidebar('Footer A') ) : ?>
		    	    	<li><?php _e('This column is a widget area.','blogBox'); ?><br/><span class="alert"><?php _e('Add widgets to Footer A, something, anything!','blogBox'); ?></span></li>
		    		<?php endif; ?>
		    	</ul>
		    </div>
		    <div class="footercol">
		    	<ul>
		    		<?php if ( !dynamic_sidebar('Footer B') ) : ?>
		    			<li><?php _e('This column is a widget area.','blogBox'); ?><br/><span class="alert"><?php _e('Add widgets to Footer B, something, anything!','blogBox'); ?></span></li>
		    		<?php endif; ?>
		    	</ul>
		    </div>
		    <div class="footercol">
		    	<ul>
		    		<?php if ( !dynamic_sidebar('Footer C') ) : ?>
		    			<li><?php _e('This column is a widget area.','blogBox'); ?><br/><span class="alert"><?php _e('Add widgets to Footer C, something, anything!','blogBox'); ?></span></li>
		    		<?php endif; ?>
		    	</ul>
		   	</div>
		    <div class="footercol">
		    	<ul>
		    		<?php if ( !dynamic_sidebar('Footer D') ) : ?>
		    			<li><?php _e('This column is a widget area.','blogBox'); ?><br/><span class="alert"><?php _e('Add widgets to Footer D, something, anything!','blogBox'); ?></span></li>
		    		<?php endif; ?>
		    	</ul>
		    </div>
		</div>
		    <div class="clearfix"></div>
			<?php if ( wp_kses_post(stripslashes($blogBox_option['bB_left_copyright_text'])) != '' || wp_kses_post(stripslashes($blogBox_option['bB_middle_copyright_text'])) != '' || wp_kses_post(stripslashes($blogBox_option['bB_right_copyright_text'])) !='' ) { ?>
			<div id="copyright">
				<span class="copyright_c1"><?php echo wp_kses_post(stripslashes($blogBox_option['bB_left_copyright_text'])); ?></span>
				<span class="copyright_c2"><?php echo wp_kses_post(stripslashes($blogBox_option['bB_middle_copyright_text'])); ?></span>
				<span class="copyright_c3"><?php echo wp_kses_post(stripslashes($blogBox_option['bB_right_copyright_text'])); ?></span>
			</div>
			<?php } ?>
	</div>
</div>	
<?php wp_footer(); ?>
</body>
</html>