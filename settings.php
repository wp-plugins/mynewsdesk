<?php
if(!class_exists('mndPluginOptions')) :
define('KKPLUGINOPTIONS_ID', 'mnd-plugin-options');
define('KKPLUGINOPTIONS_NICK', 'myNewsDesk');
    class mndPluginOptions
    {
		public static function file_path($file){
			return ABSPATH.'wp-content/plugins/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).$file;
		}
		public static function register(){
			register_setting(KKPLUGINOPTIONS_ID.'_options', 'kkpo_quote');
			register_setting(KKPLUGINOPTIONS_ID.'_options', 'kkpo_media');
		}
		public static function menu(){
			add_options_page(KKPLUGINOPTIONS_NICK.' Plugin Options', KKPLUGINOPTIONS_NICK, 'manage_options', KKPLUGINOPTIONS_ID.'_options', array('mndPluginOptions', 'options_page'));
		}
		public static function options_page()
		{
			if (!current_user_can('manage_options'))
			{
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}
			$plugin_id = KKPLUGINOPTIONS_ID;
			include(self::file_path('options.php'));
		}
    }
    if ( is_admin() )
	{
		add_action('admin_init', array('mndPluginOptions', 'register'));
		add_action('admin_menu', array('mndPluginOptions', 'menu'));
	}
endif;
?>