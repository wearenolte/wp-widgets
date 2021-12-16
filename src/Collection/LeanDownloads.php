<?php namespace Lean\Widgets\Collection;

use Lean\Widgets\Models\AbstractWidget;

/**
 * Class LeanDownloads.
 *
 * @package Lean\Widgets\Collection
 */
class LeanDownloads extends AbstractWidget {
	/**
	 * LeanDownloads constructor.
	 */
	public function __construct() {
		parent::__construct( 'Lean Downloads', 'Display a list of downloads' );
	}

	/**
	 * Post registration.
	 */
	public static function post_registration() {
		if ( function_exists( 'acf_add_local_field_group' ) ) :

			acf_add_local_field_group(
				[
					'key'                   => 'group_56f9d3400aff4',
					'title'                 => 'LeanDownloads',
					'fields'                => [
						[
							'key'               => 'field_56f9d3b907ec5',
							'label'             => 'Items',
							'name'              => 'items',
							'type'              => 'repeater',
							'instructions'      => '',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => [
								'width' => '',
								'class' => '',
								'id'    => '',
							],
							'collapsed'         => '',
							'min'               => 1,
							'max'               => '',
							'layout'            => 'block',
							'button_label'      => 'Add Item',
							'sub_fields'        => [
								[
									'key'               => 'field_56f9d3f007ec6',
									'label'             => 'Title',
									'name'              => 'title',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => [
										'width' => '',
										'class' => '',
										'id'    => '',
									],
									'default_value'     => '',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
									'readonly'          => 0,
									'disabled'          => 0,
								],
								[
									'key'               => 'field_56f9d43007ec7',
									'label'             => 'Description',
									'name'              => 'description',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => [
										'width' => '',
										'class' => '',
										'id'    => '',
									],
									'default_value'     => '',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
									'readonly'          => 0,
									'disabled'          => 0,
								],
								[
									'key'               => 'field_56f9d43607ec8',
									'label'             => 'Button Text',
									'name'              => 'button_text',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => [
										'width' => '',
										'class' => '',
										'id'    => '',
									],
									'default_value'     => '',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
									'readonly'          => 0,
									'disabled'          => 0,
								],
								[
									'key'               => 'field_56f9d44d07ec9',
									'label'             => 'File',
									'name'              => 'file',
									'type'              => 'file',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => [
										'width' => '',
										'class' => '',
										'id'    => '',
									],
									'return_format'     => 'array',
									'library'           => 'all',
									'min_size'          => '',
									'max_size'          => '',
									'mime_types'        => '',
								],
							],
						],
					],
					'location'              => [
						[
							[
								'param'    => 'widget',
								'operator' => '==',
								'value'    => 'lean-downloads',
							],
						],
					],
					'menu_order'            => 0,
					'position'              => 'normal',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen'        => '',
					'active'                => 1,
					'description'           => '',
				]
			);

		endif;
	}
}
