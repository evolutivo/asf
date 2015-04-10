=== BlogBox Theme for Wordpress ===
Theme Name: blogBox
Author: Kevin Archibald
Author URI: http://www.kevinsspace.ca/
Theme URI: http://demo1.kevinsspace.ca/
Version: 2.0.0
License: GNU General Public License V3
License URI:http://www.gnu.org/licenses/quick-guide-gplv3.html
Tags: black,blue,brown,gray,green,orange,pink,purple,red,silver,tan,white,yellow,
      light,dark,one-column,two-columns,left-sidebar,right-sidebar,fixed-width,
      custom-background,custom-colors,custom-header,custom-menu,editor-style,
      featured-image-header,featured-images,front-page-post-form,full-width-template,
      sticky-post,theme-options,threaded-comments,translation-ready

blogBox is a full featured theme that provides the user with numerous options for background
colors, text colors, font styles, static pages, sidebars, captcha for comments and contact page.

== Description ==

	blogBox is a full featured Wordpress theme offering the user many options to 
	control the look of the theme, and many options for special pages and content. 

	1) A static Home page c/w options for a full width feature slider
	   or a small feature slider with a text area. The static home 
	   page also offers two slogan areas and a service area. The service 
	   area contains three service boxes where you can post an image, a title,
	   and some text.

	   You can also select a home blog template with all the above features 
	   and your blog posts.

	2) Header social links for RSS,Facebook, Twitter, Linkedin, Delicious,
	   Digg, Google+, Pinterest and Phone Number. 

	3) Optional Social Links Widget.

	4) Four column footer area wigetized.

	5) Copywrite area with editable html text left, center, and right.
	
	6) Set up to 11 background colors using a color selector
	
	7) Set up to 13 text colors using a color selector

	8) Use preset skins if you don't want to select your own colors.
	
	9) The theme offers many standard web friendly fonts and also a selection 
	   of Google Web Fonts.

	10) Templates
	   - full width
	   - Contact template with custom captcha and widgetized sidebar
	   - Siteplan template
	   - left sidebar template - with separate widgetized sidebar
	   - right sidebar template - with separate widgetized sidebar
	   - Archive template
	   - up to 5 different Portfolio Templates, that
	     you can customize with up to 4 columns, c/w post content
	     or feature media text options
	     
	11) Comment Captcha

	12) PageNavi ready
	
== License ==

License: GNU General Public License V3
License URI: see the license.txt file for license details.

	blogBox is a full featured WordPress Theme
    Copyright (C) 2012 Kevin Archibald

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
== Other Licensed Add Ons ==

ICONS
----------
Social Media Icons : 
--------------------
  - rss.png is from wiki.com
  - facebook.png,linkedin.png, and twitter.png developed by theme author using GIMP and parts of logos from the
    originating sites
  - digg.png, delicious.png from Macchiato-Social Icons : http://19eighty7.com/icons - GNU General Public License
  - pinterest.png and google+ from google and pinterest 
  
List Icons :
--------------

WOOCONS1 : http://www.woothemes.com/2010/08/woocons1/ - GNU General Public License
	cog.png
Crystal Project Icons, AUTHOR: Everaldo Coelho, SITE:http://www.everaldo.com, 
  CONTACT: everaldo@everaldo.com, Copyright (c)  2006-2007  Everaldo Coelho.
    arrow.png

Feature Slider
---------------
Developed by "Nathan Searles":mailto:nsearles@gmail.com, "http://nathansearles.com":http://nathansearles.com

For updates, follow Nathan Searles on "Twitter":http://twitter.com/nathansearles

Slides is licensed under the "Apache license":http://www.apache.org/licenses/LICENSE-2.0.

Custom Menu Sustem
-------------------
Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 
Captcha Font
--------------
Vera by Bitstream : http://www-old.gnome.org/fonts/

== Installation ==


1) Upload to the themes directory of your wordpress setup. Ensure all sub directories are maintained.

2) Activate the theme through the Wordpress Admin panel under "Appearance" and "themes"

== Custom Options ==
Use of the custom options for blogBox is detailed in blogBox_Docs.html.

== Frequently Asked Questions ==

The faq will be developed as common questions arise.

== Changelog ==

Version 1.0.0 - Released 1-Jul-12
----------------------------------

Version 1.15.1 - Released 31-Jul-12
----------------------------------
  - added tagline under logo
  - added feature image to pages
  - added button shortcodes
  - changed captcha font to vera.ttf	
  - added captcha to comment form  
  - added Message box shortcode
  - added <?php remove_action('wp_head','wp_generator'); ?> to above wp_head() in header.php
    this is recommended for security reasons
  - added visual editor-style, but had to set up for gray style and default font style
  - When Page comments not are allowed, removed the comments closed note. This was 
	done for left and right side bar pages and added comments to full width page
  - added checkbox to remove comment captcha
  - added checkbox to remove contact captcha
  - added label style font-size:12px
  - added google+,pinterest,digg, and delicious options to social strip
  - fixed gradient using backgroud-attachment:fixed; in body property
  - added add_filter('widget_text', 'do_shortcode'); to function.php so the shortcodes would
    work in a text widget.
  - there were some issues with the buttons in the shortcode buttons so made a few style revisions 
    in order to get them to work.
    
Version 1.46.2 - Released 20-Aug-12
-----------------------------------
  - fixed center alignment for image posts
  - modified data validation bB_3d_button
  - modified $content width in functions.php
  - modified html5 ie 9 js shiv to be enqueued
  - removed function_exists() from core funtions
  - removed translation from searchform.php
  - added blogBox prefix to functions, and Classes
  - changed custom-styles.php for skins to load through enqueue
  - removed all default content except search form from sidebars
  - fixed sanitization problems in Feature text on page-home-blog.php
  - modified page.php comments, to not show "comments are closed"
  - modified pages with posts to not show comments meta when comments are disabled.
  - modified comments form styling
  - added special text shortcode
  - added validation to messagebox shortcode
  
Version 1.76.3 - Released 1-Oct-12
-------------------------------------
 Related to WordPress.org theme review # 2
 - Fixed spelling of wordpress to WordPress in style.css header description
 - Downloaded html5.js to blogBox/js and function to enqueue as per script recommendation
 - Removed <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
   from header and enqueued as per WordPress.org theme review requirements
 - Enqueued user css options instead of including them in the header
 - Reviewed theme and added blogBox prefixes where they were missing
 - Fixed fresh install debug errors on service box links
 - Added link for posts with no title as
 - Re-coded comments section to incorporate display of trackbacks
 - Recoded custom menu
 - Removed `remove_action( 'wp_head','wp_generator' )` from header
 - Removed all shortcodes. Now can be added back in with Content Pizazz Plugin
 - Added background color functionality to theme
 - Added custom-header functionality
 - Re-coded Portfolio pages to better fit possible content
 - Fixed. Removed old code and added wp_title() to header and blogBox_title_filter() to functions.php
 - Replaced all TEMPLATE path references with get_template_directory()
 - Changed over jQuery and Hoverintent scripts to core scripts
 - Re - coded all data validation; added nonce to forms and sanitized data input
 - Completly re-coded the Settings API using Oenology Settings API as a framework. 
   All options are now saved in one table.Added context sensitive help as part of 
   re-coding the settings API.
 Other Changes
  - Theme is now translation-ready
  - Modified user documentation
  - Added permalink to single page title
  - added a:hover {font-weight:bold}
  - added p tag to blockquote css
  - added gray/white border to author comments
  - changed footer.php to not show copyright section if all variables are empty
  - Added option to display blog Title
  - Added option to show or not show social strip
  - Coded a social link widget as an option

 Version 2.0.0 - Released 27-Oct-12
 ----------------------------------------------------------------
 - New base version after approval at WordPress.org
 - Changed no menu warning message to direct users to the documentation.
 - change contact e-mail header
 - changed captcha image width
 - found a bug in the CSS for IE 7 and 8, problems with displaying the feature section
   was able to fix it by adding #fullwidth{float:left}
 - contact content is not stripping slashes-fixed added stripcslashes
 - fixed bug in service box text, removing <br/> line breaks