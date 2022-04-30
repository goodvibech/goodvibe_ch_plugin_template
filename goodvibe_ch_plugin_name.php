<?php

/**
 * @link              https://goodvibe.ch
 * @since             1.0.0
 * @package           Goodvibe_CH_Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Goodvibe - Name of the plugin
 * Plugin URI:        https://goodvibe.ch
 * Description:       Plugin description.
 * Version:           1.0.0
 * Author:            Goodvibe
 * Author URI:        https://goodvibe.ch
 * Text Domain:       Goodvibe_CH_Plugin_Name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( !defined('ABSPATH') ) exit;

// Currently plugin version.
define( 'GOODVIBE_CH_PLUGIN_NAME', '1.0.0' );

class Goodvibe_CH_Plugin_Name {
    
	/**
	 * Instance of the object.
	 *
	 * @since  1.0.0
	 * @static
	 * @access public
	 * @var null|object
	 */
	public static $instance = null;	
	
	/**
	 * Access the single instance of this class.
	 *
	 * @since  1.0.0
	 * @return Goodvibe_CH_Plugin_Name
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
				self::$instance = new self();
		}
		return self::$instance;
	}
	
	/**
	 * Constructor
	 * Add the custom functions here.
	 *
	 * @since  1.0.0
	 * @return Goodvibe_CH_Plugin_Name
	 */
	private function __construct(){
		if( !is_admin() ){
				add_action( 'wp_footer', array( $this, 'example_function') );
		}
	}
	
	/**
	 * Example function.
	 * @return void
	 */
	public function example_function(){
		echo "Example function";
	}
		
}

// Init
Goodvibe_CH_Plugin_Name::get_instance();
