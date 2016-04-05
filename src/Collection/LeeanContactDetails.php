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

}
