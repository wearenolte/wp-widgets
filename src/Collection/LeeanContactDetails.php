<?php namespace Leean\Widgets\Collection;

use Leean\Widgets\Models\AbstractWidget;
use Leean\Acf;

/**
 * Class LeeanContactDetails.
 *
 * @package Leean\Widgets\Collection
 */
class LeeanContactDetails extends AbstractWidget
{
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Leean Contact Details', 'Display contact details' );
	}

	/**
	 * Get the widget's data.
	 *
	 * @return mixed
	 */
	public function get_data() {
		$data = parent::get_data();

		$data['logo'] = Acf::get_option_field( 'logo' );
		$data['address'] = Acf::get_option_field( 'address' );
		$data['phone'] = Acf::get_option_field( 'phone' );
		$data['email'] = Acf::get_option_field( 'email' );

		return $data;
	}
}
