<?php
// Theme css & js

function base_scripts_styles() {
	$in_footer = true;

	// Loads JavaScript file with functionality specific.
	wp_enqueue_script( 'base-script', get_template_directory_uri() . '/js/jquery.main.js', array( 'jquery' ), '', $in_footer );

	// Loads our main stylesheet.
	wp_enqueue_style( 'base-style', get_stylesheet_uri(), array() );
	
}
add_action( 'wp_enqueue_scripts', 'base_scripts_styles' );