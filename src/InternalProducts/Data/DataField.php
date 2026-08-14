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
     * Filter which allows adding to, or changing of, the internal data.
     */
    const INTERNAL_DATA_FILTER = 'owc/pdc/internal-products/internal-data';

    /**
     * Create the internaldata field for a given post.
     *
     * @param WP_Post $post
     *
     * @return array
     */
    public function create(WP_Post $post): array
    {
        $internalData = array_map(function ($item) {
            return [
                'title'   => $item['internaldata_key'],
                'content' => apply_filters('the_content', $item['internaldata_value']),
            ];
        }, $this->getData($post));

        $internalData = apply_filters(self::INTERNAL_DATA_FILTER, $internalData, $post);

        return is_array($internalData) ? $internalData : [];
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
            return ! empty($item['internaldata_key']) && ! empty($item['internaldata_value']);
        });
    }
}
