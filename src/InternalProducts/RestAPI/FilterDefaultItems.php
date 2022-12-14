<?php
/**
 * Filters PDC item are of type "external".
 */

namespace OWC\PDC\InternalProducts\RestAPI;

use OWC\PDC\Base\Support\Traits\AppendToTaxQuery;

/**
 * Filters PDC item are of type "external".
 */
class FilterDefaultItems
{
    use AppendToTaxQuery;

    /**
     * Ensures that all regular PDC item are of type "external".
     *
     * @filter owc/pdc/rest-api/items/query
     *
     * @param array $args
     *
     * @return array
     */
    public function filter(array $args): array
    {
        $args['tax_query'] = $this->appendToTaxQuery($args['tax_query'] ?? [], [
            'taxonomy' => 'pdc-type',
            'field'    => 'slug',
            'terms'    => 'external',
        ]);

        return $args;
    }
}
