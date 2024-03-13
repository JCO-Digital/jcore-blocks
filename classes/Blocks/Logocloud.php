<?php
/**
 * Logocloud slider or grid
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;

class Logocloud extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Logocloud';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Cloud of logos or logo slider';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'images-alt';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Logo cloud', 'Logo slider' );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_602f77c403a99',
				'label'             => 'Carousel',
				'name'              => 'carousel',
				'type'              => 'true_false',
				'instructions'      => 'The carousel grid adjusts the number of images per row responsively. A change in responsivity requires script alteration.',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 1,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
			array(
				'key'               => 'field_6499750ecd520',
				'label'             => 'If not carousel, how many images on each row?',
				'instructions'      => 'If images are of very varying size, the option two images per row might add more small images to even out the spacing.',
				'name'              => 'choice',
				'aria-label'        => '',
				'type'              => 'select',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'two'   => 'Two per row',
					'three' => 'Three per row',
					'four'  => 'Four per row',
					'five'  => 'Five per row',
					'six'   => 'Six per row',
				),
				'default_value'     => 'five',
				'return_format'     => 'value',
				'multiple'          => 0,
				'allow_null'        => 0,
				'ui'                => 0,
				'ajax'              => 0,
				'placeholder'       => '',
			),
			array(
				'key'               => 'field_5dd3b5f6fd9ee',
				'label'             => 'Logos',
				'name'              => 'logocloud',
				'type'              => 'repeater',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'collapsed'         => '',
				'min'               => 0,
				'max'               => 0,
				'layout'            => 'table',
				'button_label'      => '',
				'sub_fields'        => array(
					array(
						'key'               => 'field_5dd3b5fffd9ef',
						'label'             => 'Logo image',
						'name'              => 'partner_logo',
						'type'              => 'image',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '15',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'array',
						'preview_size'      => 'thumbnail',
						'library'           => 'all',
						'min_width'         => '',
						'min_height'        => '',
						'min_size'          => '',
						'max_width'         => '',
						'max_height'        => '',
						'max_size'          => '',
						'mime_types'        => '',
					),
					array(
						'key'               => 'field_5dd3b60dfd9f0',
						'label'             => 'Link',
						'name'              => 'link',
						'type'              => 'link',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'url',
					),
				),
			),
		);
	}
}
