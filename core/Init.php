<?php
/**
 * Main Init Class.
 *
 * @package  App.
 *
 * Update 1.0.0
 */

namespace App;

/**
 * Final Super Init Class. Uses as Final to stop any option to overwrite.
 */
final class Init {
	/**
	 * Store all the classes inside an array.
	 *
	 * @return array Full list of classes.
	 */
	public static function get_services() {
		return array(
			Shortcodes\Banner::class,
			Shortcodes\Advertisement::class,
			Blocks\Banner::class,
			Blocks\Advertisement::class,
			Blocks\Posts::class,
			Shortcodes\Posts::class,
			Blocks\Footer::class,
			Shortcodes\Footer::class,
		);
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 *
	 * @return void.
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class.
	 *
	 * @param  class $class    class from the services array.
	 * @return class instance  new instance of the class.
	 */
	private static function instantiate( $class ) {
		$service = new $class();

		return $service;
	}
}
