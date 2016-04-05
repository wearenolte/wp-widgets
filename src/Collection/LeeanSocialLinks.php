<?php namespace Leean\Widgets\Collection;

use Leean\Widgets\Models\AbstractWidget;
use Leean\Acf;

/**
 * Class LeeanSocialLinks.
 *
 * @package Leean\Widgets\Collection
 */
class LeeanSocialLinks extends AbstractWidget
{
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Leean Social Links', 'Display list of social links' );
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
