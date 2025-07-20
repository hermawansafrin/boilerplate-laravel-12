@extends('admin.__layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $title }}</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">{{ $subtitle ?? '' }}</h3>
                            <div class="card-toolbar float-right">
                                <a href="{{ route($ROUTE_PATH.'index', ) }}" class="btn btn-sm btn-danger">
                                    {{ __('button.back') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            {{-- saat ada action benar atau salah --}}
                            @include('admin.__components.alert_session')
                            <form action="{{ route($ROUTE_PATH.'update', $params) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">
                                        {{ __($LANG_PATH.'form.name.title') }}<span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $editedData['name'] }}"
                                        placeholder="{{ __($LANG_PATH.'form.name.placeholder') }}" required>
                                    @error('name')
                                    <span class="text-danger ml-2" style="font-size:14px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">
                                        {{ __($LANG_PATH.'form.email.title') }}<span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $editedData['email'] }}"
                                        placeholder="{{ __($LANG_PATH.'form.email.placeholder') }}" required>
                                    @error('email')
                                    <span class="text-danger ml-2" style="font-size:14px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="role_id" class="form-label">
                                        {{ __($LANG_PATH.'form.role_id.title') }}<span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control select2" id="role_id" name="role_id" required>
                                        <option value="">{{ __($LANG_PATH.'form.role_id.placeholder') }}</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role['id'] }}" {{ ($editedData['role']['id'] ?? 0) == $role['id'] ? 'selected' : '' }}>{{ $role['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="text-danger ml-2" style="font-size:14px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="is_active" class="form-label">
                                        {{ __($LANG_PATH.'form.is_active.title') }}<span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control select2" id="is_active" name="is_active" required>
                                        <option value="">{{ __($LANG_PATH.'form.is_active.placeholder') }}</option>
                                        <option value="1" {{ $editedData['is_active'] == 1 ? 'selected' : '' }}>{{ __('general.active') }}</option>
                                        <option value="0" {{ $editedData['is_active'] == 0 ? 'selected' : '' }}>{{ __('general.inactive') }}</option>
                                    </select>
                                    @error('is_active')
                                        <span class="text-danger ml-2" style="font-size:14px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">
                                        {{ __($LANG_PATH.'form.password.title') }}
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                                        placeholder="{{ __($LANG_PATH.'form.password.placeholder') }}">
                                    @error('password')
                                        <span class="text-danger ml-2" style="font-size:14px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">
                                        {{ __($LANG_PATH.'form.password_confirmation.title') }}
                                    </label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                        placeholder="{{ __($LANG_PATH.'form.password_confirmation.placeholder') }}">
                                    @error('password_confirmation')
                                        <span class="text-danger ml-2" style="font-size:14px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary m-2 col-12">
                                    {{ __('button.save') }}
                                </button>
                            </form>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('before_styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin-template') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('admin-template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('before_scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin-template') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function(){
            //init select2
            $('.select2').select2();
        })
    </script>
@endpush
