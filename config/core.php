<?php

return [

    /**
     * Service Providers.
     */
    'providers'    => [
        /**
         * Global providers.
         */
        OWC\PDC\InternalProducts\RestAPI\RestAPIServiceProvider::class,
        OWC\PDC\InternalProducts\Taxonomy\TaxonomyServiceProvider::class,

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