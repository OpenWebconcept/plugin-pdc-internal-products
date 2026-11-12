<?php

/**
 * Boots the rest API service provider.
 */

namespace OWC\PDC\InternalProducts\RestAPI;

use OWC\PDC\Base\Foundation\ServiceProvider;

/**
 * Boots the rest API service provider.
 */
class RestAPIServiceProvider extends ServiceProvider
{

    /**
     * Endpoint of the rest API.
     *
     * @var string;
     */
    private $namespace = 'owc/pdc/v1';

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->plugin->loader->addAction('rest_api_init', $this, 'registerRoutes');
        $this->plugin->loader->addFilter('owc/pdc/rest-api/items/query', new FilterDefaultItems, 'filter', 10, 1);
    }

    /**
     * Register routes on the rest API.
     *
     * Get all items, including internal values and internal items.
     *
     * @link https://{url}/wp-json/owc/pdc/v1/items/internal
     *
     * Get item, including internal values and internal item.
     * @link https://{url}/wp-json/owc/pdc/v1/items/{id}/internal
     */
    public function registerRoutes()
    {
        $controller = new InternalItemsController($this->plugin);

        register_rest_route($this->namespace, 'items/internal', [
            'methods'             => 'GET',
            'callback'            => [$controller, 'getItems'],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
            'args'                => $controller->collectionArguments(),
        ]);

        register_rest_route($this->namespace, 'items/(?P<id>\d+)/internal', [
            'methods'             => 'GET',
            'callback'            => [$controller, 'getItem'],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
            'args'                => $controller->itemArguments(),
        ]);

        register_rest_route($this->namespace, 'items/(?P<slug>[\w-]+)/internal', [
            'methods'             => 'GET',
            'callback'            => [$controller, 'getItemBySlug'],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
            'args'                => $controller->itemBySlugArguments(),
        ]);
    }
}
