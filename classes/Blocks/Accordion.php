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
class Accordion extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Accordion';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Accordion for use in pages';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Accordion' );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_5d7249c8af035',
				'label'             => 'Tuoteryhmä',
				'name'              => 'tuoteryhma',
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
				'button_label'      => 'Lisää tuoteryhmä',
				'sub_fields'        => array(
					array(
						'key'               => 'field_5d724ad6af036',
						'label'             => 'Ryhmän nimi',
						'name'              => 'ryhman_nimi',
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
					),
					array(
						'key'               => 'ryhma_teksit',
						'label'             => 'Ryhmän teksti',
						'name'              => 'ryhman_teksti',
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
						'key'               => 'field_5d724af9af037',
						'label'             => 'Tuotteet',
						'name'              => 'tuotteet',
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
						'button_label'      => 'Lisää tuote',
						'sub_fields'        => array(
							array(
								'key'               => 'field_5d724b02af038',
								'label'             => 'Tuotteen nimi',
								'name'              => 'tuotteen_nimi',
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
							),
							array(
								'key'               => 'field_5d724b13af039',
								'label'             => 'Tuotteen teksti',
								'name'              => 'tuotteen_teksti',
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
						),
					),
				),
			),
		);
	}
}
