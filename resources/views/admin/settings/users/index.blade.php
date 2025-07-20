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
                                <a href="{{ route($ROUTE_PATH.'create') }}" class="btn btn-sm btn-primary">
                                    {{ __('button.add') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <input id="getEndpoint" value="{{ route($ROUTE_PATH.'getYajra') }}" type="hidden" />
                        <input type="hidden" id="filterMsg" value="{{ __('messages.filter_implemented') }}" />

                        <div class="card-body">
                            @include('admin.__components.alert_session')

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-3 m-1">
                                        <label for="search_values" class="form-label">{{ __('general.search') }}</label>
                                        <input type="text" id="search_values" placeholder="{{ __('general.search') }}.."
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive col-12 mt-3">
                                <table class="table table-bordered" style="width: 100%;" id="myTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>{{ __($LANG_PATH.'index.table.name') }}</th>
                                            <th>{{ __($LANG_PATH.'index.table.email') }}</th>
                                            <th>{{ __($LANG_PATH.'index.table.role') }}</th>
                                            <th>{{ __($LANG_PATH.'index.table.active_status') }}</th>
                                            <th>{{ __($LANG_PATH.'index.table.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
    @include('admin.__components.init_datatable_up')
    @include('admin.__components.init_toastr_up')
@endpush

@push('before_scripts')
    @include('admin.__components.init_datatable_down')
    @include('admin.__components.init_toastr_down')
    <script>

        $(function(){
            const filterMsg = $('#filterMsg').val();

            let customDataTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: $('#getEndpoint').val(),
                    data: function(keyword) {
                        keyword.search_values = $('#search_values').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    { data: 'active_status', name: 'active_status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#search_values').on('keyup', function(e) {
                if(e.which == 13) {
                    customDataTable.draw();
                    toastrSuccess(filterMsg);
                }
            });
        });

    </script>
@endpush
