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
                                <a href="{{ route($ROUTE_PATH.'index') }}" class="btn btn-sm btn-danger">
                                    {{ __('button.back') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            {{-- saat ada action benar atau salah --}}
                            @include('admin.__components.alert_session')
                            <form action="{{ route($ROUTE_PATH.'store') }}" method="POST">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">
                                        {{ __($LANG_PATH.'form.name.title') }}<span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                        placeholder="{{ __($LANG_PATH.'form.name.placeholder') }}" required>
                                    @error('name')
                                    <span class="text-danger ml-2" style="font-size:14px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div style="margin-left: 0px !important" class="mt-8">
                                    @foreach($permissions as $key => $level1)
                                    <div class="form-check" style="margin-top: 10px !important; margin-bottom: 10px !important;">
                                        <input id="{{ $level1['id'] }}" class="" name="permission_ids[]" value="{{ $level1['id'] }}"
                                            type="checkbox">
                                        <label for="{{ $level1['id'] }}" class="">{{ $level1['title'] }}</label>
                                        @foreach($level1['child'] as $key2 => $level2)
                                            <div style="margin-left: 20px; !important">
                                                <div>
                                                    <input id="{{ $level2['id'] }}" name="permission_ids[]" type="checkbox" value="{{ $level2['id'] }}">
                                                    <label for="{{ $level2['id'] }}" class="">{{ $level2['title'] }}</label>
                                                </div>

                                                @foreach($level2['child'] as $key3 => $level3)
                                                    <div class="ml-3 d-flex" style="margin-left: 20px !important">
                                                        <input id="{{ $level3['id'] }}" class="" name="permission_ids[]" type="checkbox"
                                                            value="{{ $level3['id'] }}">
                                                        <label for="{{ $level3['id'] }}" class="fs-20 ml-2">{{ $level3['title'] }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    @endforeach
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
