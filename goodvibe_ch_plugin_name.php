<?php

/**
 * @link              https://goodvibe.ch
 * @since             1.0.0
 * @package           Goodvibe_CH_Performance
 *
 * @wordpress-plugin
 * Plugin Name:       Goodvibe - WordPress performance
 * Plugin URI:        https://goodvibe.ch
 * Description:       A collection of WordPress performance snippets used in goodvibe.ch website.
 * Version:           1.0.0
 * Author:            Goodvibe
 * Author URI:        https://goodvibe.ch
 * Text Domain:       goodvibe-wp-performance
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( !defined('ABSPATH') ) exit;

// Currently plugin version.
define( 'GOODVIBE_WORDPRESS_PERFORMANCE', '1.0.0' );

class Goodvibe_CH_Performance {
    
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
	 * @return Goodvibe_CH_Performance
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
	 * @return Goodvibe_CH_Performance
	 */
	private function __construct(){			
		if( !is_admin() ){
				add_action( 'wp_enqueue_scripts', array( $this, 'move_scripts') );
				add_action( 'wp_head',            array( $this, 'preload_scripts'), PHP_INT_MAX -1 );
		}
	}
	
	/**
	 * Move scripts from head to bottom/footer.
	 * @return void
	 */
	public function move_scripts(){
		// clean head
		remove_action('wp_head', 'wp_print_scripts');
		remove_action('wp_head', 'wp_print_head_scripts', 9);
		remove_action('wp_head', 'wp_enqueue_scripts', 1);
		
		// move script to footer
		add_action('wp_footer', 'wp_print_scripts', 5);
		add_action('wp_footer', 'wp_print_head_scripts', 5);
		add_action('wp_footer', 'wp_enqueue_scripts', 5);
	}

	/**
	 * Preloads script in the head
	 * 
	 * @since  1.0.3
	 * @return void
	 */
	public function preload_scripts(){
		$wp_scripts = wp_scripts();
		
		foreach( $wp_scripts->queue as $handle ){
			if( !empty($wp_scripts->registered[$handle]->src) ){
				
				if( isset($wp_scripts->registered[$handle]->extra['conditional']) ){
					echo '<!--[if '.$wp_scripts->registered[$handle]->extra['conditional'].'>'."\r\n";
				}
				
					echo '<link rel="preload" href="'.$wp_scripts->registered[$handle]->src.'" as="script">'."\r\n";
					
					if( isset($wp_scripts->registered[$handle]->extra['conditional']) ){
						echo '<![endif]-->'."\r\n";
					}
			}
		}
	}
		
}

// Init
Goodvibe_CH_Performance::get_instance();
