<?php

function base_file_merger( $result_file, $file_type, $debug = false ){
	

	$result_file_time = 0;
	if( file_exists( $result_file ) ){
		$result_file_time = filemtime( $result_file );
	}
	
	$modules = base_get_config( 'modules' );
	
	if( $debug ){
		$result_file_time = 0;
	}	
	
	$all_files_array = array();
	//$module_path = get_template_directory() . '/modules/';
	$module_path = get_template_directory() . '/';
	
	$generate_new_file = false;
	
	foreach( $modules as $module => $params ){
		
		if( $params['active'] && is_array( $params[ $file_type ] ) ){
			
			foreach( $params[ $file_type ] as $script_file ){
				
				$script_file_path = $module_path . $script_file['file'];
				
				$filemtime = filemtime ( $script_file_path );
				
				if( $filemtime > $result_file_time ){
					$generate_new_file = true;
				}
				
				$priority = 1000;
				if( isset( $script_file['priority'] ) ){
					$priority = $script_file['priority'];
				}
				
				$all_files_array[] = array(
										'file' => $script_file_path,
										'priority' => $priority
										);
			}
		}
	}
	
	if( $generate_new_file ){
		
		usort( $all_files_array, function ( $a, $b ){
			return strcmp( $a['priority'], $b['priority'] );
		});			
		
		$result_content = '';
		foreach( $all_files_array as $script_file ){

			$file_info = '';
			if( $debug ){
				$file_info = "/* $script_file[file] */\n";
			}
			
			$result_content.= $file_info . file_get_contents( $script_file['file'] ) . "\n\n";
		}
		
		file_put_contents( $result_file, $result_content );
	}
}

