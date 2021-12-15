<?php namespace Lean\Widgets\Collection;

use Lean\Widgets\Models\AbstractWidget;

/**
 * Class LeanMenu.
 *
 * @package Lean\Widgets\Collection
 */
class LeanMenu extends AbstractWidget {
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Lean Menu', 'Display a menu' );
	}

	/**
	 * Add the menu select.
	 *
	 * @param array $instance
	 */
	public function form( $instance ) {
		parent::form( $instance );

		$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

		$selected_menu = isset( $instance['menu'] ) ? $instance['menu'] : '';

		$menu_field_name = $this->get_menu_field_id();

		?>

		<p>

			<label for="<?php echo esc_attr( $menu_field_name ); ?>">Menu:</label>

			<select id="<?php echo esc_attr( $menu_field_name ); ?>"
					name="<?php echo esc_attr( $menu_field_name ); ?>">

				<?php foreach ( $menus as $menu ) : ?>

					<option value="<?php echo esc_attr( $menu->slug ); ?>"
						<?php selected( $selected_menu, $menu->slug ); ?> >
						<?php echo esc_html( $menu->name ); ?>
					</option>

				<?php endforeach ?>

			</select>

		</p>

		<?php
	}

	/**
	 * Save the menu slug
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

		$selected_menu = isset( $_REQUEST[ $this->get_menu_field_id() ] ) ? // phpcs:ignore -- nonce.
			sanitize_text_field( wp_unslash( $_REQUEST[ $this->get_menu_field_id() ] ) ) : false; // phpcs:ignore -- nonce.

		foreach ( $menus as $menu ) {
			if ( $selected_menu === $menu->slug ) {
				$new_instance['menu'] = $selected_menu;
				break;
			}
		}

		return $new_instance;
	}

	/**
	 * Get the widget's data.
	 *
	 * @return mixed
	 */
	public function get_data() {
		$data = parent::get_data();

		$settings = $this->get_settings()[ $this->number ];

		if ( ! isset( $settings['menu'] ) ) {
			return $data;
		}

		$menu_items = wp_get_nav_menu_items( $settings['menu'] );

		foreach ( $menu_items as $menu_item ) {
			if ( ! $menu_item->menu_item_parent ) {
				$data['items'][] = [
					'title' => $menu_item->title,
					'link'  => str_replace( site_url(), '', $menu_item->url ),
					'items' => self::get_sub_menu_items( $menu_items, $menu_item->ID ),
				];
			}
		}

		return $data;
	}

	/**
	 * Recursively get all sub menu items.
	 *
	 * @param array $menu_items All menu items.
	 * @param int   $parent_id  The parent menu id.
	 * @return array
	 */
	public function get_sub_menu_items( $menu_items, $parent_id ) {
		$items = [];

		foreach ( $menu_items as $menu_item ) {
			if ( intval( $parent_id ) === intval( $menu_item->menu_item_parent ) ) {
				$items[] = [
					'title' => $menu_item->title,
					'link'  => str_replace( site_url(), '', $menu_item->url ),
					'items' => self::get_sub_menu_items( $menu_items, $menu_item->ID ),
				];
			}
		}

		return $items;
	}

	private function get_menu_field_id() {
		return 'widget-' . $this->id . '-menu';
	}
}
