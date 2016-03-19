<?php namespace Leean\Widgets\Models;

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
	 * @param bool   $slug		  Widget slg (use class name if not supplied).
	 */
	function __construct( $title, $description, $slug = false ) {
		$this->_slug = $slug ? $slug : strtolower( ( new \ReflectionClass( $this ) )->getShortName() );

		parent::__construct( $this->_slug, $title, [
			'description' => $description,
		]);
	}

	/**
	 * Get the widget slug.
	 *
	 * @return string
	 */
	function get_slug() {
		return $this->_slug;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

//		Helpers\esc_widget_wrapper_e( $args['before_widget'] );
//
//		if ( $instance['title'] ) {
//			Helpers\esc_widget_wrapper_e( $args['before_title'] );
//			echo esc_html( $instance['title'] );
//			Helpers\esc_widget_wrapper_e( $args['after_title'] );
//		}
//
//		$fields = get_fields( 'widget_' . $args['widget_id'] );
//
//		$fields['image']['src'] = $fields['image']['url'];
//
//		Helpers\load_partial( 'molecules/amtrak-advert', $fields );
//
//		Helpers\esc_widget_wrapper_e( $args['after_widget'] );
	}

	/**
	 * Back-end widget form.
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
