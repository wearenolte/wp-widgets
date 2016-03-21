<?php namespace Leean\Widgets\Models;

use Leean\Acf\All;

/**
 * Class AbstractWidget.
 *
 * @package Leean\Widgets\Models
 */
class AbstractWidget extends \WP_Widget
{
	/**
	 * The slug.
	 *
	 * @var bool|string
	 */
	private $_slug = '';

	/**
	 * AbstractWidget constructor.
	 *
	 * @param string $title       Widget title
	 * @param string $description Widget description.
	 * @param bool   $slug		  Widget slug (use class name if not supplied).
	 */
	public function __construct( $title, $description, $slug = false ) {
		if ( $slug ) {
			$this->_slug = $slug;
		} else {
			$child_class = ( new \ReflectionClass( $this ) )->getShortName();
			$child_class_parts = preg_split( '/(?=[A-Z])/', $child_class );
			$this->_slug = trim( strtolower( implode( '-', $child_class_parts ) ), '-' );
		}

		parent::__construct( $this->_slug, $title, [
			'description' => $description,
		]);
	}

	/**
	 * Get the widget slug.
	 *
	 * @return string
	 */
	public function get_slug() {
		return $this->_slug;
	}

	/**
	 * Get the widget's data
	 *
	 * @return mixed
	 */
	public function get_data() {
		$settings = $this->get_settings()[ $this->number ];

		return array_merge(
			[ 'title' => $settings['title'] ],
			All::get_widget_fields( $this->id )
		);
	}

	/**
	 * Front-end display of widget.
	 * By default we just display an error message because these widgets are only accessible via the API.
	 * However you could override this function if you want to also display it using the normal WP engine.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		?>

		<h3><?php echo esc_html( $instance['title'] ? $instance['title'] : '' ) ?></h3>

		<pre>This is a back-end widget only. Access the data via the API.</pre>

		<?php

	}

	/**
	 * Back-end widget form. We just add the title here (you can use ACF to add other fields).
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] )
			? $instance['title']
			: '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
				   value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) )
			? strip_tags( $new_instance['title'] )
			: '';

		return $instance;
	}
}
