<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       wpwork.com
 * @since      1.0.0
 *
 * @package    Wcua
 * @subpackage Wcua/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wcua
 * @subpackage Wcua/admin
 * @author     wpwork <wpwork24@gmail.com>
 */
class Wcua_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

	
		 if ( isset( $_REQUEST["page"] ) &&  ( ( $_REQUEST["page"] == "wcua_analysis" )  ||  ( $_REQUEST["page"] == "wcua_product_mail" ) ||  ( $_REQUEST["page"] == "wc_info" ) ) ) { 
			wp_enqueue_style( "jquery_datatable", plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css', array(), "1.11.3", 'all' );
			wp_enqueue_style( "jquery_datatable_responsive", plugin_dir_url( __FILE__ ) . 'css/dataTables.responsive.css', array(), "1.11.4", 'all' );
			wp_enqueue_style( "select2_responsive", plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), "1.11.4", 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wcua-admin.css', array(), $this->version, 'all' );
			
		} 

	}

	/**
	 * Register the JavaScript for the admin area.
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

	
		if ( isset( $_REQUEST["page"] ) && ( ( $_REQUEST["page"] == "wcua_analysis" ) ||  ( $_REQUEST["page"] == "wcua_product_mail" ) ||  ( $_REQUEST["page"] == "wc_info" ) ) ) { 
			
			wp_enqueue_script( 'jquery-datatable', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ),'', false );
			wp_enqueue_script( 'select2-js', plugin_dir_url( __FILE__ ) . 'js/select2.js', array( 'jquery' ),'', false );
			wp_enqueue_script( 'jquery-datatable-responsive', plugin_dir_url( __FILE__ ) . 'js/dataTables.responsive.min.js', array( 'jquery' ),'', false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wcua-admin.js', array( 'jquery' ),'', false );
			wp_localize_script( $this->plugin_name, 'wcau_ajax_object',
				array( 
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
				)
			);
		
		} 
	}


	public function wcua_setup_admin_menu(){
		add_menu_page(
            __('WC Analysis', 'wcua'),
            __( 'WC Analysis', 'wcua' ),
            'manage_options',
            'wcua_analysis',
            array( $this, 'get_wcua_setup_admin_menu_page' ),
            'dashicons-id'
        );
		add_submenu_page(
			"wcua_analysis",
			__("Mail Sending All User", 'wcua'),
			__("Mail Sending All User", 'wcua'),
			'manage_options',
			"wcua_product_mail",
			array( $this, 'get_wcua_setup_wcua_product_mail' )
		);

		// add_submenu_page(
		// 	"wcua_analysis",
		// 	__("WC Info", 'wcua'),
		// 	__("WC Info", 'wcua'),
		// 	'manage_options',
		// 	"wc_info",
		// 	array( $this, 'get_wcua_setup_wc_info' )
		// );
	}

	/* Get Main Page with footer */
	public function get_wcua_setup_admin_menu_page(){
		ob_start();
		require_once plugin_dir_path( __FILE__ ) . 'partials/header/header.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/wcua-admin-display.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/footer/footer.php';
		echo ob_get_clean();
	}
	/* Get wcua product mail with footer */
	public function get_wcua_setup_wcua_product_mail(){
		ob_start();
		require_once plugin_dir_path( __FILE__ ) . 'partials/header/header.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/container/wcua-product-mail.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/footer/footer.php';
		echo ob_get_clean();
	}
	/* Get wcua product mail with footer */
	public function get_wcua_setup_wc_info(){
		ob_start();
		require_once plugin_dir_path( __FILE__ ) . 'partials/header/header.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/container/wcau-admin-info.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/footer/footer.php';
		echo ob_get_clean();
	}




	public function wcua_mail_function(){
			if ( isset( $_POST['_wpnonce'] ) || wp_verify_nonce( $_POST['_wpnonce'] ) ) {
				$wcua_user_id	= sanitize_text_field( $_POST['wcua_user_id'] );
				$wcua_product_id 	= sanitize_text_field( $_POST['wcua_product_id']);
				$wcua_mail_subject = sanitize_text_field( $_POST['wcua_mail_subject']);
				$wcua_mail_message  = wp_kses_post( $_POST['wcua_mail_message'] );
				$user_obj = get_user_by('id', $wcua_user_id);
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $wcua_product_id ), 'single-post-thumbnail' );
				$wcua_product_url	= get_the_permalink($wcua_product_id);
				$wcua_product_image_url = '<a href="'.$wcua_product_url.'" ><img style="width: 150px;" src ="'.$image[0].'"></a>';
				$product = new WC_product($wcua_product_id);
				$wcua_short_description = '<h3><a href="'.$wcua_product_url.'" >'.get_the_title($wcua_product_id).'</a></h3><p>'.$product->short_description.'</p>';
				$wcua_add_to_cart = '<a  style="display: inline-block;color: #fff;background: green;padding: 8px 16px;text-decoration: none;" href="'.$wcua_product_url.'">Buy Now</a>';
				$wcua_template = str_replace("{{Product image}}",$wcua_product_image_url, $wcua_mail_message);
				$wcua_template = str_replace("{{Product buy button}}",$wcua_add_to_cart,$wcua_template );
			  	$wcua_template = str_replace("{{Product description}}",$wcua_short_description,$wcua_template );
				$wcua_user_email = $user_obj->user_email;
				if( isset( $_POST['wcua_coupon_name']  ) && isset( $_POST['wcua_percentage_discount'] ) && isset(  $_POST['wcua_expiry_date']  ) ){
					 $wcua_coupon_name	= sanitize_text_field( $_POST['wcua_coupon_name'] );
					 $wcua_percentage_discount 	= sanitize_text_field( $_POST['wcua_percentage_discount']);
					 $wcua_expiry_date = sanitize_text_field( $_POST['wcua_expiry_date']);
					 $Wcua_coupon = new Wcua_coupon();
					 if( $Wcua_coupon->shop_coupon_post_exists( $wcua_coupon_name ) ){
						$form_id = $Wcua_coupon->create_shop_coupon( $wcua_coupon_name );
						if( !empty($form_id)){
							$Wcua_coupon->update_shop_coupon_post_meta($form_id , $wcua_percentage_discount , $wcua_product_id , $wcua_expiry_date , $wcua_user_email );
						}
						$return["coupon_status"] = true;
						$return["message"] = 'This is your coupon code '.$wcua_coupon_name;
						$mailstatus = true;
					 }else{
						$return["message"] = 'Coupon code is allready created';
						$return["coupon_status"] = false;
						$return['status'] = false;
						$mailstatus = false;
					 }

				}else{
					$return['status'] = true;
					$return["coupon_status"] = false;
					$return["message"] = 'Coupon code is not created';
					$mailstatus = true;
				}
				$Wcua_db = new Wcua_db();
				if($mailstatus){
					if( new Wcua_email( $wcua_user_email , $wcua_mail_subject , $wcua_template)){
						$Status = 'Email Sent';
						$returnstatus = $Wcua_db->wcua_set_status($Status,$wcua_product_id);
						$return["set_status"] = 'Email Sent';
						$return["product_id"] = $wcua_product_id;
						$return["message"] = 'Email Sent';
						$return['status'] = true;
					}else{
						$Status = 'Email Not Sent';
						$returnstatus = $Wcua_db->wcua_set_status($Status,$wcua_product_id);
						$return["set_status"] = 'Email Not Sent';
						$return["product_id"] = $wcua_product_id;
						$return["message"] = 'Something is worng';
						$return['status'] = false;
					}
				}
			
			}else {
				$return["message"] = 'faild';
				status_header(400 , "invalid _wpnonce");
			}
			wp_send_json( $return );
			exit();
	}
	public function wcua_table_delete(){
		$wcua_table_delete = Wcua_db::wcua_table_delete();
		if($wcua_table_delete >= 1){
			$return['status'] = true;
		}else{
			$return['status'] = false;
		}
		wp_send_json( $return );
		exit();
	}


	public function wcua_product_mail_function(){
		if ( isset( $_POST['_wpnonce'] ) || wp_verify_nonce( $_POST['_wpnonce'] ) ) {
			$wcua_user_select	= $_POST['wcua_user_select'] ;
			$wcua_product_id 	= sanitize_text_field( $_POST['wcua_product_id']);
			$wcua_mail_subject = sanitize_text_field( $_POST['wcua_mail_subject']);
			$wcua_mail_message  = wp_kses_post( $_POST['wcua_mail_message'] );
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $wcua_product_id ), 'single-post-thumbnail' );
			$wcua_product_url	= get_the_permalink($wcua_product_id);
			$wcua_product_image_url = '<a href="'.$wcua_product_url.'" ><img style="width: 150px;" src ="'.$image[0].'"></a>';
			$product = new WC_product($wcua_product_id);
			$wcua_short_description = '<h3><a href="'.$wcua_product_url.'" >'.get_the_title($wcua_product_id).'</a></h3><p>'.$product->short_description.'</p>';
			$wcua_add_to_cart = '<a  style="display: inline-block;color: #fff;background: green;padding: 8px 16px;text-decoration: none;" href="'.$wcua_product_url.'">Buy Now</a>';
			$wcua_template = str_replace("{{Product image}}",$wcua_product_image_url, $wcua_mail_message);
			$wcua_template = str_replace("{{Product buy button}}",$wcua_add_to_cart,$wcua_template );
			$wcua_template = str_replace("{{Product description}}",$wcua_short_description,$wcua_template );
			foreach($wcua_user_select as $wcua_user_select){
				if($wcua_user_select){
					$data = new Wcua_email( $wcua_user_select , $wcua_mail_subject , $wcua_template);
					$Status = 'Email Sent';
					$return["set_status"] = 'Email Sent';
					$return["product_id"] = $wcua_product_id;
					$return["message"] = 'Email Sent';
					$return['status'] = true;
				}else{
					$Status = 'Email Not Sent';
					$return["set_status"] = 'Email Not Sent';
					$return["product_id"] = $wcua_product_id;
					$return["message"] = 'Something is worng';
					$return['status'] = false;
				}
			}	
		
		}else {
			$return["message"] = 'faild';
			status_header(400 , "invalid _wpnonce");
		}
		wp_send_json( $return );
		exit();
	}
}
