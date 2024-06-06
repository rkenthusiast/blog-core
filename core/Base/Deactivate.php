<?php
/**
 * Deactivation Class.
 *
 * @package  App
 */

namespace App\Base;

/**
 * Deactivation Class.
 */
class Deactivate {

	/**
	 * Call default deactivation and rewrite flush.
	 *
	 * @return void
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
