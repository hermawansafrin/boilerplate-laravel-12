<?php

return [
    'title' => 'User Management',
    'index' => [
        'subtitle' => 'List of users',
        'table' => [
            'no' => 'No',
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
            'active_status' => 'Status',
            'action' => 'Action',
        ],
    ],
    'create' => [
        'subtitle' => 'Create new user',
    ],
    'edit' => [
        'subtitle' => 'Edit user',
    ],
    'form' => [
        'name' => ['title' => 'User Name', 'placeholder' => 'Enter user name..'],
        'email' => ['title' => 'User Email', 'placeholder' => 'Enter user email..'],
        'role_id' => ['title' => 'User Role', 'placeholder' => 'Select user role..'],
        'is_active' => ['title' => 'User Status', 'placeholder' => 'Select user status..'],
        'password' => ['title' => 'User Password', 'placeholder' => 'Enter user password..'],
        'password_confirmation' => ['title' => 'User Password Confirmation', 'placeholder' => 'Enter user password confirmation..'],
    ],
];
