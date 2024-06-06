<?php
/**
 * Register Blocks for Scbdemo
 *
 * @package  App
 */

namespace App\Blocks;

use App\Base\BaseController;

/**
 * Banner block.
 */
class Advertisement extends BaseController {

	/**
	 * Register function is called by default to get the class running
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'init', array( $this, 'create_advertisement_init' ) );
	}

	/**
	 * Run shortcode.
	 *
	 * @param [type] $attributes default attr.
	 * @param [type] $content default content.
	 * @return mixed shortcode render.
	 */

	public function get_advertisement_shortcode( $attributes, $content = null ) {
		return $content;
	}
	

	/**
	 * Register block function called by init hook
	 *
	 * @return void
	 */
	public function create_advertisement_init() {

		register_block_type_from_metadata(
			$this->plugin_path . 'build/advertisement/',
			array(
				'render_callback' => array( $this, 'get_advertisement_shortcode' ),
			)
		);
	}
}
