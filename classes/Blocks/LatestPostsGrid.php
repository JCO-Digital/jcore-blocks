<?php
/**
 * Latest Posts grid block
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;


use Jcore\Blocks\AbstractBlock;
use Jcore\Ydin\Settings\Customizer;

class LatestPostsGrid extends AbstractBlock {

	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Latest_Posts_Grid';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Latest Posts Grid block';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Posts' );

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'   => 'field_5dee9c57cd588_show_heading',
				'label' => 'Show heading',
				'name'  => 'show_heading',
				'type'  => 'true_false',
				'ui'    => 1,
			),
			array(
				'key'               => 'field_5dee9c79cd589_heading',
				'label'             => 'Heading',
				'name'              => 'heading',
				'type'              => 'text',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5dee9c57cd588_show_heading',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			),
			array(
				'key'               => 'field_5dee9c8acd58a_heading_align',
				'label'             => 'Heading alignment',
				'name'              => 'heading_align',
				'type'              => 'select',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5dee9c57cd588_show_heading',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
				'choices'           => array(
					'text-left'   => 'Left',
					'text-center' => 'Center',
					'text-right'  => 'Right',
				),
				'ui'                => 1,
			),
			array(
				'key'           => 'field_r9er7ter7e8_number_of_posts',
				'label'         => 'Number of posts',
				'name'          => 'number_of_posts',
				'type'          => 'number',
				'instructions'  => 'The nr of posts to show',
				'required'      => 1,
				'default_value' => 3,
				'min'           => 1,
				'step'          => 1,
			),
			array(
				'key'   => 'field_5dee9c57cd588_custom_columns',
				'label' => 'Custom columns',
				'name'  => 'custom_columns',
				'type'  => 'true_false',
				'ui'    => 1,
			),
			array(
				'key'               => 'field_5ef9ddc89bf44',
				'label'             => 'Columns',
				'name'              => 'columns',
				'type'              => 'select',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5dee9c57cd588_custom_columns',
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
				'default_value'     => '3',
				'allow_null'        => 0,
				'multiple'          => 0,
				'ui'                => 1,
				'ajax'              => 0,
				'return_format'     => 'value',
				'placeholder'       => '',
			),
			array(
				'key'               => 'field_5eb51cf713644',
				'label'             => 'Allow any post type',
				'name'              => 'allow_any',
				'type'              => 'true_false',
				'instructions'      => 'Enable if you want to show posts from all post types',
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
				'key'               => 'field_5efd7b1fb2e96',
				'label'             => 'Post type',
				'name'              => 'post_type',
				'type'              => 'select',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5eb51cf713644',
							'operator' => '==',
							'value'    => '0',
						),
					),
				),
				'choices'           => $this->post_types(),
				'default_value'     => 'post',
				'ui'                => 1,
				'return_format'     => 'value',
			),
			array(
				'key'               => 'field_5def64f0cfff4_post_category',
				'label'             => 'Post categories',
				'name'              => 'post_category',
				'type'              => 'taxonomy',
				'instructions'      => 'Shows posts from all categories if left empty',
				'taxonomy'          => 'category',
				'field_type'        => 'multi_select',
				'return_format'     => 'id',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5efd7b1fb2e96',
							'operator' => '==',
							'value'    => 'post',
						),
					),
				),
			),
			array(
				'key'   => 'field_5dee459c2bbec_show_button',
				'label' => 'Show button',
				'name'  => 'show_button',
				'type'  => 'true_false',
				'ui'    => 1,
			),
			array(
				'key'               => 'field_5dee45df2bbed_button_link',
				'label'             => 'Button link and text',
				'name'              => 'button_link',
				'type'              => 'link',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5dee459c2bbec_show_button',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			),
			array(
				'key'               => 'field_5de87rgjerg987_button_align',
				'label'             => 'Button alignment',
				'name'              => 'button_align',
				'type'              => 'select',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5dee459c2bbec_show_button',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
				'choices'           => array(
					'justify-content-start'  => 'Left',
					'justify-content-center' => 'Center',
					'justify-content-end'    => 'Right',
				),
				'ui'                => 1,
			),
			array(
				'key'               => 'field_5dee46112bbee_button_css_classes',
				'label'             => 'Additional Button CSS Class(es)',
				'name'              => 'button_css_classes',
				'type'              => 'text',
				'instructions'      => 'Separate multiple classes with spaces.',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5dee459c2bbec_show_button',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			),
		);
	}

	/**
	 * Get custom post types in project.
	 *
	 * @return array
	 */
	protected function post_types() {
		$args = array(
			'public'   => true,
			'_builtin' => false,
		);

		$post_types = get_post_types( $args, 'objects' );
		$array      = array(
			'post' => 'Post',
			'page' => 'Page',
		);
		if ( $post_types ) {
			foreach ( $post_types as $post_type ) {
				$add_to_array = array( $post_type->name => $post_type->label );
				$array        = array_merge( $array, $add_to_array );
			}
		}

		return $array;
	}

	/**
	 * Class-block.php override
	 *
	 * @param array $context The Timber Context.
	 * @param array $fields The fields in the block.
	 *
	 * @return array
	 */
	protected function populate_context( $context, $fields ) {
		// acf field values to context.
		$context['fields'] = $fields;

		$context['columns'] = Customizer::get( 'article_highlight', 'columns' );
		if ( ! empty( $fields['custom_columns'] ) ) {
			$context['columns'] = $fields['columns'];
		}

		// Get posts.
		$args = array(
			'post_type'      => ! empty( $fields['allow_any'] ) ? 'any' : ( $fields['post_type'] ?? 'post' ),
			'post_status'    => 'publish',
			'posts_per_page' => $fields['number_of_posts'],
			'orderby'        => array(
				'date' => 'DESC',
			),
		);
		if ( ! empty( $fields['post_category'] ) ) {
			$args['category'] = $fields['post_category'];
		}
		$context['query'] = \Timber::get_posts( $args );

		return $context;
	}
}
