<?php

return [
    'title' => 'Kelola Pengguna',
    'index' => [
        'subtitle' => 'Daftar pengguna',
        'table' => [
            'no' => 'No',
            'name' => 'Nama',
            'email' => 'Email',
            'role' => 'Peran',
            'active_status' => 'Status',
            'action' => 'Aksi',
        ],
    ],
    'create' => [
        'subtitle' => 'Buat pengguna baru',
    ],
    'edit' => [
        'subtitle' => 'Ubah pengguna',
    ],
    'form' => [
        'name' => ['title' => 'Nama Pengguna', 'placeholder' => 'Masukkan nama pengguna..'],
        'email' => ['title' => 'Email Pengguna', 'placeholder' => 'Masukkan email pengguna..'],
        'role_id' => ['title' => 'Peran Pengguna', 'placeholder' => 'Pilih peran pengguna..'],
        'is_active' => ['title' => 'Status Pengguna', 'placeholder' => 'Pilih status pengguna..'],
        'password' => ['title' => 'Kata Sandi Pengguna', 'placeholder' => 'Masukkan kata sandi pengguna..'],
        'password_confirmation' => ['title' => 'Konfirmasi Kata Sandi Pengguna', 'placeholder' => 'Masukkan konfirmasi kata sandi pengguna..'],
    ],
];
