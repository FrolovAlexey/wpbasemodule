<?php

add_action( 'base_ajax_init', 'base_ajax_posts_load' );

function base_ajax_posts_load(){
	
	if( !isset( $_GET['block_type'] ) || $_GET['block_type'] != 'ajax_posts' ){
		return false;
	}	
	
    $paged = 1;
    if( isset( $_REQUEST['next_page'] ) ){
        $paged = $_REQUEST['next_page'];
    }

	$q = new WP_Query( array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'paged'          => $paged,
				)
			);
		
	if ( $q->have_posts() ){
		while ( $q->have_posts() ) : $q->the_post();
			get_template_part( 'blocks/content', get_post_type() );
		endwhile;
	}
	wp_reset_postdata();
	
	exit;
}