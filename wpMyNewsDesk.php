<?php
/*
Plugin Name: wpMyNewsDesk
Plugin URI: http://www.dinwebb.nu/
Description: Connection to MyNewsDesk through API
Author: Mansoor Munib
Version: 1.2
Author URI: http://www.dinwebb.nu/
*/

// Url to plugin
define('MND_PLUGIN_URL', WP_PLUGIN_URL.'/'. dirname( plugin_basename(__FILE__) ) );

/*
 * Load Script and Styles
 */


function mnd_script()  
{  
	if (!is_admin()){
    	wp_register_script( 'mnd-script', MND_PLUGIN_URL ."/js/mndScript.js", array('jquery'), "1.0", true );  
		wp_register_style( 'mnd-style', MND_PLUGIN_URL ."/css/mndStyle.css", array(), '1.0', 'all' );  
		
		wp_enqueue_script( 'mnd-script' );
		wp_enqueue_style( 'mnd-style' );
		
		wp_localize_script( 'mnd-script', 'mndAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	}

}
add_action( 'wp_enqueue_scripts', 'mnd_script' ); 

// Shortcode
include('shortcode.php');

// Settings
include('settings.php');