<?php namespace Leean;

/**
 * Class to provide widget functions.
 */
class Widgets
{
	const ENDPOINT = '/static';

	/**
	 * Init.
	 */
	public static function init() {
		add_action( 'rest_api_init', function () {
			$namespace = apply_filters( 'ln_endpoints_api_namespace', 'leean', self::ENDPOINT );
			$version = apply_filters( 'ln_endpoints_api_version', 'v1', self::ENDPOINT );

			register_rest_route(
				$namespace . '/' . $version,
				self::ENDPOINT,
				[
					'methods' => 'GET',
					'callback' => [ __CLASS__, 'get_data' ],
				]
			);
		} );

		Inc\Content::acf_customize();
	}
}
