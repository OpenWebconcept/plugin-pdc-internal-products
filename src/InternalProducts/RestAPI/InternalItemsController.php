<?php

/**
 * Get all the items of, which have the 'internal' taxonomy type.
 */

namespace OWC\PDC\InternalProducts\RestAPI;

use OWC\PDC\Base\Foundation\Plugin;
use OWC\PDC\Base\Repositories\Item;
use OWC\PDC\Base\RestAPI\Controllers\BaseController;
use OWC\PDC\InternalProducts\Data\DataServiceProvider;
use WP_REST_Request;

/**
 * Controls the retrieval of the internal pdc items.
 */
class InternalItemsController extends BaseController
{
    /**
     * Instance of the plugin.
     */
    protected Plugin $plugin;

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    public function getItems(WP_REST_Request $request): array
    {
        $this->addFields();
        $parameters = $this->convertParameters($request->get_params());
        $items      = (new Item())
            ->query($this->getPaginatorParams($request));

        if (false === $parameters['include-connected']) {
            $items->hide(['connected']);
        }

        if ('external' === $parameters['exclude']) {
            $items->query($this->internalTypeOnlyTaxonomyParams());
        }

        $posts = $items->all();

        return $this->addPaginator($posts, $items->getQuery());
    }

    /**
     * @return array|WP_Error
     */
    public function getItem(WP_REST_Request $request)
    {
        $this->addFields();

        $id = (int) $request->get_param('id');

        $item = (new Item)
            ->query(apply_filters('owc/pdc/rest-api/items/query/single', []))
            ->find($id);

        if (!$item) {
            return new \WP_Error('no_item_found', sprintf("Item with ID '%d' not found", $id), [
                'status' => 404,
            ]);
        }

        return $item;
    }

    /**
     * @return array|WP_Error
     */
    public function getItemBySlug(WP_REST_Request $request)
    {
        $this->addFields();

        $slug = $request->get_param('slug');

        $item = (new Item)
            ->query(apply_filters('owc/pdc/rest-api/items/query/single', []))
            ->findBySlug($slug);

        if (!$item) {
            return new \WP_Error('no_item_found', sprintf("Item with SLUG '%s' not found", $slug), [
                'status' => 404,
            ]);
        }

        return $item;
    }

    /**
     * Register the DataServiceProvider.
     */
    protected function addFields(): void
    {
        (new DataServiceProvider($this->plugin))->register();
    }

    /**
     * Convert the parameters to the allowed ones.
     */
    protected function convertParameters(array $parametersFromRequest): array
    {
        $parameters = [];

        if (isset($parametersFromRequest['name'])) {
            $parameters['name'] = esc_attr($parametersFromRequest['name']);
        }

        $parameters['include-connected'] = (isset($parametersFromRequest['include-connected'])) ? true : false;

        if (isset($parametersFromRequest['slug'])) {
            $parameters['name'] = esc_attr($parametersFromRequest['slug']);
            unset($parametersFromRequest['slug']);
        }

        if (isset($parametersFromRequest['id'])) {
            $parameters['p'] = absint($parametersFromRequest['id']);
            unset($parametersFromRequest['slug']);
        }

        if (isset($parametersFromRequest['exclude'])) {
            $parameters['exclude'] = esc_attr($parametersFromRequest['exclude']);
            unset($parametersFromRequest['exclude']);
        }

        return $parameters;
    }

    private function internalTypeOnlyTaxonomyParams()
    {
        return [
            'tax_query' => [
                'relation'  => 'AND',
                [
                    'taxonomy' => 'pdc-type',
                    'field'    => 'slug',
                    'terms'    => 'internal',
                ]
            ],
        ];
    }
}
