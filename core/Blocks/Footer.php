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
class Footer extends BaseController {

	/**
	 * Register function is called by default to get the class running
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'init', array( $this, 'create_footer_init' ) );
	}

	/**
	 * Run shortcode.
	 *
	 * @param [type] $attributes default attr.
	 * @param [type] $content default content.
	 * @return mixed shortcode render.
	 */
	// public function get_footer_shortcode( $attributes, $content = null ) {

	// echo '<pre>';
	// print_r( $attributes );
	// echo '</pre>';

	// $menu_slug = $attributes['FooterBottomMenu'];

	// Get the menu object by its slug
	// $menu_object = get_term_by( 'slug', $menu_slug, 'nav_menu' );

	// Initialize an empty string to store the menu HTML
	// $menu_html = '';

	// Check if the menu object exists
	// if ( $menu_object ) {
	// Get the menu items for the menu object
	// $menu_items = wp_get_nav_menu_items( $menu_object->term_id );

	// Output the menu items
	// if ( $menu_items ) {
	// $menu_html .= '<ul>';
	// foreach ( $menu_items as $menu_item ) {
	// $menu_html .= '<li><a href="' . esc_url( $menu_item->url ) . '">' . esc_html( $menu_item->title ) . '</a></li>';
	// }
	// $menu_html .= '</ul>';
	// } else {
	// $menu_html .= '<p>No menu items found.</p>';
	// }
	// } else {
	// $menu_html .= '<p>Menu not found.</p>';
	// }

	// return $menu_html;
	// }

	/**
	 * Run shortcode.
	 *
	 * @param [type] $attributes default attr.
	 * @param [type] $content default content.
	 * @return mixed shortcode render.
	 */
	public function get_footer_shortcode( $attributes, $content = null ) {

		ob_start(); // Start output buffering

		$custom_logo_url = has_custom_logo() ? wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0] : '';

		$footer_html = sprintf(
			'
			<div class="footer">
				<div class="footer__container">
					<div class="footer__about">
						<h2>%1$s</h2>
						<p>%2$s</p>
						<a href="mailto:%3$s" class="footer__email"><span>%4$s : </span>%5$s</a>
						<a href="tel:%6$s" class="footer__phone"><span>%7$s : </span>%8$s</a>
					</div>
					<div class="footer__menu">
						<div class="footer__menu__link footer__menu__link--1">
							<h2>%9$s</h2>
							%10$s
						</div>
						<div class="footer__menu__link footer__menu__link--2">
							<h2>%11$s</h2>
							%12$s
						</div>
					</div>
					<div class="footer__subscribe">
						<form action="/submit-form" method="POST">
							<div class="footer__subscribe__top">
								<h2>%13$s</h2>
								<p>%14$s</p>
							</div>
							<div class="footer__subscribe__bottom">
								<input type="text" id="title" name="title" required>
								<button type="button" onclick="return false;">%15$s</button>
							</div>
						</form>
					</div>

					<div class="footer__copyright">
						<div class="footer__copyright__left">
							<img src="%16$s" />
							<div class="footer__copyright__description">
								<h3>MyBlog</h3>
								<span>%18$s</span>
							</div>
						</div>
						<div class="footer__copyright__right">
							<nav>
							%17$s
							</nav>

						</div>
					</div>
				</div>
			</div>',
			$attributes['aboutTitle'], // 1
			$attributes['aboutDescription'], // 2
			$attributes['email'], // 3
			$attributes['emailLabel'], // 4
			$attributes['email'], // 5
			$attributes['phone'], // 6
			$attributes['phoneLabel'], // 7
			$attributes['phone'], // 8
			$attributes['menuLabel1'], // 9
			wp_nav_menu(
				array(
					'theme_location' => $attributes['menu1'],
					'menu_class'     => 'footer__menu__container', // Optional CSS class for the menu
					'echo'           => false, // Get the menu HTML as a string
				)
			), // 10
			$attributes['menuLabel2'], // 11
			wp_nav_menu(
				array(
					'theme_location' => $attributes['menu2'],
					'menu_class'     => 'footer__menu__container', // Optional CSS class for the menu
					'echo'           => false, // Get the menu HTML as a string
				)
			), // 12
			$attributes['newsletterTitle'], // 13
			$attributes['newsletterDescription'], // 14
			$attributes['newsletterButtonLabel'], // 15
			$custom_logo_url, // 15
			wp_nav_menu(
				array(
					'theme_location' => $attributes['FooterBottomMenu'],
					'menu_class'     => 'footer__copyright__menu', // Optional CSS class for the menu
					'echo'           => false, // Get the menu HTML as a string
					'depth' => 1,
				)
			), // 17
			$attributes['footerBottomCopyright'], // 18
		);

		echo $footer_html; // Output the HTML content

		$footer_html = ob_get_clean(); // Get the buffered content and clean (clear) the buffer

		return $footer_html; // Return the HTML content
	}




	/**
	 * Register block function called by init hook
	 *
	 * @return void
	 */
	public function create_footer_init() {

		register_block_type_from_metadata(
			$this->plugin_path . 'build/footer/',
			array(
				'render_callback' => array( $this, 'get_footer_shortcode' ),
			)
		);
	}
}
