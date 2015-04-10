<?php
if ( !defined('ABSPATH')) exit;
// Buttons
	$url = get_template_directory_uri() . '/images/icons';
	$nusantara_options = get_option('nusantara_options');
	$networks = '';

// Twitter
	if ( isset($nusantara_options['nusantara_social_twitter']) and $nusantara_options['nusantara_social_twitter'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_twitter']) .'"><img src="'. $url .'/twitter.png" alt="twitter" /></a>';
	endif;
				
// Facebook 
	if ( isset($nusantara_options['nusantara_social_facebook']) and $nusantara_options['nusantara_social_facebook'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_facebook']) .'"><img src="'. $url .'/facebook.png" alt="facebook" /></a>';
	endif;
				
// GooglePlus
	if ( isset($nusantara_options['nusantara_social_googleplus']) and $nusantara_options['nusantara_social_googleplus'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_googleplus']) .'"><img src="'. $url .'/googleplus.png" alt="googleplus" /></a>';
	endif;
					
// LinkedIn
	if ( isset($nusantara_options['nusantara_social_linkedin']) and $nusantara_options['nusantara_social_linkedin'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_linkedin']) .'"><img src="'. $url .'/linkedin.png" alt="linkedin" /></a>';
	endif;
				
// MySpace
	if ( isset($nusantara_options['nusantara_social_myspace']) and $nusantara_options['nusantara_social_myspace'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_myspace']) .'"><img src="'. $url .'/myspace.png" alt="myspace" /></a>';
	endif;
	
// Blogger
	if ( isset($nusantara_options['nusantara_social_blogger']) and $nusantara_options['nusantara_social_blogger'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_blogger']) .'"><img src="'. $url .'/blogger.png" alt="blogger" /></a>';
	endif;
	
// Wordpress
	if ( isset($nusantara_options['nusantara_social_wordpress']) and $nusantara_options['nusantara_social_wordpress'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_wordpress']) .'"><img src="'. $url .'/wordpress.png" alt="wordpress" /></a>';
	endif;
	
// Flickr
	if ( isset($nusantara_options['nusantara_social_flickr']) and $nusantara_options['nusantara_social_flickr'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_flickr']) .'"><img src="'. $url .'/flickr.png" alt="flickr" /></a>';
	endif;
	
// Last.fm
	if ( isset($nusantara_options['nusantara_social_lastfm']) and $nusantara_options['nusantara_social_lastfm'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_lastfm']) .'"><img src="'. $url .'/lastfm.png" alt="lastfm" /></a>';
	endif;
			
// Delicious
	if ( isset($nusantara_options['nusantara_social_delicious']) and $nusantara_options['nusantara_social_delicious'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_delicious']) .'"><img src="'. $url .'/delicious.png" alt="delicious" /></a>';
	endif;
	
// Digg
	if ( isset($nusantara_options['nusantara_social_digg']) and $nusantara_options['nusantara_social_digg'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_digg']) .'"><img src="'. $url .'/digg.png" alt="digg" /></a>';
	endif;
	
// Reddit
	if ( isset($nusantara_options['nusantara_social_reddit']) and $nusantara_options['nusantara_social_reddit'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_reddit']) .'"><img src="'. $url .'/reddit.png" alt="reddit" /></a>';
	endif;
	
// StumbleUpon
	if ( isset($nusantara_options['nusantara_social_stumbleupon']) and $nusantara_options['nusantara_social_stumbleupon'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_stumbleupon']) .'"><img src="'. $url .'/stumbleupon.png" alt="stumbleupon" /></a>';
	endif;
	
// RSS
	if ( isset($nusantara_options['nusantara_social_rss']) and $nusantara_options['nusantara_social_rss'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_rss']) .'"><img src="'. $url .'/rss.png" alt="rss" /></a>';
	endif;
	
// Friendfeed
	if ( isset($nusantara_options['nusantara_social_friendfeed']) and $nusantara_options['nusantara_social_friendfeed'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_friendfeed']) .'"><img src="'. $url .'/friendfeed.png" alt="friendfeed" /></a>';
	endif;
	
// Skype
	if ( isset($nusantara_options['nusantara_social_skype']) and $nusantara_options['nusantara_social_skype'] <> '' ) :
		$networks .= '<a href="'. esc_url($nusantara_options['nusantara_social_skype']) .'"><img src="'. $url .'/skype.png" alt="skype" /></a>';
	endif;
	
	echo $networks;
?>