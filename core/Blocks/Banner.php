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
	 * Renders the Banner Block.
	 *
	 * This function renders the Banner Block based on the provided attributes.
	 *
	 * @param array       $attributes The attributes of the block.
	 * @param string|null $content    Optional. The content within the block.
	 * @return string                 The rendered HTML content of the block.
	 */
	public function render_banner_block( $attributes, $content = null ) {

		$post_id = $attributes['selectValue'];

		// Fetch post details.
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

		// Assuming $featured_image_url contains the URL of the background image.
		$css = 'style="background-image: url(' . esc_url( $featured_image_url ) . ');"';
		ob_start();
		?>
	<div class="hero" <?php echo esc_attr( $css ); ?>>
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
