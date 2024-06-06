<?php
namespace App\Blocks;

use App\Base\BaseController;

class Posts extends BaseController {

	public function register() {
		add_action( 'init', array( $this, 'create_posts_init' ) );
		add_action( 'wp_ajax_load_more_posts', array( $this, 'load_more_posts' ) );
		add_action( 'wp_ajax_nopriv_load_more_posts', array( $this, 'load_more_posts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_script(
			'load-more-posts',
			PLUGIN_DIR_URL . 'core/assets/js/load-more-posts.js',
			array( 'jquery' ),
			'1.0',
			true
		);

		wp_localize_script(
			'load-more-posts',
			'ajax_object',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	public function render_posts_block( $attributes, $content = null ) {
		$posts_to_show = $attributes['postsToShow'];
		$total_posts   = wp_count_posts()->publish;

		$query_args = array(
			'posts_per_page' => $posts_to_show,
			'post_status'    => 'publish',
			'_embed'         => true,
		);
		$query      = new \WP_Query( $query_args );

		if ( ! $query->have_posts() ) {
			return '<p>' . esc_html__( 'No posts found', 'create-block' ) . '</p>';
		}

		ob_start();

		echo '<div class="posts" data-total-posts="' . $total_posts . '">';
		echo '<div class="posts__title"><h3>' . esc_html__( 'Latest Post', 'create-block' ) . '</h3></div>';

		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id        = get_the_ID();
			$first_tag      = get_the_terms( $post_id, 'post_tag' )[0] ?? null;
			$author_id      = get_the_author_meta( 'ID' );
			$author_avatar  = get_avatar_url( $author_id, array( 'size' => 48 ) );
			$author_name    = get_the_author();
			$post_date      = get_the_date( 'F j, Y' );
			$featured_image = get_the_post_thumbnail_url( $post_id, 'large' );

			echo '<div class="posts__card">';
			if ( $featured_image ) {
				echo '<img class="posts__card__img" src="' . esc_url( $featured_image ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
			}
			echo '<div class="posts__card__detail">';
			if ( $first_tag ) {
				echo '<span class="posts__card__tag">' . esc_html( $first_tag->name ) . '</span>';
			}
			echo '<h2><a href="' . get_the_permalink() . '">' . esc_html( get_the_title() ) . '</a></h2>';
			echo '<div class="posts__card__author">';
			echo '<img src="' . esc_url( $author_avatar ) . '" alt="' . esc_attr( $author_name ) . '" />';
			echo '<h3>' . esc_html( $author_name ) . '</h3>';
			echo '<p>' . esc_html( $post_date ) . '</p>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
		echo '</div>'; // Close posts container
		echo '<button class="posts__btn" data-page="2" data-postsToShow="' . esc_attr( $posts_to_show ) . '">' . esc_html( $attributes['loadMoreText'] ) . '</button>';


		wp_reset_postdata();

		return ob_get_clean();
	}

	public function load_more_posts() {
		$posts_to_show = intval( $_POST['postsToShow'] );
		$page          = intval( $_POST['page'] );

		$query_args = array(
			'posts_per_page' => $posts_to_show,
			'paged'          => $page,
			'post_status'    => 'publish',
			'_embed'         => true,
		);
		$query      = new \WP_Query( $query_args );

		if ( ! $query->have_posts() ) {
			wp_send_json_error( array( 'message' => 'No more posts found' ) );
		}

		ob_start();

		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id        = get_the_ID();
			$first_tag      = get_the_terms( $post_id, 'post_tag' )[0] ?? null;
			$author_id      = get_the_author_meta( 'ID' );
			$author_avatar  = get_avatar_url( $author_id, array( 'size' => 48 ) );
			$author_name    = get_the_author();
			$post_date      = get_the_date( 'F j, Y' );
			$featured_image = get_the_post_thumbnail_url( $post_id, 'large' );

			echo '<div class="posts__card">';
			if ( $featured_image ) {
				echo '<img class="posts__card__img" src="' . esc_url( $featured_image ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
			}
			echo '<div class="posts__card__detail">';
			if ( $first_tag ) {
				echo '<span class="posts__card__tag">' . esc_html( $first_tag->name ) . '</span>';
			}
			echo '<h2><a href="' . get_the_permalink() . '">' . esc_html( get_the_title() ) . '</a></h2>';
			echo '<div class="posts__card__author">';
			echo '<img src="' . esc_url( $author_avatar ) . '" alt="' . esc_attr( $author_name ) . '" />';
			echo '<h3>' . esc_html( $author_name ) . '</h3>';
			echo '<p>' . esc_html( $post_date ) . '</p>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		wp_reset_postdata();

		wp_send_json_success( ob_get_clean() );
	}

	public function create_posts_init() {
		register_block_type_from_metadata(
			$this->plugin_path . 'build/posts/',
			array(
				'render_callback' => array( $this, 'render_posts_block' ),
				'attributes'      => array(
					'postsToShow'  => array(
						'type'    => 'number',
						'default' => 3,
					),
					'loadMoreText' => array(
						'type'    => 'string',
						'default' => 'View All Post',
					),
				),
			)
		);
	}
}
