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
        OWC\PDC\InternalProducts\Data\DataServiceProvider::class,

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
        [
            'label'   => 'OpenPDC Base',
            'file'    => 'pdc-base/pdc-base.php',
            'version' => '2.0.0',
            'type' => ''
        ]
    ]

];