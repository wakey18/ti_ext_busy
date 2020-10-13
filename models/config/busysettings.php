<?php

/**
 * Model configuration options for BusySettings model.
 */

return [
    'form' => [
        'toolbar' => [
            'buttons' => [
                'back' => [
                    'label' => 'lang:admin::lang.button_icon_back',
                    'class' => 'btn btn-default',
                    'href' => 'settings',
                ],
                'save' => [
                    'label' => 'lang:admin::lang.button_save',
                    'class' => 'btn btn-primary',
                    'data-request' => 'onSave'
                ],
                'saveClose' => [
                    'label' => 'lang:admin::lang.button_save_close',
                    'class' => 'btn btn-default',
                    'data-request' => 'onSave',
                    'data-request-data' => 'close:1',
                ],
            ],
        ],
        'fields' => [
            'busy' => [
                'label' => 'wakey.busy::default.label_busy',
                'type' => 'switch',
                'comment' => 'wakey.busy::default.help.comment',
            ],

            'busy_message' => [
                'label' => 'wakey.busy::default.label_busy_message',
                'type' => 'textarea',
                'default' => 'We are currently experiencing a high volume of orders and have decided to temporarily disable the checkout. Please check back soon.',
                'trigger' => [
                    'action' => 'show',
                    'field' => 'busy',
                    'condition' => 'checked',
                ],
            ],
        ],
    ],
];
