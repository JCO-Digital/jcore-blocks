<?php
/**
 * Multi Part Hero block
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;

/**
 * Multi Part Hero block
 * A Hero block with many parts
 */
class MultiPartHero extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Multi_Part_Hero';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'A Hero block with many parts';
	/**
	 * Keywords for the block, useful for making the block easily searchable.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Header', 'Hero' );
	/**
	 * An array of features to support. All properties from the JavaScript block supports documentation may be used.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/
	 *
	 * @var array
	 */
	protected static $supports = array( 'jsx' => true );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_60263e3c328e4',
				'label'             => 'Parts',
				'name'              => 'parts',
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
				'layout'            => 'block',
				'button_label'      => 'Add Part',
				'sub_fields'        => array(
					array(
						'key'               => 'field_60263e88328e6',
						'label'             => 'Background Image',
						'name'              => 'background_image',
						'type'              => 'image',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '50',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'array',
						'preview_size'      => 'medium',
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
						'key'               => 'field_60263e51328e5',
						'label'             => 'Overlay Color',
						'name'              => 'overlay_color',
						'type'              => 'select',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '50',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'none'      => 'None',
							'dark'      => 'Dark',
							'light'     => 'Light',
							'primary'   => 'Primary',
							'highlight' => 'Highlight',
						),
						'default_value'     => 'dark',
						'allow_null'        => 0,
						'multiple'          => 0,
						'ui'                => 0,
						'return_format'     => 'value',
						'ajax'              => 0,
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_6026559f2786b',
						'label'             => 'Content',
						'name'              => 'content',
						'type'              => 'flexible_content',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'layouts'           => array(
							'layout_602655adbdda8' => array(
								'key'        => 'layout_602655adbdda8',
								'name'       => 'heading',
								'label'      => 'Heading',
								'display'    => 'block',
								'sub_fields' => array(
									array(
										'key'           => 'field_602655b32786c',
										'label'         => 'Text',
										'name'          => 'text',
										'type'          => 'text',
										'instructions'  => '',
										'required'      => 0,
										'conditional_logic' => 0,
										'wrapper'       => array(
											'width' => '',
											'class' => '',
											'id'    => '',
										),
										'default_value' => '',
										'placeholder'   => '',
										'prepend'       => '',
										'append'        => '',
										'maxlength'     => '',
									),
								),
								'min'        => '',
								'max'        => '',
							),
							'layout_602659061d899' => array(
								'key'        => 'layout_602659061d899',
								'name'       => 'text',
								'label'      => 'Text',
								'display'    => 'block',
								'sub_fields' => array(
									array(
										'key'           => 'field_6026592d1d89a',
										'label'         => 'Text',
										'name'          => 'text',
										'type'          => 'textarea',
										'instructions'  => '',
										'required'      => 0,
										'conditional_logic' => 0,
										'wrapper'       => array(
											'width' => '',
											'class' => '',
											'id'    => '',
										),
										'default_value' => '',
										'placeholder'   => '',
										'maxlength'     => '',
										'rows'          => '',
										'new_lines'     => '',
									),
								),
								'min'        => '',
								'max'        => '',
							),
							'layout_6026595d64061' => array(
								'key'        => 'layout_6026595d64061',
								'name'       => 'button',
								'label'      => 'Button',
								'display'    => 'block',
								'sub_fields' => array(
									array(
										'key'           => 'field_6026597964063',
										'label'         => 'Link',
										'name'          => 'link',
										'type'          => 'link',
										'instructions'  => '',
										'required'      => 0,
										'conditional_logic' => 0,
										'wrapper'       => array(
											'width' => '',
											'class' => '',
											'id'    => '',
										),
										'return_format' => 'array',
									),
								),
								'min'        => '',
								'max'        => '',
							),
						),
						'button_label'      => 'Add Element',
						'min'               => '',
						'max'               => '',
					),
				),
			),
		); // ACF generated array goes here.
	}
}
