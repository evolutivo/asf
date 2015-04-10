<?php
/**
 * Template part file that contains the contact form sidebar content
 *
 * This file is called by contact.php
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<div id="sidebar">
	<ul>
	<?php if ( !dynamic_sidebar('Sidebar-Contact') ) : ?>
		<li id="search">
			<h2><?php _e('Search','blogBox'); ?></h2>
			<?php get_search_form(); ?>
		</li>
	<?php endif; ?>
	</ul>
</div>