<?php

/**
 * Plugin Name:       PDC Internal Products
 * Plugin URI:        https://www.openwebconcept.nl/
 * Description:       Splits all of the PDC items in two distinct types: internal and/or external products.
 * Version:           2.0.4
 * Author:            Yard | Digital Agency
 * Author URI:        https://www.yard.nl/
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       pdc-internal-products
 * Domain Path:       /languages
 */

use OWC\PDC\InternalProducts\Autoloader;
use OWC\PDC\InternalProducts\Foundation\Plugin;

/**
 * If this file is called directly, abort.
 */
if (!defined('WPINC')) {
    die;
}

/**
 * manual loaded file: the autoloader.
 */
require_once __DIR__ . '/autoloader.php';
$autoloader = new Autoloader();

/**
 * Begin execution of the plugin
 *
 * This hook is called once any activated plugins have been loaded. Is generally used for immediate filter setup, or
 * plugin overrides. The plugins_loaded action hook fires early, and precedes the setup_theme, after_setup_theme, init
 * and wp_loaded action hooks.
 */
add_action('plugins_loaded', function () {
    (new Plugin(__DIR__))->boot();
}, 11);
