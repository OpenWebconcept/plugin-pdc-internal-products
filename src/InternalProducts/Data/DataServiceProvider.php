<?php
/**
 * Boots the DataServiceProvider.
 */

namespace OWC\PDC\InternalProducts\Data;

use OWC\PDC\Base\Foundation\ServiceProvider;
use OWC\PDC\Base\Models\Item;
use WP_Post;

/**
 * Boots the DataServiceProvider.
 */
class DataServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider, only when in admin or if accessed via the /internal endpoint.
     */
    public function register()
    {
        // Add the internal data to all pdc items, when in admin or if accessed via the /internal endpoint.
        Item::addGlobalField('internal-data', new DataField($this->plugin), function (WP_Post $post) {
            return true;
        });

        $this->plugin->loader->addAction('owc/pdc-base/plugin', new Metaboxes($this->plugin), 'register', 10, 1);
    }
}
