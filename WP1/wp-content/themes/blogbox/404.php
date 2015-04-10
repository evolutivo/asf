<?php
/**
 * Error 404 Page template file
 *
 * This file is the Error 404 Page template file, which is output whenever
 * the server encounters a "404 - file not found" error.
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<div id="widecolumn">
	<div id="error">
		<h1><?php _e('Sorry - Page Not Found','blogBox'); ?></h1><br/><br/>
		<h3><?php _e('Sorry but we can\'t find what you were looking for.','blogBox'); ?></h3><br/><br/>
		<h3><?php _e('Can you refine your search and try again?','blogBox'); ?></h3>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>