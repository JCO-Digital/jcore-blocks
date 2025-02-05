<?php
/**
 * JCORE Abstract block class
 *
 * @package Jcore\Blocks
 */

namespace Jcore\Blocks;

use Jcore\Ydin\WordPress\Assets;
use Timber;

/**
 * Abstract Block class
 * This class is the class which all blocks build upon and extend.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/
 * @see https://www.advancedcustomfields.com/resources/register-fields-via-php/
 * @see https://www.advancedcustomfields.com/resources/blocks/
 * This class should only be used to extend other blocks
 * All parameters can be found here:
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/
 *
 * @package Jcore\Blocks
 */
abstract class AbstractBlock {
	/**
	 * The block name, will be transformed to be compliant with Gutenberg.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#block-name
	 *
	 * @var string
	 */
	protected static $name = 'Block';
	/**
	 * Block description, can be any string.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#description-optional
	 *
	 * @var string
	 */
	protected static $description = 'JCORE block';
	/**
	 * Category for the block, should use gutenberg categories.
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#category
	 *
	 * @var string
	 */
	protected static $category = 'jcore-blocks';
	/**
	 * Icon, short name of dashicon: eg. admin-page
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#icon-optional
	 *
	 * @var string
	 */
	protected static $icon = 'admin-page';
	/**
	 * Keywords for the block, useful for making the block easily searchable
	 *
	 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/#keywords-optional
	 *
	 * @var array
	 */
	protected static $keywords = array( 'Block' );
	/**
	 * The default block mode. Choices are: 'edit', 'auto', 'preview'.
	 *
	 * @var string
	 */
	protected static $mode = 'edit';
	/**
	 * The default block alignment. Available settings are “left”, “center”, “right”, “wide” and “full”. Defaults to an empty string.
	 *
	 * @var string
	 */
	protected static $align = '';
	/**
	 * An array of features to support. All properties from the JavaScript block supports documentation may be used.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/
	 *
	 * @var array
	 */
	protected static $supports = array();
	/**
	 * Array of post types the block should be available in.
	 *
	 * @var array
	 */
	protected static $post_types = array();

	/**
	 * Script to load when block is loaded on page.
	 *
	 * @var string
	 */
	protected $script_name = '';

	/**
	 * Path to the script to load on page.
	 *
	 * @var string
	 */
	protected $script_path = '';

	/**
	 * The constructor, use it to setup member variables and calling registrer_block
	 *
	 * @example class-exampleblock.php Includes an example on how to override this correctly.
	 */
	public function __construct() {
		$this->register_block();
	}

	/**
	 * The abstract function which should return a acf generated array of fields
	 * Important: Should always return atleast an empty array
	 *
	 * @return array
	 */
	abstract public function register_fields();

	/**
	 * This method will register the block with ACF.
	 * It is vital to call this function
	 *
	 * @return void
	 */
	public function register_block() {
		if ( function_exists( 'acf_add_local_field_group' ) && function_exists( 'acf_register_block_type' ) ) {
			// Here is where we register the block using acfs block registering function.

			$block_args = apply_filters(
				'jcore_register_block_type',
				array(
					'name'            => static::get_block_name(),
					'title'           => static::get_block_title(),
					'description'     => static::$description,
					'render_callback' => array( $this, 'render_callback' ),
					'category'        => static::$category,
					'icon'            => static::$icon,
					'keywords'        => static::$keywords,
					'mode'            => static::$mode,
					'align'           => static::$align,
					'supports'        => static::$supports,
					'post_types'      => static::$post_types,
				)
			);

			acf_register_block_type( $block_args );
			// Here we register the field group.
			$this->register_block_fields();
		}
	}

	/**
	 * Registers the block fields.
	 *
	 * @return bool
	 */
	private function register_block_fields() {
		$fields = $this->register_fields();
		if ( empty( $fields ) ) {
			return false;
		}

		$acf_set = array(
			'key'                   => 'jcore_group_' . static::get_block_name(),
			'title'                 => static::get_block_title(),
			'fields'                => $fields,
			'location'              => array(
				array(
					array(
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/' . static::get_block_name(),
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		);
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group( $acf_set );
			return true;
		}
		return false;
	}

	/**
	 * Returns correctly formatted block name.
	 *
	 * @param string $replacement The replacement character used.
	 * @return string
	 */
	public static function get_block_name( $replacement = '-' ) {
		// Just lowercase the name as this is an internal representation.
		$name = strtolower( static::$name );
		$name = preg_replace( '/[^a-z0-9]+/', $replacement, $name );
		return $name;
	}

	/**
	 * Returns correctly formatted block title.
	 *
	 * @return string
	 */
	public static function get_block_title() {
		// Replace _ with space for a more friendly name.
		return str_replace( '_', ' ', static::$name );
	}

	/**
	 * Default render callback.
	 * Override to render custom content. Override populate_context() if you just want to add data.
	 *
	 * @param array   $block All metadata surrounding the block.
	 * @param string  $content Empty string always.
	 * @param boolean $is_preview This will be true if the block is currently rendered in the gutenberg editor.
	 * @return void
	 */
	public function render_callback( $block, $content = '', $is_preview = false ) {
		$context = Timber::context();
		// Append semantic blockname to the block classlist.
		if ( ! empty( $block['className'] ) ) {
			$block['className'] .= ' block-' . static::get_block_name( '_' ); // If there already exists classes append it with a space.
		} else {
			$block['className'] = 'block-' . static::get_block_name( '_' ); // Otherwise just set it.
		}
		$context['block']      = $block; // Block metadata goes to block context.
		$context['is_preview'] = $is_preview; // If we are currently in a preview or not.

		$fields = array();
		
		if ( get_fields() ) {
            		$fields = get_fields();
        	}
		
		$render_context   = $this->populate_context( $context, $fields );
		$render_templates = $this->get_templates( $render_context );

		$this->load_script( $this->script_name, $this->script_path );

		do_action( 'jcore_block_render_callback', $block, $is_preview );

		Timber::render( $render_templates, $render_context );
	}

	/**
	 * Stub function to load script in.
	 *
	 * @return void
	 */
	protected function load_script( $name, $file ) {
		if ( ! empty( $name ) && ! empty( $file ) ) {
			Assets::script_register( $name, $file );
			wp_enqueue_script( $name );
		}
	}

	/**
	 * Get the block templates.
	 *
	 * @param array $context Timber render context.
	 *
	 * @return array
	 */
	protected function get_templates( $context ) {
		$templates = array(
			'blocks/block-' . static::get_block_name( '_' ) . '.twig',
		);
		if ( $context['is_preview'] ) {
			array_unshift( $templates, 'blocks/preview-' . static::get_block_name() . '.twig' );
		}
		return $templates;
	}

	/**
	 * This method can be overridden if you just want to add data to $context.
	 *
	 * @param array $context Timber render context.
	 * @param array $fields  ACF fields.
	 *
	 * @return array
	 */
	protected function populate_context( $context, $fields ) {
		$context['fields'] = $fields;
		return $context;
	}
}
