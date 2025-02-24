<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

namespace Jcore\Blocks;

use Jcore\Ydin\BootstrapInterface;

$autoloader = __DIR__ . '/../vendor/autoload.php';
if ( file_exists( $autoloader ) ) {
	require_once $autoloader;
}

/**
 * The bootstrap class, should be used by all dependencies.
 */
class Bootstrap implements BootstrapInterface {
	/**
	 * The singleton instance.
	 *
	 * @var Bootstrap|null
	 */
	private static ?Bootstrap $instance = null;

	/**
	 * Bootstrap constructor.
	 */
	private function __construct() {
		add_filter(
			'timber/locations',
			static function ( $locations ) {
				$locations['__main__'][] = trailingslashit( __DIR__ ) . '../blocks';
				return $locations;
			}
		);
		Blocks::init();
	}

	/**
	 * Get the singleton instance.
	 *
	 * @return Bootstrap
	 */
	public static function init(): Bootstrap {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
