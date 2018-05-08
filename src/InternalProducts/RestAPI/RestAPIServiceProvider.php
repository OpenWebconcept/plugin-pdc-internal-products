<?php

namespace OWC\PDC\InternalProducts\RestAPI;

use OWC\PDC\Base\Foundation\ServiceProvider;

class RestAPIServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->plugin->loader->addAction('rest_pdc-item_query', new FilterResults, 'filter', 10, 2);
    }
}