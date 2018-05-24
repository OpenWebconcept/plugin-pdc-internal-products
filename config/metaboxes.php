<?php

return [
    'id'         => 'pdc_internaldata',
    'title'      => __('Internal Data', 'pdc-internal'),
    'post_types' => [ 'pdc-item' ],
    'context'    => 'normal',
    'priority'   => 'high',
    'autosave'   => true,
    'include'    => [
        'pdc-type' => 'internal'
    ],
    'fields'     => [
        'internaldata' => [
            'group' => [
                'id'            => 'pdc_internaldata',
                'type'          => 'group',
                'clone'         => true,
                'sort_clone'    => true,
                'collapsible'   => true,
                'group_title'   => [ 'field' => 'internaldata_key' ],
                'default_state' => 'collapsed',
                'fields'        => [
                    [
                        'id'   => 'internaldata_key',
                        'name' => __('Key', 'pdc-internal'),
                        'type' => 'text',
                    ],
                    [
                        'id'   => 'internaldata_value',
                        'name' => __('Value', 'pdc-internal'),
                        'type' => 'text',
                    ],
                ]
            ]
        ]
    ]
];

