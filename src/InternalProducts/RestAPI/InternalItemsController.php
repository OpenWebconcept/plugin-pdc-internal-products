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
        $items = (new Item())
            ->query($this->getPaginatorParams($request));

        if (null === $request->get_param('include-connected')) {
            $items->hide(['connected']);
        }

        if ('external' === $request->get_param('exclude')) {
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

    public function collectionArguments(): array
    {
        return [
            'limit' => [
                'description' => 'Maximum number of items per page, -1 returns all items.',
                'type'        => 'integer',
                'minimum'     => -1,
                'default'     => 10,
            ],
            'page' => [
                'description' => 'Page of the collection to return.',
                'type'        => 'integer',
                'minimum'     => 1,
                'default'     => 1,
            ],
            // Untyped: sites send a bare ?include-connected flag, which a boolean type would reject.
            'include-connected' => [
                'description' => 'Include connected items when present.',
            ],
            'exclude' => [
                'description' => 'Set to external to return internal items only.',
                'type'        => 'string',
                'enum'        => ['external'],
            ],
        ];
    }

    public function itemArguments(): array
    {
        return [
            'id' => [
                'description' => 'ID of the item.',
                'type'        => 'integer',
            ],
        ];
    }

    public function itemBySlugArguments(): array
    {
        return [
            'slug' => [
                'description' => 'Slug of the item.',
                'type'        => 'string',
            ],
        ];
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
