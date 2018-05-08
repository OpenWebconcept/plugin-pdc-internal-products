<?php
/**
 * Plugin Name:       PDC Interne Producten
 * Plugin URI:        https://www.openwebconcept.nl/
 * Description:       Splitst de PDC items op voor intern en/of extern gebruik
 * Version:           1.0.0
 * Author:            Melvin Koopmans
 * Author URI:        https://www.yarddigital.nl/
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       pdc-interne-producten
 * Domain Path:       /languages
 */

use OWC\PDC\InterneProducten\Autoloader;
use OWC\PDC\InterneProducten\Foundation\Plugin;

/**
 * If this file is called directly, abort.
 */
if ( ! defined('WPINC')) {
    die;
}

/**
 * manual loaded file: the autoloader.
 */
require_once __DIR__.'/autoloader.php';
$autoloader = new Autoloader();

/**
 * Begin execution of the plugin
 *
 * This hook is called once any activated plugins have been loaded. Is generally used for immediate filter setup, or
 * plugin overrides. The plugins_loaded action hook fires early, and precedes the setup_theme, after_setup_theme, init
 * and wp_loaded action hooks.
 *
 */
$plugin = new Plugin(__DIR__);

add_action('plugins_loaded', function () use ($plugin) {
    $plugin->boot();
}, 9);
