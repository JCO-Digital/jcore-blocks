<?php
/**
 * Testimonial
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;

/**
 * Testimonial block
 * Show testimonials
 */
class Testimonial extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Testimonial';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Show testimonials';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'slides';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Testimonial', 'Slides', 'Carousel', 'Text', 'Image' );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_testimonial_text',
				'label'             => 'Text Color',
				'name'              => 'text_color',
				'type'              => 'color',
				'instructions'      => '',
				'default_value'     => 'dark',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '33',
					'class' => '',
					'id'    => '',
				),
			),
			array(
				'key'               => 'field_testimonial_button',
				'label'             => 'Button Color',
				'name'              => 'button_color',
				'type'              => 'color',
				'instructions'      => '',
				'default_value'     => 'primary',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '33',
					'class' => '',
					'id'    => '',
				),
			),
			array(
				'key'               => 'field_testimonial_button_arrow',
				'label'             => 'Button Arrow Color',
				'name'              => 'button_arrow_color',
				'type'              => 'color',
				'instructions'      => '',
				'default_value'     => 'light',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '33',
					'class' => '',
					'id'    => '',
				),
			),
			array(
				'key'               => 'field_5ea8127c32abc',
				'label'             => 'Testimonial',
				'name'              => 'testimonial',
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
						'key'               => 'field_5ea8129932abd',
						'label'             => 'Picture',
						'name'              => 'picture',
						'type'              => 'image',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
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
						'key'               => 'field_5ea812c832abe',
						'label'             => 'Text',
						'name'              => 'text',
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
						'new_lines'         => '',
					),
					array(
						'key'               => 'field_5ea812ec32abf',
						'label'             => 'Name',
						'name'              => 'name',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5ea8119832abb',
									'operator' => '!=empty',
								),
							),
						),
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
					),
					array(
						'key'               => 'field_5ea812fe32ac0',
						'label'             => 'Title',
						'name'              => 'title',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5ea8119832abb',
									'operator' => '!=empty',
								),
							),
						),
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
					),
				),
			),
		);
	}
}
