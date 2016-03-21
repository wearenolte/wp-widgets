<?php namespace Leean\Widgets;

/**
 * Class to provide widget functions.
 */
class Register
{
	/**
	 * Registered widgets for this project.
	 *
	 * @var array
	 */
	private static $_registered_widgets = [];

	/**
	 * Init. Takes $widgets_to_register args in the following format:
	 * [
	 * 	 'leean' => [ 'LeeanPreview', 'LeeanMenu' ],
	 *   'custom' => [ 'MyNamespace\MyWidget' ],
	 * ]
	 *
	 * @param array $widgets_to_register Set of widgets to register for your project.
	 */
	public static function init( $widgets_to_register = [] ) {
		$widgets_to_register = wp_parse_args( $widgets_to_register, [
			'leean' => [],
			'custom' => [],
		] );

		self::$_registered_widgets = $widgets_to_register;

		add_action( 'widgets_init', [ __CLASS__, 'unregister_all' ], 11 );

		add_action( 'widgets_init', [ __CLASS__, 'do_registration' ], 12 );
	}

	/**
	 * Unregister default wp widgets.
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
	public static function do_registration() {
		foreach ( self::$_registered_widgets['leean'] as $widget ) {
			register_widget( __NAMESPACE__ . '\\Widgets\\' . $widget );
		}

		foreach ( self::$_registered_widgets['custom'] as $widget ) {
			register_widget( $widget );
		}
	}
}
