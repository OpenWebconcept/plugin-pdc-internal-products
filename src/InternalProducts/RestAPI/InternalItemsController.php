<?php
/**
 * Get all the items of, which have the 'internal' taxonomy type.
 */

namespace OWC\PDC\InternalProducts\RestAPI;

use OWC\PDC\Base\Models\Item;
use OWC\PDC\Base\RestAPI\Controllers\BaseController;
use WP_REST_Request;

/**
 * Controls the retrieval of the internal pdc items.
 */
class InternalItemsController extends BaseController
{

    /**
     * Get a list of all internal items.
     *
     * @param WP_REST_Request $request
     *
     * @return array
     */
    public function getItems(WP_REST_Request $request)
    {
        $items = (new Item())
            ->query([
                'tax_query' => [
                    [
                        'taxonomy' => 'pdc-type',
                        'field' => 'slug',
                        'terms' => 'internal',
                    ],
                ],
            ])
            ->query($this->getPaginatorParams($request))
            ->hide(['connected']);

        $posts = $items->all();

        return $this->addPaginator($posts, $items->getQuery());
    }

}