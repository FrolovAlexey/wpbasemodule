<?php

function base_get_config( $branch = false ){

    $config = array(
                // activate modules locateed in 'modules' folder
                'modules' => array(
                                
                                'style_css' => array(
                                            'active'    => true,
                                            'css'       => array(
                                                    array(
                                                        'file' => 'css/style.css',
                                                    ),
                                                    array(
                                                        'file' => 'css/theme.css',
                                                    ),														
                                                ),					    
                                            ),
								
                                'jquery_main' => array(
                                            'active'    => true,
                                            'js'        => array(
                                                    array(
                                                        'file' => 'js/assets/jquery.main.js',
                                                    ),
                                                    array(
                                                        'file' => 'js/assets/comment-reply.js',
                                                    ),													
                                                    array(
                                                        'file' => 'js/assets/impl.js',
                                                    ),													
                                                ),					    
                                            ),
								
                                'js_merger' => array(
                                            'active'      => true,
                                            'debug'       => false, 
                                            'path'        => 'merger/js_merger.php',
											'handle'	  => 'base-script',
											'result_file' => 'js/jquery.main.js',
                                            ),
				
                                'css_merger' => array(
                                            'active'      => true,
                                            'debug'       => false,
                                            'path'        => 'merger/css_merger.php',
											'handle'	  => 'theme-css',
											'result_file' => 'style.css',
                                            ),								
								

                                'menu_start_depth_option' => array(
                                            'active' => true,
                                            'path'   => 'menu/start_depth_option.php',
                                            ),
								
								 
							),
                );
    
    if( $branch ){
        
        return $config[ $branch ];
    }else{
        return $config;
    }
}
