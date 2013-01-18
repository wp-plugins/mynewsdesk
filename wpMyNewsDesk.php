<?php
/*
Plugin Name: wpMyNewsDesk
Plugin URI: http://www.dinwebb.nu/
Description: Wordpress connection to MyNewsDesk press release through API. Easied way to intergrate myNewsDesk in your website
Author: Mansoor Munib
Version: 1.0.0
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
	}

}
add_action( 'wp_enqueue_scripts', 'mnd_script' ); 

// Shortcode
include('shortcode.php');

function getUrl($parseIt=null) {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  if($parseIt == true):
    $url = parse_url($url); //return array otherwise string
  endif;
  return $url;
}

// Settings
require_once('settings.php');