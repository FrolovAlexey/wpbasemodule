<?php
/*
priority - optional, default = 1000

module config example

'test' => array(
		'active'   => true,
		'path'     => 'test/index.php',
		'js'       => array(
				array(
				'file' => 'test/js/test.js',
				'priority' => 1000
				),
		),
        ), 

*/

require_once 'merger.php';

function base_js_merger(){
	
	$config          = base_get_config( 'modules' );
	$result_file     = get_template_directory(). '/' . $config['js_merger']['result_file'];
	
	$debug = false;
	if( isset($config['js_merger']['debug']) ){
		$debug = $config['js_merger']['debug'];
	}
	
	base_file_merger( $result_file, 'js', $debug );
		
}
add_action( 'base_functions', 'base_js_merger' );


function base_js_merger_script(){

	$config          = base_get_config( 'modules' );
	$result_file_url = get_template_directory_uri() . '/' . $config['js_merger']['result_file'];
	$handle          = get_template_directory_uri() . '/' . $config['js_merger']['handle'];		
	
	wp_enqueue_script( $handle, $result_file_url, array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'base_js_merger_script', 100 );

