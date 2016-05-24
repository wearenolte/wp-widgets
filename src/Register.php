<?php namespace Lean\Widgets;

use Lean\Widgets\Models\AbstractWidget;

/**
 * Class to provide widget functions.
 */
class Register {
	/**
	 * Registered widgets for this project.
	 *
	 * @var array
	 */
	private static $_widgets = [];

	/**
	 * Init. Takes $widgets_to_register args in the following format:
	 * [
	 * 	 'lean' => [ 'LeanPreview', 'LeanMenu' ],
	 *   'custom' => [ 'MyNamespace\MyWidget' ],
	 * ]
	 *
	 * @param array $widgets_to_register Set of widgets to register for your project.
	 */
	public static function init( $widgets_to_register = [] ) {
		$widgets_to_register = wp_parse_args( $widgets_to_register, [
			'lean' => [],
			'custom' => [],
		] );

		self::$_widgets = $widgets_to_register;

		add_action( 'widgets_init', [ __CLASS__, 'unregister_all' ], 11 );

		add_action( 'widgets_init', [ __CLASS__, 'register_widgets' ], 12 );
	}

	/**
	 * Unregister all widgets.
	 */
	public static function unregister_all() {
		global $wp_widget_factory;

		foreach ( $wp_widget_factory->widgets as $widget => $class ) {
			unregister_widget( $widget );
		}
	}

	/**
	 * Register required widgets.
	 */
	public static function register_widgets() {
		foreach ( self::$_widgets['lean'] as $widget ) {
			self::register_widget( __NAMESPACE__ . '\\Collection\\' . $widget );
		}

		foreach ( self::$_widgets['custom'] as $widget ) {
			self::register_widget( $widget );
		}
	}

	/**
	 * Register a widget and run its post_registration function.
	 *
	 * @param string $widget_class Full class name (including namespace) of the widget.
	 */
	private static function register_widget( $widget_class ) {
		register_widget( $widget_class );

		$callback = [ $widget_class, 'post_registration' ];
		if ( is_callable( $callback, true ) ) {
			call_user_func( $callback );
		}
	}

	/**
	 * Gets a specific instance of a widget
	 *
	 * @param string $widget_id The widget id
	 * @return AbstractWidget|bool
	 */
	public static function get_widget_instance( $widget_id ) {
		global $wp_registered_widgets;

		if ( ! isset( $wp_registered_widgets[ $widget_id ] ) ) {
			return false;
		}

		$model = $wp_registered_widgets[ $widget_id ]['callback'][0];

		if ( ! is_a( $model, 'Lean\Widgets\Models\AbstractWidget' ) ) {
			return false;
		}

		$key = $wp_registered_widgets[ $widget_id ]['params'][0]['number'];

		$model->_set( $key );

		return $model;
	}
}
