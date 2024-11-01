<?php

/**
 * Fired during plugin activation
 *
 * @link       wpwork.com
 * @since      1.0.0
 *
 * @package    Wcua
 * @subpackage Wcua/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wcua
 * @subpackage Wcua/includes
 * @author     wpwork <wpwork24@gmail.com>
 */
class Wcua_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	
		if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
			include_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		}
		if ( current_user_can( 'activate_plugins' ) && ! class_exists( 'WooCommerce' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			$plugin  = 'woocommerce/woocommerce.php';
			$action_url   = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
			$error_message = '<p style="font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Oxygen-Sans,Ubuntu,Cantarell,\'Helvetica Neue\',sans-serif;font-size: 13px;line-height: 1.5;color:#444;">' . esc_html__( 'This plugin requires ', 'simplewlv' ) . '<a target="_blank" href="' . esc_url($action_url) . '">WooCommerce</a>' . esc_html__( ' plugin to be active.', 'simplewlv' ) . '</p>';
			die( $error_message );
		}
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name = WCUA_DB_PREFIX."_user_analyis"; 
		$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		userid mediumint(9) NOT NULL,
		productid mediumint(9) NOT NULL,
		mail_status varchar(10) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
	
}
