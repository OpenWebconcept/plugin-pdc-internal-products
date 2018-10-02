<?php

return [
    'internaldata' => [
        'id'         => 'pdc_internaldata',
        'title'      => __('Internal Data', 'pdc-internal-products'),
        'post_types' => ['pdc-item'],
        'context'    => 'normal',
        'priority'   => 'high',
        'autosave'   => true,
        'include'    => [
            'pdc-type' => 'internal',
        ],
        'fields'     => [
            'internaldata' => [
                'group' => [
                    'id'         => 'pdc_internaldata',
                    'type'       => 'group',
                    'clone'      => true,
                    'sort_clone' => true,
                    'add_button' => __('Add internal data', 'pdc-internal-products'),
                    'fields'     => [
                        [
                            'id'   => 'internaldata_key',
                            'name' => __('Key', 'pdc-internal-products'),
                            'type' => 'text',
                        ],
                        [
                            'id'   => 'internaldata_value',
                            'name' => __('Value', 'pdc-internal-products'),
                            'type' => 'wysiwyg',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
