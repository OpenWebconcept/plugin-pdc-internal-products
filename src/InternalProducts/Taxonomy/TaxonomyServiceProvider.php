<?php

namespace OWC\PDC\InternalProducts\Taxonomy;

use OWC\PDC\Base\Foundation\ServiceProvider;

class TaxonomyServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->plugin->loader->addAction('init', $this, 'createTerms');
    }

    public function createTerms()
    {
        $termCreator = new TermCreator('pdc-type');

        $termCreator->createIfNotExists(__('Internal', 'pdc-internal-products'));
        $termCreator->createIfNotExists(__('External', 'pdc-internal-products'));
    }

}