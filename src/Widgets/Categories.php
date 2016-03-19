<?php namespace Leean\Widgets\Widgets;

use Leean\Widgets\Models\AbstractWidget;

/**
 * Class Categories.
 *
 * @package Leean\Widgets\Widgets
 */
class Categories extends AbstractWidget
{
	/**
	 * Categories constructor.
	 */
	function __construct() {
		parent::__construct( 'Categories', 'All the post categories' );
	}
}
