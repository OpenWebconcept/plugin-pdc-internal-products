<?php

namespace OWC\PDC\Internal\Data;

use WP_Post;
use OWC\PDC\Base\Support\CreatesFields;

class DataField extends CreatesFields
{

    /**
     * Create the appointment field for a given post.
     *
     * @param WP_Post $post
     *
     * @return array
     */
    public function create(WP_Post $post): array
    {
        return array_map(function ($item) {
            return [
                'key'   => $item['internaldata_key'],
                'value' => $item['internaldata_value']
            ];
        }, $this->getData($post));
    }

    /**
     * Get the data of a given post.
     *
     * @param WP_Post $post
     *
     * @return array
     */
    private function getData(WP_Post $post): array
    {
        return array_filter(get_post_meta($post->ID, '_owc_pdc_internaldata', true) ?: [], function ($item) {
            return ! empty($item['internaldata_key']) && ! empty($item['internaldata_value']);
        });
    }

}