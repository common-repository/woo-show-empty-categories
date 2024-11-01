<?php

/*
Plugin Name: WooCommerce: Show Empty Categories
Plugin URI: https://www.majemedia.com/plugins/woocommerce-show-empty-categories
Description: Show empty WooCommerce categories on product archives when options are set to display categories
Version: 1.1.5
Author: Maje Media LLC
Author URI: https://www.majemedia.com
Copyright: 2019
Text Domain: woo-show-empty-categories
Domain Path: /lang
WC requires at least: 3.0.0
WC tested up to: 3.8.1
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

class WooShowEmptyCategories {

	private static $instance;
	public         $plugin_url;
	public         $plugin_path;

	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {

		$this->set_class_vars();

		require "autoload.php";

		$this::filters();

	}

	public function set_class_vars() {

		$this->plugin_path = realpath( dirname( __FILE__ ) );
		$this->plugin_url  = plugins_url( '', __FILE__ );

	}

	public static function filters() {

		add_filter( 'woocommerce_product_subcategories_hide_empty', array(
			'WSEC_WCInteract',
			'hide_empty_categories',
		), 10, 1 );

	}

}

$WooShowEmptyCategories = WooShowEmptyCategories::get_instance();