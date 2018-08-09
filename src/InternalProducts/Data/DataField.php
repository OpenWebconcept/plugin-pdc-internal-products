<?php
/**
 * Responsible for the filtering the internal keyword.
 */

namespace OWC\PDC\InternalProducts\Data;

use OWC\PDC\Base\Support\CreatesFields;
use WP_Post;

/**
 * Filters the internal keyword, and returns array.
 */
class DataField extends CreatesFields
{

    /**
     * Create the internaldata field for a given post.
     *
     * @param WP_Post $post
     *
     * @return array
     */
    public function create(WP_Post $post): array
    {
        return array_map(function ($item) {
            return [
                'key' => $item['internaldata_key'],
                'value' => $item['internaldata_value'],
            ];
        }, $this->getData($post));
    }

    /**
     * Filters the post if internal data of a given post exists.
     *
     * @param WP_Post $post
     *
     * @return array
     */
    private function getData(WP_Post $post): array
    {
        return array_filter(get_post_meta($post->ID, '_owc_pdc_internaldata', true) ?: [], function ($item) {
            return !empty($item['internaldata_key']) && !empty($item['internaldata_value']);
        });
    }
}
