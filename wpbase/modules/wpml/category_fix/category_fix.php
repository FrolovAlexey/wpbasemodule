<?php
/*
Fix saving categories with the same slag
*/
function base_wpml_term_update(){
	
    if( function_exists( 'acf_save_post' ) &&
	    isset( $_REQUEST['action'] ) &&  $_REQUEST['action'] == 'editedtag' &&
	    current_user_can( 'manage_categories', $_REQUEST['tag_ID'] ) ){
      
        if( $_REQUEST['taxonomy'] == 'product_tag' ){
            acf_save_post( 'product_tag_' . $_REQUEST['tag_ID'] );
			
			global $wpdb;
			$table = $wpdb->prefix . 'term_taxonomy';
			$wpdb->update( $table, 
							array( 'description' => $_REQUEST['description']  ), 
							array( 'term_taxonomy_id' => $_REQUEST['tag_ID'] )
							);
        }
    }
}
add_action( 'init', 'base_wpml_term_update', 30 );