<?php

function base_ajax_init(){
    
	if ( base_is_ajax() ){
		do_action( 'base_ajax_init' );
	}

}
add_action( 'wp', 'base_ajax_init', 30 );


function base_is_ajax(){
	if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strcasecmp('XMLHttpRequest', $_SERVER['HTTP_X_REQUESTED_WITH']) === 0 ){
		return true;
	}else{
		return false;
	}
}