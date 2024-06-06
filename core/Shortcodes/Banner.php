<?php

namespace App\Shortcodes;

use App\Base\BaseController;

class Banner extends BaseController {

	/**
	 * Register `blog_core_banner` shortcode.
	 *
	 * @return void
	 */
	public function register() {
		add_shortcode( 'blog_core_banner', array( $this, 'blog_core_banner_shortcode' ) );
	}

	/**
	 * Display when called by shortcode.
	 *
	 * @param array $attributes Attributes passed to the shortcode.
	 * @return string|void
	 */
	public function blog_core_banner_shortcode( $attributes ) {
		// Set default attributes and merge with user-provided attributes
		$atts = shortcode_atts(
			$attributes,
			array(
				'selectedPost' => null, // Default selected post ID is null
			),
			'blog_core_banner'
		);

		// Get the post ID from the attributes
		$post_id = intval( $atts['selectedpost'] );

		// print_r($atts['selectedpost']);
		// print_r($post_id);
		// die();

		// Check if a valid post ID is provided
		if ( $post_id ) {

			// Get the post object
			$post = get_post( $post_id );

			// Check if the post exists
			if ( $post ) {
		// 		print_r($atts['selectedpost']);
		// print_r($post_id);
		// die();
				// Get the post title, content, and thumbnail URL
				$title            = $post->post_title;
				$content          = $post->post_content;
				$image_url        = get_the_post_thumbnail_url( $post_id, 'full' );
				$author_id        = $post->post_author;
				$author_name      = get_the_author_meta( 'display_name', $author_id );
				$author_email     = get_the_author_meta( 'user_email', $author_id );
				$author_image_url = get_avatar_url( $author_email, array( 'size' => 96 ) );
				$published_date   = date_i18n( 'F j, Y', strtotime( $post->post_date ) ); // Format date as "Month Day, Year"
				$tags             = wp_get_post_tags( $post_id ); // Get post tags
				$first_tag        = ! empty( $tags ) ? $tags[0]->name : ''; // Get the first tag name, if available

				return sprintf(
					'<div class="hero">
						<div class="hero__card">
							<div class="hero__card__tag">%1$s</div>
							<div class="hero__card__title">
								%2$s
							</div>
							<div class="hero__card__author">
								<img src="%3$s" alt="">
								<h3>%4$s</h3>
								<p>%5$s</p>
							</div>
						</div>
					</div>',
					$first_tag,
					$title,
					$author_image_url,
					$author_name,
					$published_date,
				);

				die();
			} else {
				// If the post doesn't exist, display a message
				return '<p>' . __( 'Post not found.', 'create-block' ) . '</p>';
			}
		} 
		else {

			// If no valid post ID is provided, display a message
			return '<p class="test">' .$post_id. __( 'No post selected.', 'create-block' ) . '</p>';
		}
	}
}
