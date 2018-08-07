<?php

namespace OWC\PDC\Internal\Foundation;

use OWC\PDC\Base\Foundation\Plugin as BasePlugin;

/**
 * The base of the plugin.
 *
 * Sets the name and version of the plugin.
 */
class Plugin extends BasePlugin
{

    /**
     * Name of the plugin.
     *
     * @var string
     */
    const NAME = 'pdc-internal';

    /**
     * Version of the plugin.
     * Used for setting versions of enqueue scripts and styles.
     *
     * @var string
     */
    const VERSION = '1.0.0';

}
