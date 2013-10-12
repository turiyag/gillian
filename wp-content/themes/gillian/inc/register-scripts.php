<?php
/**
 * Register jQuery scripts and 
 * CSS Styles only for the front-end
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/

function ti_theme_scripts(){
	
	/**
	 * Register CSS styles
	 */
	
	// framework CSS
	wp_enqueue_style('framework', get_stylesheet_directory_uri() . '/css/framework.css', 'style');

	
	// Icons
	wp_enqueue_style('icons', get_stylesheet_directory_uri() . '/css/icons.css', 'style');

	
	// Main theme style
	wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/style.css', 'style');
	
	
	/**
	 * Register jQuery scripts
	 */
	
	// Always load only the latest jQuery library version
	wp_enqueue_script( 'jquery' );
	
	
	// Blog single comments reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply', array(), '', true );
	}


	// Knob (post rating)
	if( is_single() && get_field( 'enable_rating' ) == 1 ):
		wp_enqueue_script( 'knob', get_template_directory_uri() . '/js/jquery.knob.js', 'jquery', '1.2.0', true );
	endif;

	
	// Flex Slider
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery', '2.1', true );
	
	
	// CarouFredSel
	if( is_front_page() || is_single() || is_active_widget( '', '', 'ti_site_authors') ):
		wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . '/js/jquery.caroufredsel.js', 'jquery', '6.2.0', true ); // CarouFredSel
		wp_enqueue_script( 'touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', 'jquery', '1.3.3', true ); // Touch Swipe
	endif;
		
		
	// IE scripts
	if(preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT'])) { // if IE<=8 
		wp_enqueue_script( 'ie' , get_template_directory_uri() . '/js/oldie.js', '', '' );
	}
		
	// jQuery plugins
	wp_enqueue_script( 'assets', get_template_directory_uri() . '/js/jquery.assets.js', 'jquery', '1.0', true );
		
	// Custom jQuery scripts
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', true );
	
}
	
add_action( 'wp_enqueue_scripts', 'ti_theme_scripts' );


// Header custom JS
function header_scripts(){
	global $ti_option;
	$header_code = $ti_option['custom_js_header'];
	if ( $header_code != '' ){
		echo '<script type="text/javascript">'."\n",
				$ti_option['custom_js_header']."\n",
			 '</script>'."\n";
	}
}
add_action('wp_head', 'header_scripts');


// Footer custom JS
function footer_scripts(){
	global $ti_option;
	$footer_code = $ti_option['custom_js_footer'];
	if ( $footer_code != '' ){
		echo '<script type="text/javascript">'."\n",
				$ti_option['custom_js_footer']."\n",
			 '</script>'."\n";
	}
}
add_action( 'wp_footer', 'footer_scripts', 100 );