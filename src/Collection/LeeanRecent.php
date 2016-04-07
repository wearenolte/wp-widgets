<?php namespace Leean\Widgets\Collection;

use Leean\Widgets\Models\AbstractWidget;

/**
 * Class LeeanRecent.
 *
 * @package Leean\Widgets\Collection
 */
class LeeanRecent extends AbstractWidget
{
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Leean Recent', 'Display a list of recent posts' );
	}

	/**
	 * Add the menu select.
	 *
	 * @param array $instance
	 */
	public function form( $instance ) {
		parent::form( $instance );

		$post_types = get_post_types();

		$selected = isset( $instance['post_type'] ) ? $instance['post_type'] : '';

		$field_name = $this->get_field_id( 'post_type' );
		?>

		<p>

			<label for="<?php echo esc_attr( $field_name ) ?>">Post Type:</label>

			<select id="<?php echo esc_attr( $field_name ) ?>"
					name="<?php echo esc_attr( $field_name ) ?>">

				<?php foreach ( $post_types as $post_type ) : ?>

					<option value="<?php echo esc_attr( $post_type ) ?>"
						<?php selected( $selected, $post_type ); ?> >
						<?php echo esc_html( $post_type ) ?>
					</option>

				<?php endforeach ?>

			</select>

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

		$selected = isset( $_REQUEST[ $this->get_field_id( 'post_type' ) ] ) ?
			sanitize_text_field( wp_unslash( $_REQUEST[ $this->get_field_id( 'post_type' ) ] ) ) : false;

		foreach ( $post_types as $post_type ) {
			if ( $selected === $post_type ) {
				$new_instance['post_type'] = $selected;
				break;
			}
		}

		return $new_instance;
	}

}
