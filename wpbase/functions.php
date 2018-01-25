<?php

// config
include(dirname(__FILE__).'/../base_config.php');

// require_once modules
$modules = base_get_config( 'modules' );
foreach( $modules as $module => $params ){
    if( $params['active'] && isset($params['path']) ){
        
        $module_path = get_template_directory() . '/modules/' . $params['path'];
        
        require_once( $module_path );
    }
}

// require_once theme functions
function base_require_all( $dir, $depth = 0 ) {
    
    if ( $depth >  4 ) {
        return;
    }
    
    $scan = glob( "$dir/*" );
    foreach ( $scan as $path ) {
        if ( preg_match( '/\.php$/', $path ) ) {
            require_once $path;
        }
        elseif ( is_dir( $path ) ) {
            base_require_all( $path, $depth+1 );
        }
    }
}
base_require_all( get_template_directory() . '/inc' );

do_action( 'base_functions' );