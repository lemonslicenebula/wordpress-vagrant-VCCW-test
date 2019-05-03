<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package getwid_base
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function getwid_base_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'getwid_base_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function getwid_base_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'getwid_base_pingback_header' );


function getwid_base_read_more_link($link){
    if( ! is_singular() ){
        return '<p class="more-tag-wrapper">'.$link.'</p>';
    }
    return $link;
}
add_filter('the_content_more_link', 'getwid_base_read_more_link');

function getwid_base_comment_form_default_fields($fields){

    unset($fields['url']);

    return $fields;

}
add_filter('comment_form_default_fields', 'getwid_base_comment_form_default_fields');

function getwid_base_add_custom_icon_font($font_manager){

	// Register Linearicons Font
	$font_manager->registerFont( 'linearicons-free', array(
		'icons' => get_lnr_icons(),
		'style' => 'linearicons-free',
	) );
}
add_action( 'getwid/icons-manager/init', 'getwid_base_add_custom_icon_font');