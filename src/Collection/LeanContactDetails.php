<?php namespace Lean\Widgets\Collection;

use Lean\Widgets\Models\AbstractWidget;
use Lean\Acf;

/**
 * Class LeanContactDetails.
 *
 * @package Lean\Widgets\Collection
 */
class LeanContactDetails extends AbstractWidget {
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Lean Contact Details', 'Display contact details' );
	}

	/**
	 * Get the widget's data.
	 *
	 * @return mixed
	 */
	public function get_data() {
		$data = parent::get_data();

		$data['logo'] = Acf::get_option_field( 'contact_details_logo' );
		$data['address'] = Acf::get_option_field( 'contact_details_address' );
		$data['phone'] = Acf::get_option_field( 'contact_details_phone' );
		$data['email'] = Acf::get_option_field( 'contact_details_email' );

		return $data;
	}
}
