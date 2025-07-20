    <?php

    return [
        'title' => 'Role Management',
        'index' => [
            'subtitle' => 'List of roles',
            'table' => [
                'no' => 'No',
                'name' => 'Name',
                'action' => 'Action',
            ],
        ],
        'create' => [
            'subtitle' => 'Create new role',
        ],
        'edit' => [
            'subtitle' => 'Edit role',
        ],
        'form' => [
            'name' => ['title' => 'Role Name', 'placeholder' => 'Enter role name..'],
            'permission_ids' => ['title' => 'Permissions', 'placeholder' => 'Select permissions'],
        ],
    ];
