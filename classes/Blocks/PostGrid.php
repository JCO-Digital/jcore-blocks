<?php
/**
 * Posts Grid
 *
 * @package JcoreBlocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;
use Timber\PostQuery;

/**
 * Posts grid block
 */
class PostGrid extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Post_grid';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Grid of chosen posts';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'grid-view';
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
				'key'               => 'field_5e15c2603187a',
				'label'             => 'Posts to show',
				'name'              => 'posts_to_show',
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
			array(
				'key'   => 'field_5e15c2603187a_custom_columns',
				'label' => 'Custom columns',
				'name'  => 'custom_columns',
				'type'  => 'true_false',
				'ui'    => 1,
			),
			array(
				'key'               => 'field_5e15c26031877c',
				'label'             => 'Columns',
				'name'              => 'columns',
				'type'              => 'select',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5e15c26031877c_custom_columns',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'default_value'     => '',
				'allow_null'        => 0,
				'multiple'          => 0,
				'ui'                => 1,
				'ajax'              => 0,
				'return_format'     => 'value',
				'placeholder'       => '',
			),
		);
	}

	protected function populate_context( $context, $fields ) {
		// acf field values to context.
		$context['fields'] = $fields;
		// Get posts.
		$args = array(
			'post_type'   => 'any',
			'orderby'     => 'post__in',
			'post__in'    => $fields['posts_to_show'],
			'post_status' => 'publish',
		);

		$context['query'] = new PostQuery( $args );

		return $context;
	}
}
