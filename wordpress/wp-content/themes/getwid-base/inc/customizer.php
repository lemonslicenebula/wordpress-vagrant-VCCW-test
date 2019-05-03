<?php
/**
 * getwid_base Theme Customizer
 *
 * @package getwid_base
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function getwid_base_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'getwid_base_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'getwid_base_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_panel('getwid_base_options', array(
		'title' => esc_html__('Theme Options', 'getwid-base')
	));

	$wp_customize->add_section('getwid_base_footer', array(
		'title' => esc_html__('Footer Options', 'getwid-base'),
		'panel' => 'getwid_base_options'
	));

	/* translators: %1$s: current year. */
	$footer_default_text = esc_html_x('Copyright &copy; %1$s.  All Rights Reserved.', 'Default footer text. %1$s - current year.', 'getwid-base');
	$wp_customize->add_setting('getwid_base_footer_text', array(
		'default' => $footer_default_text,
		'transport' => 'postMessage',
		'type' => 'theme_mod',
		'sanitize_callback' => 'wp_kses_post'
	));
	$wp_customize->add_control('getwid_base_footer_text', array(
		'label' => esc_html__('Footer Text', 'getwid-base'),
		/* translators: %1$s: current year. */
		'description' => esc_html__('Use %1$s to insert the current year. Doesn`t work for Live Preview.', 'getwid-base'),
		'section' => 'getwid_base_footer',
		'type' => 'textarea',
		'settings' => 'getwid_base_footer_text'
	));

}
add_action( 'customize_register', 'getwid_base_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function getwid_base_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function getwid_base_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function getwid_base_customize_preview_js() {
	wp_enqueue_script( 'getwid-base-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), getwid_base_get_theme_version(), true );
}
add_action( 'customize_preview_init', 'getwid_base_customize_preview_js' );
