<?php

namespace OWC\PDC\Internal\RestAPI;

use OWC\PDC\Base\Foundation\ServiceProvider;

class RestAPIServiceProvider extends ServiceProvider
{

    private $namespace = 'owc/pdc/v1';

    /**
     * Register the service provider.
     */
    public function register()
    {
        add_action('rest_api_init', [ $this, 'registerRoutes' ], 'register');
    }

    /**
     * Register REST routes.
     */
    public function registerRoutes()
    {
        register_rest_route($this->namespace, 'internal/items', [
            'methods'  => 'GET',
            'callback' => [ new InternalItemsController, 'getItems' ],
        ]);
    }
}