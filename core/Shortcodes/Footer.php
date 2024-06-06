<?php

namespace App\Shortcodes;

use App\Base\BaseController;

class Footer extends BaseController {

	/**
	 * Register `blog_core_footer` shortcode.
	 *
	 * @return void
	 */
	public function register() {
		add_shortcode( 'blog_core_footer', array( $this, 'blog_core_footer_shortcode' ) );
	}

	/**
	 * Display when called by shortcode.
	 *
	 * @param array $attributes Attributes passed to the shortcode.
	 * @return string|void
	 */
	public function blog_core_footer_shortcode( $attributes ) {
		print_r($attributes);
		return sprintf(
			'<div class="footer">
				<div class="footer__box">
					<h4>footer</h4>
					<p>You can place ads</p>
					<span>750X100</span>
				</div>
			</div>');
	}
}
