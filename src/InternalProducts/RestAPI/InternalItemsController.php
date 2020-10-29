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
     * Plugin instance
     *
     * @var Plugin
     */
    protected $plugin;

    /**
     * Constructor
     *
     * @param Plugin $plugin
     */
    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Get a list of all internal items.
     *
     * @param WP_REST_Request $request
     *
     * @return array
     */
    public function getItems(WP_REST_Request $request)
    {

        $this->addFields();
        $parameters = $this->convertParameters($request->get_params());
        $items = (new Item())
            ->query([])
            ->query($this->getPaginatorParams($request));

        if (false === $parameters['include-connected']) {
            $items->hide(['connected']);
        }

        $posts = $items->all();

        return $this->addPaginator($posts, $items->getQuery());
    }

    /**
     * Get a internal item.
     *
     * @param WP_REST_Request $request
     *
     * @return array
     */
    public function getItem(WP_REST_Request $request)
    {

        $this->addFields();

        $id = (int) $request->get_param('id');

        $item = (new Item)
            ->query(apply_filters('owc/pdc/rest-api/items/query/single', []))
            ->find($id);

        if (!$item) {
            return new \WP_Error('no_item_found', sprintf('Item with ID "%d" not found', $id), [
                'status' => 404,
            ]);
        }

        return $item;
    }

    /**
     * Register the DataServiceProvider.
     *
     * @return void
     */
    protected function addFields()
    {
        (new DataServiceProvider($this->plugin))->register();
    }

    /**
     * Convert the parameters to the allowed ones.
     *
     * @param array $parametersFromRequest
     * @return array
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

        return $parameters;
    }
}
