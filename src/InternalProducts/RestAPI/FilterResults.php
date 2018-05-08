<?php

namespace OWC\PDC\InternalProducts\RestAPI;

use WP_REST_Request;

class FilterResults
{

    /**
     * Only fetch internal posts when stated explicitly.
     * If not internal, only give posts which are external.
     *
     * @hook rest_pdc-item_query
     *
     * @param array           $args
     * @param WP_REST_Request $request
     *
     * @return array
     */
    public function filter($args, WP_REST_Request $request): array
    {
        $params = $request->get_query_params();

        if (isset($params['type']) && $params['type'] == 'internal') {
            return $this->queryInternal($args);
        }

        return $this->queryExternal($args);
    }

    /**
     * Create a tax query for internal posts.
     *
     * @param array $args
     *
     * @return array
     */
    private function queryInternal(array $args): array
    {
        $args['tax_query'] = [
            [
                'taxonomy' => 'pdc-type',
                'field'    => 'slug',
                'terms'    => 'internal'
            ]
        ];

        return $args;
    }

    /**
     * Create a tax query for external posts.
     *
     * @param array $args
     *
     * @return array
     */
    private function queryExternal(array $args): array
    {
        $args['tax_query'] = [
            [
                'taxonomy' => 'pdc-type',
                'field'    => 'slug',
                'terms'    => 'external'
            ]
        ];

        return $args;
    }

}