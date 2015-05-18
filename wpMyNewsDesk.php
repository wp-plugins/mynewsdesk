<?php
/*
Plugin Name: wpMynewsdesk
Plugin URI: http://www.dinwebb.nu/
Description: Connection to Mynewsdesk through API using short code [mynewsdesk]
Author: Mansoor Munib
Version: 1.4
Author URI: http://www.dwinteractive.se/
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

// Add settings link on plugin page
function mnd_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=mnd-plugin-options_options">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'mnd_settings_link' );

// Shortcode
include('shortcode.php');

// Settings
include('settings.php');