<?php

/***************************
* Global Constants		   *
***************************/

define( 'PARSE_BASE_NAME', 		plugin_basename( __FILE__ ) );	    // wordpress-parse-plugin/wordpress-parse-plugin
define( 'PARSE_BASE_DIR_SHORT',	dirname( PARSE_BASE_NAME ) );		// wordpress-parse-plugin
define( 'PARSE_BASE_DIR_LONG',	dirname( __FILE__ ) );				// ../wp-content/plugins/wordpress-parse-plugin (physical file path)
define( 'PARSE_INC_DIR',		PARSE_BASE_DIR_LONG . '/inc/' );	// ../wp-content/plugins/wordpress-parse-plugin/inc/  (physical file path)
define( 'PARSE_BASE_URL',		plugin_dir_url( __FILE__ ) );		// http://mysite.com/wp-content/plugins/wordpress-parse-plugin/
define( 'PARSE_IMAGES_URL',		PARSE_BASE_URL . 'img/' );			// http://mysite.com/wp-content/plugins/wordpress-parse-plugin/img/
define( 'PARSE_CSS_URL',		PARSE_BASE_URL . 'css/' );			// http://mysite.com/wp-content/plugins/wordpress-parse-plugin/css/
define( 'PARSE_JS_URL',			PARSE_BASE_URL . 'js/' );			// http://mysite.com/wp-content/plugins/wordpress-parse-plugin/js/
define( 'PARSE_UTIL_URL',		PARSE_BASE_URL . 'util/' );			// http://mysite.com/wp-content/plugins/wordpress-parse-plugin/util/

// PARSE SETTINGS VALUES SET IN WORDPRESS ADMIN PARSE SETTINGS PAGE
define( 'PARSE_SETTINGS_API_URL', 		get_option( "parse_api_url" ) );
define( 'PARSE_SETTINGS_APP_ID', 		get_option( "parse_app_id" ) );
define( 'PARSE_SETTINGS_CLIENT_ID', 	get_option( "parse_client_id" ) );
define( 'PARSE_SETTINGS_API_KEY', 		get_option( "parse_api_key" ) );
define( 'PARSE_SETTINGS_MASTER_KEY', 	get_option( "parse_master_key" ) );
define( 'PARSE_SETTINGS_JS_KEY', 		get_option( "parse_js_key" ) );
define( 'PARSE_SETTINGS_WINDOWS_KEY',	get_option( "parse_windows_key" ) );

/***************************
* Includes				   *
***************************/

// Plugin Settings Page
require_once( PARSE_INC_DIR . 'admin/admin-settings.php' );

// Parse Library
require_once( PARSE_INC_DIR . 'classes/parse.php' );

// Custom functions
require_once( PARSE_INC_DIR . 'functions/custom.php' );

?>