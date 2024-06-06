<?php

namespace App\Shortcodes;

use App\Base\BaseController;

class Advertisement extends BaseController {

	/**
	 * Register `blog_core_advertisement` shortcode.
	 *
	 * @return void
	 */
	public function register() {
		add_shortcode( 'blog_core_advertisement', array( $this, 'blog_core_advertisement_shortcode' ) );
	}

	/**
	 * Display when called by shortcode.
	 *
	 * @param array $attributes Attributes passed to the shortcode.
	 * @return string|void
	 */
	public function blog_core_advertisement_shortcode( $attributes ) {
		print_r($attributes);
		return sprintf(
			'<div class="advertisement">
				<div class="advertisement__box">
					<h4>Advertisement</h4>
					<p>You can place ads</p>
					<span>750X100</span>
				</div>
			</div>');
	}
}
