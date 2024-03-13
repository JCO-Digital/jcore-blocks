<?php
/**
 * Video hero block
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;
use Timber\Image;
use Timber\Timber;

/**
 * Video hero block
 */
class VideoHero extends AbstractBlock {

	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Video_Hero';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'A video hero block';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'format-video';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Video' );
	/**
	 * The default block mode. Choices are: 'edit', 'auto', 'preview'.
	 *
	 * @var string
	 */
	protected static $mode = 'preview';
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
				'key'               => 'field_607d93e19a8fb',
				'label'             => 'Youtube Link',
				'name'              => 'youtube_link',
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
				'key'               => 'field_607e9ab35dd54',
				'label'             => 'Cover Image',
				'name'              => 'cover_image',
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
				'key'               => 'field_607e949f0149c',
				'label'             => 'Overlay Color',
				'name'              => 'overlay_color',
				'type'              => 'color',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '50',
					'class' => '',
					'id'    => '',
				),
				'default'           => 'dark',
			),
			array(
				'key'               => 'field_607e9576f062f',
				'label'             => 'Text Color',
				'name'              => 'text_color',
				'type'              => 'color',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '50',
					'class' => '',
					'id'    => '',
				),
				'default'           => 'light',
			),
			array(
				'key'               => 'field_607e9950875f9',
				'label'             => 'Overlay Height',
				'name'              => 'overlay_height',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '70vh',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			),
		);
	}

	/**
	 * This method can be overridden if you just want to add data to $context.
	 *
	 * @param array $context Timber render context.
	 * @param array $fields ACF fields.
	 *
	 * @return array
	 */
	protected function populate_context( $context, $fields ) {
		$url = '';
		if ( preg_match( '_https?://[^/]+/watch\?v=([a-zA-Z0-9-]*)_', $fields['youtube_link'], $m ) ) {
			$url = 'https://www.youtube-nocookie.com/embed/' . $m[1] . '?autoplay=1&amp;mute=1&amp;rel=0&amp;controls=0&amp;showinfo=0&amp;loop=1&amp;playlist=' . $m[1];
		}
		$context['fields']                = $fields;
		$context['fields']['url']         = $url;
		$context['fields']['cover_image'] = Timber::get_image( $fields['cover_image'] );

		return $context;
	}
}
