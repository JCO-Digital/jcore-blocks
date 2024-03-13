<?php
/**
 * Contacts block
 *
 * @package jcoreBlocks
 */

namespace Jcore\Blocks\Blocks;

use Jcore\Blocks\AbstractBlock;
use Timber\Timber;

class Contacts extends AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Contacts';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'Contact list';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Contacts', 'Contact' );


	/**
	 * Constructor which sets the right parameters and calls the register block function
	 */
	public function __construct() {
		$this->register_block();

		static::register_contacts();
		static::register_contact_categories();
		static::register_contact_fields();
	}

	/**
	 * Registers the fields
	 *
	 * @return array
	 */
	public function register_fields() {
		return array(
			array(
				'key'               => 'field_3dbeviuyugk8xf',
				'label'             => 'Tooltip',
				'name'              => 'tooltip',
				'type'              => 'true_false',
				'instructions'      => '',
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
				'key'               => 'field_3dbeviuyugk7xf',
				'label'             => 'Category',
				'name'              => 'contact_category',
				'type'              => 'taxonomy',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'taxonomy'          => 'contact_category',
				'field_type'        => 'checkbox',
				'add_term'          => 1,
				'save_terms'        => 0,
				'load_terms'        => 0,
				'return_format'     => 'id',
				'multiple'          => 0,
				'allow_null'        => 0,
			),
		);
	}

	protected function populate_context( $context, $fields ) {
		$args = array(
			'post_type'      => 'contacts',
			'posts_per_page' => 100,
		);
		if ( ! empty( $fields['contact_category'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'contact_category',
					'field'    => 'term_id',
					'terms'    => $fields['contact_category'][0],
				),
			);
		}
		$context['fields']['contacts'] = Timber::get_posts( $args );
		return $context;
	}

	static function prefix_disable_gutenberg( $current_status, $post_type ) {
		if ( in_array( $post_type, array( 'contact' ) ) ) {
			return false;
		}
		return $current_status;
	}

	static function register_contacts() {
		/**
		 * Post Type: Contacts.
		 */

		$labels = array(
			'name'          => __( 'Contacts', 'jcore' ),
			'singular_name' => __( 'Contact', 'jcore' ),
		);

		$args = array(
			'label'                 => __( 'Contacts', 'jcore' ),
			'labels'                => $labels,
			'description'           => 'Contact information',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'delete_with_user'      => false,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'has_archive'           => false,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'exclude_from_search'   => false,
			'capability_type'       => 'post',
			'map_meta_cap'          => true,
			'hierarchical'          => false,
			'rewrite'               => array(
				'slug'       => 'contacts',
				'with_front' => true,
			),
			'query_var'             => true,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'menu_icon'             => 'dashicons-groups',
			'taxonomies'            => array( 'contact_category', 'post_tag' ),
		);

		register_post_type( 'contacts', $args );
	}

	static function register_contact_categories() {
		// Create custom taxonomy
		$labels  = array(
			'name'                       => __( 'Contact Categories', 'jcore' ),
			'singular_name'              => __( 'Contact Category', 'jcore' ),
			'menu_name'                  => __( 'Contact Categories', 'jcore' ),
			'all_items'                  => __( 'All Contact Categories', 'jcore' ),
			'parent_item'                => __( 'Parent Type', 'jcore' ),
			'parent_item_colon'          => __( 'Parent Type:', 'jcore' ),
			'new_item_name'              => __( 'New Contact Category Name', 'jcore' ),
			'add_new_item'               => __( 'Add New Category', 'jcore' ),
			'edit_item'                  => __( 'Edit Category', 'jcore' ),
			'update_item'                => __( 'Update Category', 'jcore' ),
			'separate_items_with_commas' => __( 'Category of Content', 'jcore' ),
			'search_items'               => __( 'Search Category', 'jcore' ),
			'add_or_remove_items'        => __( 'Add or Remove Category', 'jcore' ),
			'choose_from_most_used'      => __( 'Choose among most used categories.', 'jcore' ),
		);
		$rewrite = array(
			'slug'         => 'contact-category',
			'with_front'   => true,
			'hierarchical' => true,
		);
		$args    = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => $rewrite,
			'query_var'         => true,
		);
		register_taxonomy( 'contact_category', array( 'contacts' ), $args );
	}

	static function register_contact_fields() {
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key'                   => 'group_contacts',
					'title'                 => 'Contacts',
					'fields'                => array(
						array(
							'key'               => 'field_6006d27e76a75',
							'label'             => 'Job title',
							'name'              => 'jobtitle',
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
						),
						array(
							'key'               => 'field_6006d27e76a76',
							'label'             => 'Email',
							'name'              => 'email',
							'type'              => 'email',
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
						),
						array(
							'key'               => 'field_6006d2b576a77',
							'label'             => 'Phone',
							'name'              => 'phone',
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
							'key'               => 'field_6006d2b576a78',
							'label'             => 'Free text',
							'name'              => 'text',
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
					),
					'location'              => array(
						array(
							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'contacts',
							),
						),
					),
					'menu_order'            => 0,
					'position'              => 'acf_after_title',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen'        => '',
					'active'                => true,
					'description'           => '',
				)
			);
		}
	}
}
