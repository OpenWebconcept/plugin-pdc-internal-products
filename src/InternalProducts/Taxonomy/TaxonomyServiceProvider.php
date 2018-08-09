<?php
/**
 *  TaxonomyServiceProvider boots necessary methods.
 */

namespace OWC\PDC\InternalProducts\Taxonomy;

use OWC\PDC\Base\Foundation\ServiceProvider;

/**
 * TaxonomyServiceProvider boots necessary methods.
 */
class TaxonomyServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->plugin->loader->addAction('init', $this, 'createTerms');
    }

    /**
     * asdf
     */
    public function createTerms()
    {
        $termCreator = new TermCreator('pdc-type');

        $termCreator->createIfNotExists('Internal');
        $termCreator->createIfNotExists('External');
    }

}
