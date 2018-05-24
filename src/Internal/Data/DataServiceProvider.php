<?php

namespace OWC\PDC\Internal\Data;

use OWC\PDC\Base\Foundation\ServiceProvider;
use OWC\PDC\Base\Models\Item;
use WP_Post;

class DataServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        // Add the internal data to all posts which have internal data.
        Item::addGlobalField('internal_data', new DataField($this->plugin), function (WP_Post $post) {
            return has_term('internal', 'pdc-type', $post->ID);
        });

        $this->plugin->loader->addAction('owc/pdc-base/plugin', new Metaboxes($this->plugin), 'register', 10, 1);
    }

}