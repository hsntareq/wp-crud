<?php
/**
Plugin name: WP Crud
Plugin URI: https://www.biodrop.life
Description: Biodrop Sponsor is a sponsor registration form for biodrop.life. Here, sponsors will join following any existing protocol or will create a new one.
Author: Hasan Tareq
Author URI: https://hsntareq.github.io
Version: 1.4.0
Text Domain: sponsor-portal
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class SponsorPortal {

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const version = '1.0';

	/**
	 * Class __construct.
	 */
	private function __construct() {
		$this->define_constants();

		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
	}

	/**
	 * Initializes a singleton instance
	 *
	 * @return \SponsorPortal
	 */
	public static function init() {

		static $instance = false;
		if ( ! $instance ) {
			$instance = new self();
		}
		return $instance;

	}

	/**
	 * Define the required constants.
	 *
	 * @return void
	 */
	public function define_constants() {
		define( 'SPONSOR_PORTAL_VERSION', self::version );
		define( 'SPONSOR_PORTAL_FILE', __FILE__ );
		define( 'SPONSOR_PORTAL_PATH', __DIR__ );
		define( 'SPONSOR_PORTAL_URL', plugins_url( '', SPONSOR_PORTAL_FILE ) );
		define( 'SPONSOR_PORTAL_ASSETS', SPONSOR_PORTAL_URL . '/assets' );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function init_plugin() {
		if ( is_admin() ) {
			new Sponsor\Portal\Admin();
		} else {
			new Sponsor\Portal\Frontend();
		}
	}
	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function activate() {
		$installer = new \Sponsor\Portal\Installer();
		$installer->run();
	}

}

/**
 * Initializing the main plugin
 *
 * @return \SponsorPortal
 */
function sponsor_portal() {
	return SponsorPortal::init();
}

// kick-off the plugin.
sponsor_portal();
