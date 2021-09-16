<?php

namespace Sponsor\Portal\Admin;

/**
 * Menu
 */
class Menu {

	public $protocol;
	/**
	 * Function __construct
	 *
	 * @return void
	 */
	public function __construct( $protocol ) {
		$this->protocol = $protocol;
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Function admin_menu
	 *
	 * @return void
	 */
	public function admin_menu() {
		$parent_slug = 'biodrop-portal';
		$capability  = 'manage_options';
		add_menu_page( __( 'Sponsor Portal', 'sponsor-portal' ), __( 'Sponsor Portal', 'sponsor-portal' ), $capability, $parent_slug, array( $this->protocol, 'protocol_form' ), 'dashicons-art', 2 );
		add_submenu_page( $parent_slug, __( 'Sponsor Portal', 'sponsor-portal' ), __( 'Sponsor Portal', 'sponsor-portal' ), $capability, $parent_slug, array( $this->protocol, 'protocol_form' ) );
		add_submenu_page( $parent_slug, __( 'Settings', 'sponsor-portal' ), __( 'Settings', 'sponsor-portal' ), $capability, 'biodrop-settings', array( $this, 'plugin_subpage' ) );

	}

	/**
	 * Function plugin_page
	 *
	 * @return void
	 */
	public function plugin_page() {
		$main_nav = new SponsorForm();
		$main_nav->protocol_form();
	}

	/**
	 * Function plugin_page
	 *
	 * @return void
	 */
	public function plugin_subpage() {
		echo 'Base sub Plugin';
	}
}
