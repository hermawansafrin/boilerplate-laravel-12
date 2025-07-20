<?php

return [

    /** settings */
    [
        'permissions' => 'settings',
        'parent_permissions' => null,
        'childs' => [
            [
                'permissions' => 'settings_user',
                'childs' => [
                    ['permissions' => 'settings_user_add', 'childs' => null],
                    ['permissions' => 'settings_user_edit', 'childs' => null],
                    ['permissions' => 'settings_user_delete', 'childs' => null],
                ],
            ],
            [
                'permissions' => 'settings_role',
                'childs' => [
                    ['permissions' => 'settings_role_add', 'childs' => null],
                    ['permissions' => 'settings_role_edit', 'childs' => null],
                    ['permissions' => 'settings_role_delete', 'childs' => null],
                ],
            ],
        ],
    ],

    // add here again if there is some new permission data
];
