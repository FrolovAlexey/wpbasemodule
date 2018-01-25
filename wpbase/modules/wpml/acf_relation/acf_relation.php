<?php

// return default field value if current language field is empty
function base_get_def_field( $field_name, $apply_filters = true, $obg_id = false,  $obg_type = false ){
	
	if( !$obg_id ){
		$obg_id = get_the_ID();
	}
	
	if( !$obg_type ){
		$obg_type = get_post_type( $post_id );
	}
	
	$field_value = get_field( $field_name, $obg_id );
	
	if( is_array( $field_value ) && count($field_value) == 0 ){

		$field_value = get_field(
								$field_name,
								icl_object_id( $obg_id, $obg_type, true, wpml_get_default_language() )
								);		
	}elseif( !$field_value ){
		
		$field_value = get_field(
								$field_name,
								icl_object_id( $obg_id, $obg_type, true, wpml_get_default_language() )
								);
	}
	
	if( $apply_filters ){
		return apply_filters( 'base_get_def_field', $field_value, $field_name, $obg_id, $obg_type );
	}else{
		return $field_value;
	}
	
}

function base_term_get_def_field( $field_name, $obg ){
    $field_value = get_field( $field_name, $obg );
    
    $obg_type = $obg->taxonomy;
    $icl_object_id = icl_object_id( $obg->term_id, $obg_type, true, wpml_get_default_language() );
    
	if( !$field_value ){
		$field_value = get_field(
								$field_name,
								'term_' . $icl_object_id
								);
	}
	return $field_value;    
}
