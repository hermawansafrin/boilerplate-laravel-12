<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin-template') }}/plugins/fontawesome-free/css/all.min.css">

        @stack('before_styles')

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin-template') }}/dist/css/adminlte.min.css">

        @stack('styles')
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
