<?php
/**
 * FAQ block
 *
 * @package Jcore\Blocks\Blocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;
use Timber\Timber;

/**
 * FAQ block
 * for use with content item
 */
class Faq extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'FAQ';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'FAQ block for use with content item';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'lightbulb';

	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Accordion', 'FAQ' );


	/**
	 * Constructor which sets the right parameters and calls the register block function
	 */
	public function __construct() {
		$this->register_block();

		add_action( 'restrict_manage_posts', array( $this, 'filter_post_type_by_taxonomy' ) );
		add_filter( 'parse_query', array( $this, 'convert_id_to_term_in_query' ) );
		add_filter( 'timber/context', array( $this, 'check_for_faq' ) );

		static::faq_item();
		static::faq_type();
	}

	public function check_for_faq( $context ) {
		if ( has_block( 'acf/faq' ) ) {
			global $post;
			$blocks = parse_blocks( $post->post_content );
			$schema = array(
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => array(),
			);
			$added  = array();
			foreach ( $this->find_blocks( $blocks ) as $block ) {
				$posts = get_posts( $this->get_args( $block['attrs']['data'] ) );
				foreach ( $posts as $post ) {
					if ( ! in_array( $post->ID, $added ) ) {
						$added[]                = $post->ID;
						$schema['mainEntity'][] = array(
							'@type'          => 'Question',
							'name'           => strip_tags( $post->post_title ),
							'acceptedAnswer' => array(
								'@type' => 'answer',
								'text'  => trim( strip_tags( $post->post_content ) ),
							),
						);
						if ( is_post_publicly_viewable( $post ) ) {
							$schema['mainEntity']['identifier'] = $post->guid;
						}
					}
				}
			}
			$context['schema'] = $schema;
		}

		return $context;
	}

	private function find_blocks( $blocks ) {
		$found = array();
		$name  = 'acf/' . static::get_block_name();
		foreach ( $blocks as $block ) {
			if ( $block['blockName'] === $name ) {
				$found[] = $block;
			} elseif ( $block['blockName'] === 'core/block' && ! empty( $block['attrs']['ref'] ) ) {
				$reusable         = get_post( $block['attrs']['ref'] );
				$reusable_content = parse_blocks( $reusable->post_content );
				$reusable_blocks  = $this->find_blocks( $reusable_content );
				if ( ! empty( $reusable_blocks ) ) {
					$found = array_merge( $found, $reusable_blocks );
				}
			}
			if ( ! empty( $block['innerBlocks'] ) ) {
				$inner_blocks = $this->find_blocks( $block['innerBlocks'] );
				if ( ! empty( $inner_blocks ) ) {
					$found = array_merge( $found, $inner_blocks );
				}
			}
		}

		return $found;
	}

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_5dcd506281533',
				'label'             => 'FAQ Type',
				'name'              => 'faq_type',
				'type'              => 'taxonomy',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'taxonomy'          => 'faq_type',
				'field_type'        => 'checkbox',
				'add_term'          => 0,
				'save_terms'        => 0,
				'load_terms'        => 0,
				'return_format'     => 'id',
				'multiple'          => 0,
				'allow_null'        => 0,
			),
			array(
				'key'               => 'field_613b045566b9f',
				'label'             => 'Link to single',
				'name'              => 'link_to',
				'type'              => 'true_false',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '50',
					'class' => '',
					'id'    => '',
				),
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 0,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
			array(
				'key'               => 'field_613b050366b9f',
				'label'             => 'Group by type',
				'name'              => 'group_by_type',
				'type'              => 'true_false',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5dcd506281533',
							'operator' => '>',
							'value'    => '1',
						),
					),
				),
				'wrapper'           => array(
					'width' => '50',
					'class' => '',
					'id'    => '',
				),
				'message'           => '',
				'default_value'     => 0,
				'ui'                => 0,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
		);
	}

	protected function get_args( $fields ) {
		$args = array(
			'post_type'      => 'faq_item',
			'posts_per_page' => 100,
			'orderby'        => 'date',
		);
		if ( ! empty( $fields['faq_type'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'faq_type',
					'field'    => 'term_id',
					'terms'    => $fields['faq_type'],
				),
			);
		}

		return $args;
	}

	protected function populate_context( $context, $fields ) {
		$posts                    = Timber::get_posts( $this->get_args( $fields ) );
		$context['block_link_to'] = ! empty( $fields['link_to'] );
		$context['block_posts']   = $posts;

		$grouped = array();
		if ( ! empty( $fields['group_by_type'] ) ) {
			// Loop the posts
			foreach ( $posts as $post ) {
				// Loop terms in case an item is in multiple places.
				foreach ( $post->terms() as $term ) {
					// Check that we are supposed to show this term.
					if ( in_array( $term->id, $fields['faq_type'] ) ) {
						if ( empty( $grouped[ $term->name ] ) || ! is_array( $grouped[ $term->name ] ) ) {
							$grouped[ $term->name ] = array();
						}
						$grouped[ $term->name ][] = $post;
					}
				}
			}
			asort( $grouped );
		} else {
			$grouped[''] = $posts;
		}
		$context['block_grouped'] = $grouped;

		return $context;
	}

	// Register Custom Post Type: faq.
	static function faq_item() {
		$labels  = array(
			'name'               => __( 'FAQ Items', 'jcore' ),
			'singular_name'      => __( 'FAQ Item', 'jcore' ),
			'menu_name'          => __( 'FAQ Items', 'jcore' ),
			'parent_item_colon'  => __( 'Parent Item:', 'jcore' ),
			'all_items'          => __( 'All Items', 'jcore' ),
			'view_item'          => __( 'Show Item', 'jcore' ),
			'add_new_item'       => __( 'Add New Item', 'jcore' ),
			'add_new'            => __( 'Add New Item', 'jcore' ),
			'edit_item'          => __( 'Edit Item', 'jcore' ),
			'update_item'        => __( 'Update Item', 'jcore' ),
			'search_items'       => __( 'Search Items', 'jcore' ),
			'not_found'          => __( 'No Items found', 'jcore' ),
			'not_found_in_trash' => __( 'No Items found in trash', 'jcore' ),
		);
		$rewrite = array(
			'slug'       => 'faq-item',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'FAQ Item', 'jcore' ),
			'description'         => __( 'Questions and Answers for FAQ', 'jcore' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'          => array( 'faq_type' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-excerpt-view',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'rewrite'             => $rewrite,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'query_var'           => true,
		);
		register_post_type( 'faq_item', $args );
	}

	static function faq_type() {
		// Create custom taxonomy
		$labels  = array(
			'name'                       => __( 'FAQ Types', 'jcore' ),
			'singular_name'              => __( 'FAQ Type', 'jcore' ),
			'menu_name'                  => __( 'FAQ Types', 'jcore' ),
			'all_items'                  => __( 'All FAQ Types', 'jcore' ),
			'parent_item'                => __( 'Parent Type', 'jcore' ),
			'parent_item_colon'          => __( 'Parent Type:', 'jcore' ),
			'new_item_name'              => __( 'New Type Name', 'jcore' ),
			'add_new_item'               => __( 'Add New Type', 'jcore' ),
			'edit_item'                  => __( 'Edit Type', 'jcore' ),
			'update_item'                => __( 'Update Type', 'jcore' ),
			'separate_items_with_commas' => __( 'Type of Content', 'jcore' ),
			'search_items'               => __( 'Search Types', 'jcore' ),
			'add_or_remove_items'        => __( 'Add or Remove Type', 'jcore' ),
			'choose_from_most_used'      => __( 'Choose among most used types.', 'jcore' ),
		);
		$rewrite = array(
			'slug'         => 'faq-type',
			'with_front'   => false,
			'hierarchical' => false,
		);
		$args    = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => $rewrite,
			'query_var'         => true,
		);
		register_taxonomy( 'faq_type', array( 'faq_item' ), $args );
	}

	static function filter_post_type_by_taxonomy() {
		global $typenow;
		$post_type = 'faq_item'; // change to your post type
		$taxonomy  = 'faq_type'; // change to your taxonomy
		if ( $typenow == $post_type ) {
			$selected      = isset( $_GET[ $taxonomy ] ) ? $_GET[ $taxonomy ] : '';
			$info_taxonomy = get_taxonomy( $taxonomy );
			wp_dropdown_categories(
				array(
					'show_option_all' => sprintf( __( 'Show all %s', 'jcore' ), $info_taxonomy->label ),
					'taxonomy'        => $taxonomy,
					'name'            => $taxonomy,
					'orderby'         => 'name',
					'selected'        => $selected,
					'show_count'      => true,
					'hide_empty'      => true,
				)
			);
		}
	}

	static function convert_id_to_term_in_query( $query ) {
		global $pagenow;
		$post_type = 'faq_item'; // change to your post type
		$taxonomy  = 'faq_type'; // change to your taxonomy
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset( $q_vars['post_type'] ) && $q_vars['post_type'] == $post_type && isset( $q_vars[ $taxonomy ] ) && is_numeric( $q_vars[ $taxonomy ] ) && $q_vars[ $taxonomy ] != 0 ) {
			$term                = get_term_by( 'id', $q_vars[ $taxonomy ], $taxonomy );
			$q_vars[ $taxonomy ] = $term->slug;
		}
	}
}
