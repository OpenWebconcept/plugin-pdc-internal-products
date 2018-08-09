<?php

/**
 * PHPUnit bootstrap file
 *
 * @package OWC\PDC\InternalProducts
 */

/**
 * Load dependencies with Composer autoloader.
 */
require __DIR__ . '/../../vendor/autoload.php';

define('WP_PLUGIN_DIR', __DIR__);

/**
 * Bootstrap WordPress Mock.
 */
\WP_Mock::setUsePatchwork( true );
\WP_Mock::bootstrap();

$GLOBALS['pdc-internal-products'] = [
	'active_plugins' => ['pdc-internal-products/pdc-internal-products.php'],
];

class WP_CLI {
	public static function add_command() {}
}
