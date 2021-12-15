<?php namespace Lean\Widgets\Collection;

use Lean\Widgets\Models\AbstractWidget;

/**
 * Class LeanRecent.
 *
 * @package Lean\Widgets\Collection
 */
class LeanRecent extends AbstractWidget {
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Lean Recent', 'Display a list of recent posts' );
	}

	/**
	 * Add the menu select.
	 *
	 * @param array $instance
	 */
	public function form( $instance ) {
		parent::form( $instance );

		$post_types = get_post_types();

		$selected = isset( $instance['post_type'] )
			? $instance['post_type']
			: '';

		$number = isset( $instance['number'] )
			? absint( $instance['number'] )
			: 0;

		$field_post_type = $this->get_field_id( 'post_type' );
		$field_number    = $this->get_field_id( 'number' );
		?>

		<p>

			<label for="<?php echo esc_attr( $field_post_type ); ?>">Post Type:</label>

			<select id="<?php echo esc_attr( $field_post_type ); ?>"
					name="<?php echo esc_attr( $field_post_type ); ?>">

				<?php foreach ( $post_types as $post_type ) : ?>

					<option value="<?php echo esc_attr( $post_type ); ?>"
						<?php selected( $selected, $post_type ); ?> >
						<?php echo esc_html( $post_type ); ?>
					</option>

				<?php endforeach ?>

			</select>

		</p>

		<p>

			<label for="<?php echo esc_attr( $field_number ); ?>">Number of posts to display:</label>

			<input type="number" id="<?php echo esc_attr( $field_number ); ?>"
					name="<?php echo esc_attr( $field_number ); ?>"
					value="<?php echo esc_attr( $number ); ?>">

		</p>

		<?php
	}

	/**
	 * Save the post type
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$post_types = get_post_types();

		$selected = isset( $_REQUEST[ $this->get_field_id( 'post_type' ) ] ) // phpcs:ignore -- nonce.
			? sanitize_text_field( wp_unslash( $_REQUEST[ $this->get_field_id( 'post_type' ) ] ) ) // phpcs:ignore -- nonce.
			: false;

		if ( in_array( $selected, $post_types, true ) ) {
			$new_instance['post_type'] = $selected;
		}

		$number = isset( $_REQUEST[ $this->get_field_id( 'number' ) ] ) // phpcs:ignore -- nonce.
			? absint( $_REQUEST[ $this->get_field_id( 'number' ) ] ) // phpcs:ignore -- nonce.
			: false;

		$new_instance['number'] = $number;

		return $new_instance;
	}

	/**
	 * Get the widget's data.
	 *
	 * @return mixed
	 */
	public function get_data() {
		global $post;

		$settings = $this->get_settings()[ $this->number ];

		$args = [
			'post_type'      => $settings['post_type'],
			'posts_per_page' => $settings['number'],
		];

		$recent = new \WP_Query( $args );

		$data = parent::get_data();

		$data['items'] = [];

		while ( $recent->have_posts() ) {
			$recent->the_post();

			$post->link      = get_permalink();
			$data['items'][] = $post;
		}

		wp_reset_postdata();

		return $data;
	}
}
