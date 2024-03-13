<?php
/**
 * Files gallery block.
 * Designed for creating gallery like list of PDF attachments with auto thumbnails.
 * Can be used with other file types as well.
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;

/**
 * Example block
 * This is an example of a simple block
 */
class FilesGallery extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Files_Gallery';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Files gallery';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'media-default';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'File', 'Gallery', 'Pdf' );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_5eba93af0e237',
				'label'             => 'Files',
				'name'              => 'files',
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
				'button_label'      => 'Lisää tiedosto',
				'sub_fields'        => array(
					array(
						'key'               => 'field_5eba93dd0e238',
						'label'             => 'Tiedosto',
						'name'              => 'tiedosto',
						'type'              => 'file',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'array',
						'library'           => 'all',
						'min_size'          => '',
						'max_size'          => '',
						'mime_types'        => '',
					),
				),
			),
		);
	}

	/**
	 * Populates context with contacts
	 *
	 * @return array
	 */

	public function populate_context( $context, $fields ) {
		$files = array();
		foreach ( $fields['files'] as $file ) {
			$file['thumbnail'] = wp_get_attachment_image_src( $file['tiedosto']['id'], 'medium' )[0]; // wp_get_attachment_thumb_url
			array_push( $files, $file );
		}
		$context['files'] = $files;
		return $context;
	}
}
