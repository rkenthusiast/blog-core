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
class Banner extends BaseController {

	/**
	 * Register function is called by default to get the class running
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'init', array( $this, 'create_banner_init' ) );
	}

	/**
	 * Run shortcode.
	 *
	 * @param [type] $attr default attr.
	 * @param [type] $content default content.
	 * @return mixed shortcode render.
	 */
	// public function get_banner_shortcode( $attr, $content ) {
	// return do_shortcode( '[blog_core_banner]' );
	// }

	public function get_banner_shortcode( $atts, $content = null ) {

		// Extract attributes and provide default values
		$atts = shortcode_atts(
			array(
				'selectedPost' => '',  // Default post
			),
			$atts,
			'blog_core_banner'
		);

		// Create the shortcode with attributes
		$shortcode = sprintf(
			'[blog_core_banner selectedPost="%s"]',
			esc_attr( $atts['selectedPost'] )
		);

		// print_r($shortcode);die();

		// Return the output of the do_shortcode function
		return do_shortcode( $shortcode );
	}

	function render_banner_block( $attributes, $content = null ) {

		$post_id = $attributes['selectValue'];

		// Fetch post details
		$post = get_post( $post_id );
		if ( ! $post ) {
			return '';
		}

		$author_id          = $post->post_author;
		$author_name        = get_the_author_meta( 'display_name', $author_id );
		$author_description = get_the_author_meta( 'description', $author_id );
		$author_image_url   = get_avatar_url( $author_id );
		$featured_image_url = get_the_post_thumbnail_url( $post_id, 'full' );
		$post_date      = get_the_date( 'F j, Y' );
		ob_start();
		?>
	<div class="hero" style="background-image: url(<?php echo esc_url( $featured_image_url ); ?>);">
		<div class="hero__card">
			<div class="hero__card__tag"><?php echo esc_html( $post->post_title ); ?></div>
			<div class="hero__card__title"><?php echo esc_html( $post->post_title ); ?></div>
			<div class="hero__card__author">
				<img src="<?php echo esc_url( $author_image_url ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?>" />
				<h3><?php echo esc_html( $author_name ); ?></h3>
				<p><?php echo esc_html( $post_date ); ?></p>
			</div>
		</div>
	</div>
		<?php
		return ob_get_clean();
	}



	/**
	 * Register block function called by init hook
	 *
	 * @return void
	 */
	public function create_banner_init() {

		register_block_type_from_metadata(
			$this->plugin_path . 'build/banner/',
			array(
				'render_callback' => array( $this, 'render_banner_block' ),
				'attributes'      => array(
					'selectedPost' => array(
						'type'    => 'number',
						'default' => 0,
					),
				),
			)
		);
	}
}
