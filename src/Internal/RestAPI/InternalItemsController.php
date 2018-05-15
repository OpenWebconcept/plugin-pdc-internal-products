<?php

namespace OWC\PDC\Internal\RestAPI;

use OWC\PDC\Base\Models\ItemModel;

class InternalItemsController
{

    /**
     * Get a list of all internal items.
     *
     * @return array
     */
    public function getItems()
    {
        $items = (new ItemModel())
            ->query([
                'tax_query' => [
                    [
                        'taxonomy' => 'pdc-type',
                        'field'    => 'slug',
                        'terms'    => 'internal'
                    ]
                ]
            ])
            ->hide([ 'connected' ]);

        return $items->all();
    }

}