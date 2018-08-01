<?php

namespace OWC\PDC\Internal\Taxonomy;

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

        $termCreator->createIfNotExists('Internal');
        $termCreator->createIfNotExists('External');
    }

}