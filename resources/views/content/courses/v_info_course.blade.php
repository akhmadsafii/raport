@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/custom/avatar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/custom/user-profile.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/custom/search.css') }}">
        @include('package.modal.modal_css')
        @include('package.loader.loader_css')
        @include('package.bootstrap-select.bootstrap-select_css')
    @endpush
    <div class="layout-px-spacing">

        <div class="row layout-spacing">

            <!-- Content -->
            <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                <div class="user-profile layout-spacing skills">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Info</h3>
                        <div class="text-center user-info">
                            <div class="avatar avatar-xl">
                                <span class="avatar-title rounded-circle">{{ Helper::get_inital($course['name']) }}</span>
                            </div>
                            <p class="">{{ $course['name'] }}</p>
                        </div>
                        <div class="user-info-list">
                            <div class="">
                                <ul class="contacts-block list-unstyled">
                                    <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z">
                                            </path>
                                        </svg> {{ $course['group'] }}
                                    </li>
                                    <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="16 18 22 12 16 6"></polyline>
                                            <polyline points="8 6 2 12 8 18"></polyline>
                                        </svg>{{ $course['code'] }}
                                    </li>
                                    <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon>
                                            <line x1="3" y1="22" x2="21" y2="22"></line>
                                        </svg>{{ $course['slug'] }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                <div class="skills layout-spacing user-profile">
                    <div class="widget-content widget-content-area">
                        <div class="d-flex justify-content-between">
                            <h3 class="">Guru Pengampu</h3>
                            <a href="javascript:void(0)" onclick="addData()" class="mt-2 edit-profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-9 filtered-list-search mx-auto">
                                <form class="form-inline my-2 my-lg-0 justify-content-center">
                                    <div class="w-100">
                                        <input type="text" class="w-100 form-control product-search br-30"
                                            id="input-search" placeholder="Cari pengajar disini...">
                                        <button class="btn btn-primary" type="submit"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-search">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65">
                                                </line>
                                            </svg></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12">

                                <div class="searchable-container">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="searchable-items">
                                                <div class="items">
                                                    <div class="user-profile">
                                                        <img src="{{ asset('asset/img/90x90.jpg') }}" alt="avatar">
                                                    </div>
                                                    <div class="user-name">
                                                        <p class="">Alan Green</p>
                                                    </div>
                                                    <div class="user-email">
                                                        <p>alan@mail.com</p>
                                                    </div>
                                                    <div class="user-status">
                                                        <span class="badge badge-primary">Active</span>
                                                    </div>
                                                    <div class="dropdown dropup  custom-dropdown-icon">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            id="dropdownMenuLink-3" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-more-horizontal">
                                                                <circle cx="12" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="19" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="5" cy="12" r="1">
                                                                </circle>
                                                            </svg>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            aria-labelledby="dropdownMenuLink-3">
                                                            <a class="dropdown-item"
                                                                href="' . route('courses.edit', $row['slug']) . '"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <polygon points="16 3 21 8 8 21 3 21 3 16 16 3">
                                                                    </polygon>
                                                                </svg> Edit</a>
                                                            <a class="dropdown-item" onclick="' . $alert . '"
                                                                href="' . route('courses.destroy', $row['slug']) . '"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11" x2="10"
                                                                        y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14"
                                                                        y2="17"></line>
                                                                </svg> Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="items">
                                                    <div class="user-profile">
                                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                                    </div>
                                                    <div class="user-name">
                                                        <p class="">Linda Nelson</p>
                                                    </div>
                                                    <div class="user-email">
                                                        <p>Linda@mail.com</p>
                                                    </div>
                                                    <div class="user-status">
                                                        <span class="badge badge-danger">Busy</span>
                                                    </div>
                                                    <div class="action-btn">
                                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-more-horizontal">
                                                                <circle cx="12" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="19" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="5" cy="12" r="1">
                                                                </circle>
                                                            </svg></p>
                                                    </div>
                                                </div>

                                                <div class="items">
                                                    <div class="user-profile">
                                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                                    </div>
                                                    <div class="user-name">
                                                        <p class="">Lila Perry</p>
                                                    </div>
                                                    <div class="user-email">
                                                        <p>Lila@mail.com</p>
                                                    </div>
                                                    <div class="user-status">
                                                        <span class="badge badge-warning">Closed</span>
                                                    </div>
                                                    <div class="action-btn">
                                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-more-horizontal">
                                                                <circle cx="12" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="19" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="5" cy="12" r="1">
                                                                </circle>
                                                            </svg></p>
                                                    </div>
                                                </div>


                                                <div class="items">
                                                    <div class="user-profile">
                                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                                    </div>
                                                    <div class="user-name">
                                                        <p class="">Andy King</p>
                                                    </div>
                                                    <div class="user-email">
                                                        <p>Andy@mail.com</p>
                                                    </div>
                                                    <div class="user-status">
                                                        <span class="badge badge-primary">Active</span>
                                                    </div>
                                                    <div class="action-btn">
                                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-more-horizontal">
                                                                <circle cx="12" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="19" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="5" cy="12" r="1">
                                                                </circle>
                                                            </svg></p>
                                                    </div>
                                                </div>

                                                <div class="items">
                                                    <div class="user-profile">
                                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                                    </div>
                                                    <div class="user-name">
                                                        <p class="">Jesse Cory</p>
                                                    </div>
                                                    <div class="user-email">
                                                        <p>Jesse@mail.com</p>
                                                    </div>
                                                    <div class="user-status">
                                                        <span class="badge badge-danger">Busy</span>
                                                    </div>
                                                    <div class="action-btn">
                                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-more-horizontal">
                                                                <circle cx="12" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="19" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="5" cy="12" r="1">
                                                                </circle>
                                                            </svg></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('modals')
        <div id="modalAjax" class="modal animated zoomInUp custo-zoomInUp" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <form class="form-vertical" id="formSubmit">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <input type="hidden" name="id" id="id_subject_teacher">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Tahun Ajaran</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Aktif</option>
                                        <option value="2">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="control-label">Pilih Guru:</label>
                                <select class="selectpicker form-control" data-live-search="true">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label class="control-label">Pilih Kelas:</label>
                                <select class="selectpicker form-control" multiple data-live-search="true">
                                    @foreach ($classes as $class)
                                        <option data-content="<span class='badge badge-primary'>{{ $class->name }}</span>">
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer md-button">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        @include('package.bootstrap-select.bootstrap-select_js')
        <script>
            $(function() {
                $("form").submit(function() {
                    $('#btnLoader').removeClass('d-none');
                    $('#btnSubmit').addClass('d-none');
                });

                $('#input-search').on('keyup', function() {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.searchable-container .items').hide();
                    $('.searchable-container .items').filter(function() {
                        return rex.test($(this).text());
                    }).show();
                });

                $('#formSubmit').on('submit', function(e) {
                    var url = $(this).attr('action');

                    // ambil method HTTP dari form
                    var method = $(this).attr('method');

                    // ambil data form
                    var data = $(this).serialize();

                    // kirim request AJAX untuk submit form
                    $.ajax({
                        url: url,
                        method: method,
                        data: data,
                        success: function(response) {
                            // tampilkan notifikasi sukses
                            alert('Data berhasil disimpan.');

                            // tutup modal
                            $('#item-modal').modal('hide');

                            // reload halaman
                            window.location.reload();
                        },
                        error: function(xhr) {
                            // tampilkan notifikasi error
                            alert('Terjadi kesalahan saat menyimpan data.');
                        }
                    });
                });
            });

            function addData() {
                $('#formSubmit').reset();
                $('#modalTitle').html('Edit Pengampu');
                $('#modalAjax').modal('show');
            }

            function editData(id) {
                $('#modalTitle').html('Edit Pengampu');
                $('#modalAjax').modal('show');
            }
        </script>
    @endpush
@endsection
