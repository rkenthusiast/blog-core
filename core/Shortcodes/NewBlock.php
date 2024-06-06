<?php
/**
 * Register blog_core shortcode
 *
 * @package  App
 */

namespace App\Shortcodes;

use App\Base\BaseController;

/**
 * Register blog_core_newblock shortcode.
 */
class Newblock extends BaseController {

	/**
	 * Register `blog_core_blog_core` shortcode.
	 *
	 * @return void
	 */
	public function register() {
		add_shortcode( 'blog_core_newblock', array( $this, 'blog_core_newblock_shortcode' ) );
	}

	/**
	 * Display when called by shortcode.
	 *
	 * @return false|string|void
	 */
	public function blog_core_newblock_shortcode() {

		$html = '<h2>Ram - New block Shortcode</h2>';

		return $html;
	}
}
