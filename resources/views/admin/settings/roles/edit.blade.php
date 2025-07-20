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
                            <form action="{{ route($ROUTE_PATH.'update', $params) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">
                                        {{ __($LANG_PATH.'form.name.title') }}<span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $editedData['role']['name'] ?? '' }}"
                                        placeholder="{{ __($LANG_PATH.'form.name.placeholder') }}" required>
                                    @error('name')
                                    <span class="text-danger ml-2" style="font-size:14px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div style="margin-left: 0px !important" class="mt-8">
                                    @foreach($editedData['permissions'] as $key => $level1)
                                    <div class="form-check m-2">
                                        <input name="permission_ids[]" value="{{ $level1['id'] }}" type="checkbox" {{
                                            in_array($level1['name'], $editedData['permission_role_name'])
                                            ? 'checked' : '' }}>
                                        <label>{{ $level1['title'] }}</label>
                                        @foreach($level1['child'] as $key2 => $level2)
                                            <div style="margin-left: 20px; margin-bottom: 10px !important">
                                                <div>
                                                    <input name="permission_ids[]" type="checkbox" value="{{ $level2['id'] }}" {{
                                                        in_array($level2['name'], $editedData['permission_role_name']) ? 'checked' : ''
                                                        }}>
                                                    <label>{{ $level2['title'] }}</label>
                                                </div>

                                                @foreach($level2['child'] as $key3 => $level3)
                                                <div style="margin-left: 20px !important">
                                                    <input name="permission_ids[]" type="checkbox" value="{{ $level3['id'] }}" {{
                                                        in_array($level3['name'], $editedData['permission_role_name']) ? 'checked' : ''
                                                        }}>
                                                    <label>{{ $level3['title'] }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary m-2">
                                    {{ __('button.edit') }}
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
