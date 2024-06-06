<?php
/**
 * Register Blocks for Scbdemo
 *
 * @package  App
 */

namespace App\Blocks;

use App\Base\BaseController;

/**
 * Newblock block.
 */
class Newblock extends BaseController {

	/**
	 * Register function is called by default to get the class running
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'init', array( $this, 'create_newblock_init' ) );
	}

	/**
	 * Run shortcode.
	 *
	 * @param [type] $attr default attr.
	 * @param [type] $content default content.
	 * @return mixed shortcode render.
	 */
	public function get_newblock_shortcode( $attr, $content ) {
		return do_shortcode( '[blog_core_newblock]' );
	}

	/**
	 * Register block function called by init hook
	 *
	 * @return void
	 */
	public function create_newblock_init() {

		register_block_type_from_metadata(
			$this->plugin_path . 'build/newblock/',
			array(
				'render_callback' => array( $this, 'get_newblock_shortcode' ),
			)
		);
	}
}
