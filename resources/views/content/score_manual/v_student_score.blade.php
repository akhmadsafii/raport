@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.loader.loader_css')
        @include('package.fonts.fontawesome_css')
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
                            <h4>{{ session('title') }}</h4>
                        </div>
                        <form action="{{ route('manuals.scores.storeOrUpdate') }}" method="post">
                            @csrf
                            <div class="widget-content widget-content-area br-8">
                                <div class="table-responsive">

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="align-middle">Siswa</th>
                                                <th colspan="4" class="align-middle text-center">Nilai</th>
                                                <th rowspan="2" class="align-middle">Nilai Akhir</th>
                                                <th rowspan="2" class="align-middle">Predikat</th>
                                                <th rowspan="2" class="align-middle">Deskripsi</th>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">Tugas</th>
                                                <th class="align-middle">Ulangan Harian</th>
                                                <th class="align-middle">Ulangan Tengah Semester</th>
                                                <th class="align-middle">Ulangan Akhir Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $student)
                                                <tr>
                                                    <td>{{ $student['name'] }}</td>
                                                    <input type="hidden" name="id_student_class[]"
                                                        value="{{ $student['id_student_class'] }}">
                                                    <td><input type="text" class="form-control" name="assigment_grade[]"
                                                            value="{{ $student['assigment_grade'] != null ? $student['assigment_grade'] : '0' }}" {{ $student['status_form'] == false ? 'readonly' : '' }}>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="daily_test_score[]"
                                                            value="{{ $student['daily_test_score'] != null ? $student['daily_test_score'] : '0' }}" {{ $student['status_form'] == false ? 'readonly' : '' }}>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="score_uts[]"
                                                            value="{{ $student['score_uts'] != null ? $student['score_uts'] : '0' }}" {{ $student['status_form'] == false ? 'readonly' : '' }}>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="score_uas[]"
                                                            value="{{ $student['score_uas'] != null ? $student['score_uas'] : '0' }}" {{ $student['status_form'] == false ? 'readonly' : '' }}>
                                                    </td>
                                                    <td>{{ $student['score_final'] }}</td>
                                                    <td>{{ $student['predicate'] }}</td>
                                                    <td>
                                                        <input type="hidden" name="score_final[]" value="{{ $student['score_final'] }}">
                                                        <input type="hidden" name="predicate[]" value="{{ $student['predicate'] }}">
                                                        <textarea class="form-control" rows="1" name="description[]" {{ $student['status_form'] == false ? 'readonly' : '' }}>{{ $student['description'] }}</textarea>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>



                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="account-settings-footer">

            <div class="as-footer-container">

                <button id="multiple-reset" class="btn btn-warning">Reset All</button>
                <div class="blockui-growl-message">
                    <i class="flaticon-double-check"></i>&nbsp; Settings Saved Successfully
                </div>
                <button class="btn btn-primary d-none" id="btnLoader">
                    <div class="spinner-grow text-white mr-2 align-self-center loader-sm">
                        Loading...</div>
                    Loading
                </button>
                <button class="btn btn-primary" id="btnSubmit" onclick="submitForm()">Simpan
                    Data</button>

            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                // saat nilai diinputkan
                $("input[name='assigment_grade[]'], input[name='daily_test_score[]'], input[name='score_uts[]'], input[name='score_uas[]']")
                    .keyup(function() {
                        // ambil nilai-nilai yang dibutuhkan
                        var assigment_grade = parseFloat($(this).closest("tr").find(
                            "input[name='assigment_grade[]']").val()) || 0;
                        var daily_test_score = parseFloat($(this).closest("tr").find(
                            "input[name='daily_test_score[]']").val()) || 0;
                        var score_uts = parseFloat($(this).closest("tr").find("input[name='score_uts[]']").val()) ||
                            0;
                        var score_uas = parseFloat($(this).closest("tr").find("input[name='score_uas[]']").val()) ||
                            0;

                        // hitung nilai akhir
                        var final_score = ((assigment_grade * 0.2) + (daily_test_score * 0.2) + (score_uts * 0.3) +
                            (score_uas * 0.3)).toFixed(2);

                        // tampilkan nilai akhir
                        $(this).closest("tr").find("td:eq(5)").text(final_score);
                        $(this).closest("tr").find("input[name='score_final[]']").val(final_score);

                        // hitung predikat
                        var predikat;
                        if (final_score >= 90) {
                            predikat = "A";
                        } else if (final_score >= 80) {
                            predikat = "B";
                        } else if (final_score >= 70) {
                            predikat = "C";
                        } else if (final_score >= 60) {
                            predikat = "D";
                        } else {
                            predikat = "E";
                        }

                        // tampilkan predikat
                        $(this).closest("tr").find("td:eq(6)").text(predikat);
                        $(this).closest("tr").find("input[name='predicate[]']").val(predikat);
                    });

                $("form").submit(function() {
                    $('#btnLoader').removeClass('d-none');
                    $('#btnSubmit').addClass('d-none');
                });
            });




            function submitForm() {
                $('form').submit();
            }
        </script>
    @endpush
@endsection
