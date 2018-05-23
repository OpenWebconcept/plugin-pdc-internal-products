<?php

return [

    /**
     * Service Providers.
     */
    'providers'    => [
        /**
         * Global providers.
         */
        OWC\PDC\Internal\RestAPI\RestAPIServiceProvider::class,
        OWC\PDC\Internal\Taxonomy\TaxonomyServiceProvider::class,
        OWC\PDC\Internal\Data\DataServiceProvider::class,

        /**
         * Providers specific to the admin.
         */
        'admin' => [
        ]

    ],

    /**
     * Dependencies upon which the plugin relies.
     *
     * Required: type, label
     * Optional: message
     *
     * Type: plugin
     * - Required: file
     * - Optional: version
     *
     * Type: class
     * - Required: name
     */
    'dependencies' => [
        //
    ]

];