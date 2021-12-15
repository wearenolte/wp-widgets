<?php namespace Lean\Widgets\Collection;

use Lean\Widgets\Models\AbstractWidget;

/**
 * Class LeanPreview.
 *
 * @package Lean\Widgets\Collection
 */
class LeanPreview extends AbstractWidget {
	/**
	 * LeanPreview constructor.
	 */
	public function __construct() {
		parent::__construct( 'Lean Preview', 'Display previews (header/description/link)' );
	}

	/**
	 * POst registration.
	 */
	public static function post_registration() {
		if ( function_exists( 'acf_add_local_field_group' ) ) :

			acf_add_local_field_group(
				array(
					'key'                   => 'group_56ef50a64f75f',
					'title'                 => 'LeanPreview',
					'fields'                => array(
						array(
							'key'               => 'field_56ef50b46191d',
							'label'             => 'Items',
							'name'              => 'items',
							'type'              => 'repeater',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'collapsed'         => '',
							'min'               => 1,
							'max'               => '',
							'layout'            => 'block',
							'button_label'      => 'Add Item',
							'sub_fields'        => array(
								array(
									'key'               => 'field_56ef50ea6191e',
									'label'             => 'Title',
									'name'              => 'title',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => '',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
									'readonly'          => 0,
									'disabled'          => 0,
								),
								array(
									'key'               => 'field_56ef514b6191f',
									'label'             => 'Description',
									'name'              => 'description',
									'type'              => 'textarea',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => '',
									'placeholder'       => '',
									'maxlength'         => '',
									'rows'              => '',
									'new_lines'         => 'wpautop',
									'readonly'          => 0,
									'disabled'          => 0,
								),
								array(
									'key'               => 'field_56ef518061921',
									'label'             => 'Button Text',
									'name'              => 'button_text',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Read more',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
									'readonly'          => 0,
									'disabled'          => 0,
								),
								array(
									'key'               => 'field_56ef517661920',
									'label'             => 'Link',
									'name'              => 'link',
									'type'              => 'url',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => '',
									'placeholder'       => '',
								),
								array(
									'key'               => 'field_56ef51a161922',
									'label'             => 'Open in New Window',
									'name'              => 'new_window',
									'type'              => 'true_false',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'message'           => '',
									'default_value'     => 0,
								),
							),
						),
					),
					'location'              => array(
						array(
							array(
								'param'    => 'widget',
								'operator' => '==',
								'value'    => 'lean-preview',
							),
						),
					),
					'menu_order'            => 0,
					'position'              => 'normal',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen'        => '',
					'active'                => 1,
					'description'           => '',
				)
			);

		endif;
	}
}
