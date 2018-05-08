<?php

namespace OWC\PDC\InternalProducts\Foundation;

use OWC\PDC\Base\Foundation\Plugin as BasePlugin;

class Plugin extends BasePlugin
{

    /**
     * Name of the plugin.
     *
     * @var string
     */
    const NAME = 'pdc-internal-products';

    /**
     * Version of the plugin.
     * Used for setting versions of enqueue scripts and styles.
     *
     * @var string
     */
    const VERSION = '1.0.0';

}