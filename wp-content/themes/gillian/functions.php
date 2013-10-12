<?php
/**
 * SimpleMag functions and definitions
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/

/* Content Width */
if ( ! isset( $content_width ) ) $content_width = 690; /* pixels */


/* Theme Options */
require_once ( 'admin/index.php' );


/* Google Fonts */
include_once( 'inc/google-fonts.php' ); // Load Fonts from Google


/* Custom Fields */
include_once( 'admin/acf/acf.php' );
include_once( 'admin/acf/acf-fields.php' );



/* Register Menus  */
register_nav_menus( array(
	'main_menu' => __( 'Main Menu', 'themetext' ), // Main site menu
	'secondary_menu' => __( 'Secondary Menu', 'themetext' ) // Main site menu
));



/* Images */
add_theme_support( 'post-thumbnails' );
add_image_size( 'medium-size', 600, 400, true );
add_image_size( 'masonry-size', 600, 9999 );
add_image_size( 'big-size' , 1050, 700, true );
add_image_size( 'gallery-carousel' , 9999, 580 );



/* Includes */
include_once( 'inc/wp-gallery.php' );
include_once( 'inc/user-fields.php' );
include_once( 'inc/mega-menu.php' );
include_once( 'inc/comment-template.php' );
include_once( 'inc/styling-options.php' );



/* Widgets */
include_once( 'widgets/ti-video.php' );
include_once( 'widgets/ti-authors.php' );
include_once( 'widgets/ti-about-site.php' );
include_once( 'widgets/ti-latest-posts.php' );
include_once( 'widgets/ti-latest-reviews.php' );
include_once( 'widgets/ti-featured-posts.php' );
include_once( 'widgets/ti-most-commented.php' );
include_once( 'widgets/ti-latest-comments.php' );



/* Register jQuery Scripts and CSS Styles */
include_once( 'inc/register-scripts.php' );



/* Enable post and comment RSS feed links */
add_theme_support( 'automatic-feed-links' );



/*  Post Formats */
add_theme_support( 'post-formats', 
		array( 
			'video', 
			'gallery',
			'audio' 
		) 
);


/* Define sidebars */
if (function_exists('register_sidebars')) {
	
	// Sidebar for blog section of the site
	register_sidebar(
	   array(
		'name' => __( 'Magazine', 'themetext' ),
		'id' => 'sidebar-1',
		'description'   => __( 'Sidebar for categories and single posts', 'themetext' ),		   
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);

	register_sidebar(
	   array(
		'name' => __( 'Pages', 'themetext' ),  
		'id' => 'sidebar-2',
		'description'   => __( 'Sidebar for static pages', 'themetext' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);

	register_sidebar(
	   array(
		'name' => __( 'Footer Area One', 'themetext' ),  
		'id' => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);
	
	register_sidebar(
	   array(
		'name' => __( 'Footer Area Two', 'themetext' ),
		'id' => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);
	
	register_sidebar(
	   array(
		'name' => __( 'Footer Area Three', 'themetext' ),  
		'id' => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	   )
	);
}


/* Count the number of footer sidebars to enable dynamic classes for the footer */
function ti_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = ' col-1';
			break;
		case '2':
			$class = ' col-2';
			break;
		case '3':
			$class = ' col-3';
			break;
	}

	if ( $class )
		echo $class;
}


/* Add SoundCloud oEmbed */
function add_oembed_soundcloud(){
	wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://soundcloud.com/oembed' );
}
add_action('init','add_oembed_soundcloud');



/* Simple Mag Gravatar */
function ti_gravatar ( $avatar_defaults ) {
	$new_avatar = get_template_directory() . '/images/ti-gravatar.png';
	$avatar_defaults[$new_avatar] = "SimpleMag";
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'ti_gravatar' );



/**
 * Excerpt length
 * Excerpt more
*/
// Excerpt Length
function ti_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'ti_excerpt_length' );


// Excerpt more
function ti_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'ti_excerpt_more' );
 
 
 

/**
 * Pagination for paged posts
 */
function ti_pagination(){
	global $wp_query;
	$total_pages = $wp_query->max_num_pages; 
	if ( $total_pages > 1 ){
		$current_page = max( 1, get_query_var('paged') ); 
		echo '<div class="pagination">';
		echo paginate_links(array( 
			'base' => get_pagenum_link(1) . '%_%', 
			'format' => 'page/%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 3,
			'prev_next' => true,
			'prev_text' => '<i class="icon-chevron-left"></i>',
			'next_text' => '<i class="icon-chevron-right"></i>',
			'type' => 'list'
		)); 
		echo '</div>';
	}	
}


/**
 * Remove rel attribute from the category list
 */
function remove_category_list_rel( $output ) {
    return str_replace( 'rel="category tag"', '', $output );
}
add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' );


/**
 * Theme localization
 */
load_theme_textdomain( 'themetext', get_template_directory() . '/languages' );
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);