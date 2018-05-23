<?php

namespace OWC\PDC\Internal\Data;

use OWC\PDC\Base\Foundation\Plugin;

class Metaboxes
{

    /**
     * Instance of the Plugin.
     *
     * @var Plugin
     */
    private $plugin;

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Register metaboxes for internal data into pdc-base plugin.
     *
     * @param Plugin $basePlugin
     */
    public function register(Plugin $basePlugin)
    {
        $basePlugin->config->set('metaboxes.internaldata', $this->plugin->config->get('metaboxes'));
    }

}