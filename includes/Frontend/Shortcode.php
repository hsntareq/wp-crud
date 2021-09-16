<?php
namespace Sponsor\Portal\Frontend;

/**
 * Class Shortcode
 */
class Shortcode {

	/**
	 * Function __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_shortcode( 'sponsor-portal', array( $this, 'render_shortcode' ) );
	}

	/**
	 * Function render_shortcode
	 *
	 * @param  var $attr
	 * @param  var $content
	 * @return string
	 */
	public function render_shortcode( $attr, $content = '' ) {
		return 'Hello Shortcode';
	}


}
