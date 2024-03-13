<?php
/**
 * Posts Carousel
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;
use Timber\Timber;

/**
 * Posts carousel block
 * for use with
 */
class PostCarousel extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Post_carousel';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Carousel of chosen posts';
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
	protected static $keywords = array( 'Carousel', 'Post', 'Posts' );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_5e09eca2643e8',
				'label'             => 'Posts to lift',
				'name'              => 'posts_to_lift',
				'type'              => 'relationship',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'post_type'         => '',
				'taxonomy'          => '',
				'filters'           => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements'          => '',
				'min'               => '',
				'max'               => '',
				'return_format'     => 'id',
			),
		);
	}

	protected function populate_context( $context, $fields ) {

		$args                   = array(
			'post_type' => 'any',
			'post__in'  => $fields['posts_to_lift'],
			'orderby'   => 'post__in',
		);
		$context['block_posts'] = new \Timber\PostQuery( $args );
		return $context;
	}
}
