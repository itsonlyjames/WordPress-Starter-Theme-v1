<?php

// The Launch
add_action('after_setup_theme','theme_launch');

function theme_launch() {
	// Launch The Head Clean Up
	add_action('init', 'head_cleanup');

	// Remove WordPress version from RSS
	add_filter('the_generator', 'rss_version');

	// Enqueue base CSS & Javascripts
	add_action('wp_enqueue_scripts', 'assets');
}

// The Head Cleanup - clean up of WordPress head, taken from Bones Theme
function head_cleanup() {
	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// index link
	remove_action('wp_head', 'index_rel_link');
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');
	// Remove WordPress version from css
	add_filter('style_loader_src', 'remove_wp_ver_css_js', 9999);
	// Remove WordPress version from scripts
	add_filter('script_loader_src', 'remove_wp_ver_css_js', 9999);
}

// Remove WordPress version from RSS
function rss_version() { return ''; }

// Remove WordPress version from scripts
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}


// CSS & Javascript Assets
function assets() {
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	if (!is_admin()) {

		//main stylsheet (compiled by compass)
		wp_register_style('main', get_stylesheet_directory_uri() . '/assets/css/main.css');
		wp_register_script('main', get_stylesheet_directory_uri() . '/assets/js/min/scripts.min.js', array('jquery'), false, false);
		wp_register_script('all', get_stylesheet_directory_uri() . '/assets/js/all.js', array('jquery'), false, false);

		// Enqueue Stylesheets
		wp_enqueue_style('main');

		// Enqueue Javascripts
		wp_enqueue_script('main');
		wp_enqueue_script('all');

	}
}

// Menus & Navigation
// Register WordPress Nav Menus
register_nav_menus(
	array(
		'main-menu' => __( 'Main Menu' ),
	)
);

// Sample Image Size
add_image_size( 'sample-size', 1200, 800, true );


// Require custom post types from post-types
// Put Taxonomies that are related to a Post Type in the same file unless taxonomy relates to multiple post types
function register_custom_posts_taxonomies() {
	//require_once 'post-types/custom-post-type.php';
}

// Hook into the 'init' action
add_action( 'init', 'register_custom_posts_taxonomies', 0 );

// is_blog();
// @link https://gist.github.com/wesbos/1189639
function is_blog() {

    global $post;

    //Post type must be 'post'.
    $post_type = get_post_type($post);

    //Check all blog-related conditional tags, as well as the current post type,
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() || is_single() )
        && ($post_type == 'post')
    ) ? true : false ;

}

// Changing WP excerpt with following code
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

if ( ! function_exists( 'wpse84987_maintenance_mode' ) ) {
    function wpse84987_maintenance_mode() {
        if ( file_exists( ABSPATH . '.maintenance' ) ) {
            include_once get_stylesheet_directory() . '/maintenance.php';
                die();
        }
    }
    add_action( 'wp', 'wpse84987_maintenance_mode' );
}