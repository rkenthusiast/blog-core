<?php
/**
 * Activation Class.
 *
 * @package  App
 */

namespace App\Base;

/**
 * Activation Class.
 */
class Activate {

	/**
	 * Call default activation and rewrite flush.
	 *
	 * @return void
	 */
	public static function activate() {
		flush_rewrite_rules();
	}
}
