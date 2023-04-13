@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.datatable.datatable_css')
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/custom/account-setting.css') }}">
    @endpush
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <div class="page-meta mt-3">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </nav>
            </div>

            <div class="row" id="cancel-row">

                <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between">
                                    <h4>{{ session('title') }}</h4>
                                    @if (Auth::guard('admin')->check())
                                        <div class="form-group row my-auto mx-3">
                                            <label for="inputUsername" class="col-auto col-form-label my-auto">Pilih
                                                Tingkat</label>
                                            <div class="col">
                                                <select name="id_level" id="id_level" class="form-control">
                                                    <option value="" selected disabled>-- Pilih Tingkat --</option>
                                                    @foreach ($levels as $level)
                                                        <option value="{{ $level['slug'] }}"
                                                            {{ isset($_GET['level']) && $_GET['level'] == $level['slug'] ? 'selected' : '' }}>
                                                            {{ $level['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area br-8">
                            <table id="table-list" class="table dt-table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Tingkat</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @include('package.datatable.datatable_js')
        <script>
            $(document).ready(function() {
                $('#id_level').change(function() {
                    window.location.href = "basic-competency?level=" + $(this).val();
                });

                var table = $('#table-list').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "",
                    dom: "<'inv-list-top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'l<'dt-action-buttons align-self-center'B>><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f<'toolbar align-self-center'>>>>" +
                        "<'table-responsive'tr>" +
                        "<'inv-list-bottom-section d-sm-flex justify-content-sm-between text-center'<'inv-list-pages-count  mb-sm-0 mb-3'i><'inv-list-pagination'p>>",
                    buttons: [{
                        text: '<svg xmlns="http://www.w3.org/2000/svg" width="69" height="69" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            window.location = '{{ route('basic_competencies.create') }}';
                        }
                    }],
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'align-middle'
                    }, {
                        data: 'course.name',
                        name: 'course.name',
                    }, {
                        data: 'code',
                        name: 'code',
                    }, {
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'level.name',
                        name: 'level.name'
                    }, {
                        data: 'action',
                        name: 'action',
                    }, ]
                });


            });
        </script>
    @endpush
@endsection
