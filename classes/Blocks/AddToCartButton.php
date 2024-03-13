<?php
/**
 * Add To Cart Block
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;

/**
 * Add To Cart Block
 * Show Add To Cart Ajax Button On Product Page
 */
class AddToCartButton extends AbstractBlock {

	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Add_To_Cart_Button';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Show add to cart button';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'cart';

	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Add', 'Cart' );
	/**
	 * The default block mode. Choices are: 'edit', 'auto', 'preview'.
	 *
	 * @var string
	 */
	protected static $mode = 'preview';
	/**
	 * The default block alignment. Available settings are “left”, “center”, “right”, “wide” and “full”. Defaults to an empty string.
	 *
	 * @var string
	 */
	protected static $align = 'center';
	/**
	 * Array of post types the block should be available in.
	 *
	 * @var array
	 */
	protected static $post_types = array( 'product' );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(); // ACF generated array goes here.
	}

	/**
	 * Provide Context To Block
	 *
	 * @param array $context Timber render context.
	 * @param array $fields  ACF fields.
	 *
	 * @return array
	 */
	protected function populate_context( $context, $fields ) {
		if ( is_singular( 'product' ) ) {
			global $product;

			$context['product'] = $product;

			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $defaults, $product ) );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
			}

			$context['args'] = $args;
		}
		return $context;
	}
}
