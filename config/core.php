<?php

return [
    /**
             * Service Providers.
         */
    'providers' => [
        /**
     * Global providers.
     */
        OWC\PDC\InternalProducts\RestAPI\RestAPIServiceProvider::class,
        OWC\PDC\InternalProducts\Taxonomy\TaxonomyServiceProvider::class,

        /**
         * Providers specific to the admin.
         */
        'admin' => [
            OWC\PDC\InternalProducts\Data\DataServiceProvider::class,
        ],
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
        [
            'type' => 'plugin',
            'label' => 'OpenPDC Base',
            'version' => '2.2.13',
            'file' => 'pdc-base/pdc-base.php',
        ],
    ],
];
