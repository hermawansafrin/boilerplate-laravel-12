<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ __($LANG_PATH.'title') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin-template') }}/plugins/fontawesome-free/css/all.min.css" />
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('admin-template') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin-template') }}/dist/css/adminlte.min.css" />
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <img src="{{ asset('') }}/logo.png" alt="{{ config('app.name') }} Logo"
                        class="img img-responsive brand-image img-circle elevation-3" style="opacity: 0.9;max-width: 120px;" />
                </div>
                <div class="card-body">
                    <p class="login-box-msg">
                        {{ __($LANG_PATH.'heading') }}
                    </p>

                    <form action="{{ route('postlogin') }}" method="POST">
                        @csrf

                        {{-- errors --}}
                        @if($errors->any())
                            <!--begin::Alert-->
                            <div class="alert alert-danger d-flex align-items-center p-1">
                                <!--begin::Icon-->
                                <i class="fas fa-exclamation-triangle text-danger fs-1"></i>
                                <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column m-2" >
                                    <!--begin::Title-->
                                    <h4 class="mb-1 text-dark"></h4>
                                    <!--end::Title-->

                                    <!--begin::Content-->
                                    <span>
                                        @if($errors->count() === 1 && $errors->has('attempt'))
                                            {{ $errors->first('attempt') }}
                                        @else
                                            {{ __('auth.login_failed') }}
                                        @endif
                                    </span>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->

                            @php
                                $isCurrentHasError = true;

                                if($errors->count() === 1 && $errors->has('attempt')) {
                                    $isCurrentHasError = false; //if error only cause credentials failed, make sure its false
                                }
                            @endphp
                        @else
                            @php
                                $isCurrentHasError = false;
                            @endphp
                        @endif

                        <div class="input-group {{ $isCurrentHasError === true ? '' : 'mb-3' }}">
                            <input name="email" type="email" class="form-control" placeholder="{{ __($LANG_PATH.'form.email.placeholder') }}" required />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        @error('email')
                            <div class="input-group mb-3">
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            </div>
                        @enderror

                        <div class="input-group {{ $isCurrentHasError === true ? '' : 'mb-3' }}">
                            <input name="password" type="password" class="form-control" placeholder="{{ __($LANG_PATH.'form.password.placeholder') }}" required />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        @error('password')
                            <div class="input-group mb-3">
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            </div>
                        @enderror

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __($LANG_PATH.'button.sign_in') }}
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ asset('admin-template') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('admin-template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admin-template') }}/dist/js/adminlte.min.js"></script>
    </body>
</html>
