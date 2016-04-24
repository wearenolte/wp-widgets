<?php namespace Lean\Widgets\Collection;

use Lean\Widgets\Models\AbstractWidget;
use Lean\Acf;

/**
 * Class LeanSocialLinks.
 *
 * @package Lean\Widgets\Collection
 */
class LeanSocialLinks extends AbstractWidget {
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Lean Social Links', 'Display list of social links' );
	}

	/**
	 * Get the widget's data.
	 *
	 * @return mixed
	 */
	public function get_data() {
		$data = parent::get_data();

		$data['items'] = Acf::get_option_field( 'social_links' );

		return $data;
	}
}
