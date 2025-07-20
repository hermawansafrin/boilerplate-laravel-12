<?php

return [
    'success' => 'Berhasil mengambil data dari :url',
    'success_show' => 'Menampilkan data',
    'success_retrived' => 'Berhasil mengambil data',
    'success_show_year' => 'Menampilkan data untuk tahun',
    'token_not_found' => 'Token tidak ditemukan',
    'token_invalid' => 'Token tidak valid',
    'failed_cause_client_error' => ':url tidak dapat memproses permintaan Anda karena ketidaksesuaian input',
    'failed_cause_server_error' => ':url sedang tidak tersedia, silakan coba lagi nanti',

    'action_add' => 'ditambahkan',
    'action_edit' => 'diperbarui',
    'action_delete' => 'dihapus',
    'action_reset' => 'diatur ulang',
    'action_asked' => 'diajukan',
    'action_cancel' => 'dibatalkan',
    'action_complete' => 'diselesaikan',

    'confirmation' => [
        'cancel' => 'Apakah Anda yakin ingin membatalkan data ini?',
        'complete' => 'Apakah Anda yakin ingin menyelesaikan data ini?',
        'delete' => 'Apakah Anda yakin ingin menghapus data ini?',
    ],

    'session' => [
        'success' => [
            'title' => 'Berhasil!',
            'subtitle' => 'Data berhasil :action.',
        ],
        'failed' => [
            'title' => 'Gagal!',
            'subtitle' => 'Data gagal untuk :action.',
        ],
    ],
    'failed_must_auth' => 'Anda harus login terlebih dahulu',
    'failed' => [
        'limit_images' => 'Jumlah gambar melebihi batas',
    ],
    'filter_implemented' => 'Filter berhasil diterapkan',
    'cannot_editable_or_deletable' => 'Tidak dapat diedit atau dihapus',

    /**
     * FROM API
     */
    'auth' => [
        'login_success' => 'Login berhasil',
        'logout_success' => 'Logout berhasil',
        'unauthorized' => 'Tidak diizinkan',
    ],
];
