<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       wpwork.com
 * @since      1.0.0
 *
 * @package    Wcua
 * @subpackage Wcua/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wcua
 * @subpackage Wcua/public
 * @author     wpwork <wpwork24@gmail.com>
 */
class Wcua_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wcua_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wcua_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wcua-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wcua_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wcua_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wcua-public.js', array( 'jquery' ), $this->version, false );

	}
	public function wcua_code() {
		global $wpdb;
		$user = wp_get_current_user();
		if ( is_user_logged_in() ) {
			if( $user->roles[0] != 'administrator'){
				$wcua_user_id = sanitize_text_field(get_current_user_id());
				$wcua_product_id =  sanitize_text_field(get_the_ID());
				if ( is_singular( 'product' ) && is_single()) {
					// Data base product id insert date 
					$table_name = WCUA_DB_PREFIX."_user_analyis"; 
					$wcua_found = $wpdb->get_results("SELECT * FROM $table_name WHERE productid = $wcua_product_id AND userid = $wcua_user_id ");
					if(count($wcua_found) >= 1){ }else{
						$wpdb->insert( 
							$table_name, 
							array( 
								'time' => current_time( 'mysql' ), 
								'userid' =>  sanitize_text_field($wcua_user_id), 
								'productid' => sanitize_text_field($wcua_product_id), 
							) 
						);	
					}
				}
			}
		} 
	}

}
