<?php
/*
priority - optional, default = 1000

module config example

'test' => array(
		'active'   => true,
		'path'     => 'test/index.php',
		'css'      => array(
				array(
				'file' => 'test/css/test.css',
				'priority' => 1000
				),
			),
        ), 

*/

require_once 'merger.php';
											
function base_css_merger(){
	
	$config          = base_get_config( 'modules' );
	$result_file     = get_template_directory(). '/' . $config['css_merger']['result_file'];
	
	$debug = false;
	if( isset($config['css_merger']['debug']) ){
		$debug = $config['css_merger']['debug'];
	}	
	
	base_file_merger( $result_file, 'css', $debug );
}
add_action( 'base_functions', 'base_css_merger' );

function base_css_merger_script(){

	$config          = base_get_config( 'modules' );
	$result_file_url = get_template_directory_uri() . '/' . $config['css_merger']['result_file'];
	$handle          = get_template_directory_uri() . '/' . $config['css_merger']['handle'];	
	
	wp_enqueue_style ( $handle, $result_file_url, array() );
}
add_action( 'wp_enqueue_scripts', 'base_css_merger_script', 100 );
