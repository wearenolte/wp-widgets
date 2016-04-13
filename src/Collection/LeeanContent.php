<?php namespace Leean\Widgets\Collection;

use Leean\Widgets\Models\AbstractWidget;

/**
 * Class LeeanContent.
 *
 * @package Leean\Widgets\Collection
 */
class LeeanContent extends AbstractWidget
{
	/**
	 * LeeanContent constructor.
	 */
	public function __construct() {
		parent::__construct( 'Leean Content', 'Display content (title/body/link)' );
	}

	/**
	 * Post registration.
	 */
	public static function post_registration() {
		if ( function_exists( 'acf_add_local_field_group' ) ) :

			acf_add_local_field_group( array(
				'key' => 'group_56ef50a64f760',
				'title' => 'LeeanContent',
				'fields' => array(
					array(
						'key' => 'field_56ef514b6191f',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'new_lines' => 'wpautop',
						'readonly' => 0,
						'disabled' => 0,
					),
					array(
						'key' => 'field_56ef518061922',
						'label' => 'Button Text',
						'name' => 'button_text',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array(
						'key' => 'field_56ef517661921',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_56ef51a161923',
						'label' => 'Open in New Window',
						'name' => 'new_window',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'widget',
							'operator' => '==',
							'value' => 'leean-content',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			) );

		endif;
	}
}
