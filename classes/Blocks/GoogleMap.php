<?php
/**
 * Example default block
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;

/**
 * Example block
 * This is an example of a simple block
 */
class GoogleMap extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Google_Map';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'A google map block';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'format-image';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Map' );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_5e8df6bfee343',
				'label'             => 'Map',
				'name'              => 'map',
				'type'              => 'google_map',
				'instructions'      => '',
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'center_lat'        => '60.085400',
				'center_lng'        => '23.647170',
				'zoom'              => 14,
				'height'            => 400,
			),
		);
	}
}
