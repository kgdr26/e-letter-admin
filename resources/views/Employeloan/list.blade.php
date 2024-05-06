@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span id="nameidentitas">Chart Employen</span>

                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-name="filter_realtime">Realtime</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#" data-name="filter_bulan">Bulan</a></li>
                                    <li><a class="dropdown-item" href="#" data-name="filter_karyawan">Karyawan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="chart"></div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Employe Loan</span>
                            <div>
                                <button type="button" class="btn btn-success" data-name="add_setting_bulan_thr">Setting
                                    Bulan THR</button>
                                <button type="button" class="btn btn-success" data-name="add">ADD Employe Loan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NAME</th>
                                        <th>NIK</th>
                                        <th>NOMINAL</th>
                                        <th class="text-center">JUMLAH CICILAN</th>
                                        <th>PEMBAYARAN PERBULAN</th>
                                        <th>START LOAN</th>
                                        <th>ENDING LOAN</th>
                                        <th class="text-center">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($arr as $key => $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $val->name }}</td>
                                            <td>{{ $val->npk }}</td>
                                            <td>{{ 'Rp ' . number_format($val->nominal_loan, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $val->bulan_loan }} Bulan</td>
                                            <td>{{ 'Rp ' . number_format($val->loan_perbulan, 0, ',', '.') }}</td>
                                            <td>{{ convertToIndonesianMonth($val->start_bulan . '-01') }}</td>
                                            <td>{{ convertToIndonesianMonth($val->ending_bulan . '-01') }}</td>
                                            <td class="text-center">
                                                <a href=""><i class="bi bi-gift-fill fs-4"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Add --}}
    <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add LOAN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Select Karyawan</label>
                            <span style="color: red;">*</span>
                            <select name="" id="" class="form-select select-2-add" data-name="id_karyawan">
                                <option value="">-- Select Karyawan --</option>
                                @foreach ($listkarayawan as $key => $val)
                                    <option value="{{ $val->id }}">{{ $val->npk }} - {{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nominal</label>
                            <span style="color: red;">*</span>
                            <input type="text" class="form-control" id="" placeholder="" data-name="nominal">
                        </div>
                        {{-- <div class="col-md-12 mb-3">
                            <label for="inputState" class="form-label">Golongan</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose Option...</option>
                                <option>3A</option>
                                <option>3A</option>
                                <option>3A</option>
                                <option>3A</option>
                                <option>3A</option>
                            </select>
                        </div> --}}

                        {{-- CHECKBOX GOLONGAN --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Golongan</label>
                            <span style="color: red;">*</span>
                            <div>
                                <div class="form-check form-check-inline ms-5 mt-2">
                                    <input class="form-check-input" type="checkbox" id="3A1" value="3A">
                                    <label class="form-check-label" for="3A1">3A</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A2" value="3A">
                                    <label class="form-check-label" for="3A2">3B</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A3" value="3A">
                                    <label class="form-check-label" for="3A3">3C</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A4" value="3A">
                                    <label class="form-check-label" for="3A4">3D</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A5" value="3A">
                                    <label class="form-check-label" for="3A5">3E</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A6" value="3A">
                                    <label class="form-check-label" for="3A6">3F</label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-inline ms-5 mt-2">
                                    <input class="form-check-input" type="checkbox" id="3A1" value="3A">
                                    <label class="form-check-label" for="3A1">4A</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A2" value="3A">
                                    <label class="form-check-label" for="3A2">4B</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A3" value="3A">
                                    <label class="form-check-label" for="3A3">4C</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A4" value="3A">
                                    <label class="form-check-label" for="3A4">4D</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A5" value="3A">
                                    <label class="form-check-label" for="3A5">4E</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A6" value="3A">
                                    <label class="form-check-label" for="3A6">4F</label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-inline ms-5 mt-2">
                                    <input class="form-check-input" type="checkbox" id="3A1" value="3A">
                                    <label class="form-check-label" for="3A1">5A</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A2" value="3A">
                                    <label class="form-check-label" for="3A2">5B</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A3" value="3A">
                                    <label class="form-check-label" for="3A3">5C</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A4" value="3A">
                                    <label class="form-check-label" for="3A4">5D</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A5" value="3A">
                                    <label class="form-check-label" for="3A5">5E</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input" type="checkbox" id="3A6" value="3A">
                                    <label class="form-check-label" for="3A6">5F</label>
                                </div>
                            </div>
                        </div>

                        {{-- END CHECKBOX GOLONGAN --}}

                        <div class="mb-3">
                            <label for="" class="form-label">Jumlah Cicilan</label>
                            <span style="color: red;">*</span>
                            <input type="number" class="form-control" id="" placeholder=""
                                data-name="bulan_loan">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Pembayaran Perbulan</label>
                            <span style="color: red;">*</span>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="pembayaran_perbulan" readonly>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="" class="form-label">Start Bulan</label>
                                <span style="color: red;">*</span>
                                <input type="text" class="form-control" id="" placeholder=""
                                    data-name="start_bulan">
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="" class="form-label">Ending Bulan</label>
                                <span style="color: red;">*</span>
                                <input type="text" class="form-control" id="" placeholder=""
                                    data-name="ending_bulan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_add">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal ADD --}}

    {{-- Open Modal View Table --}}

    {{-- End Modal View Table --}}

    {{-- Modal Add --}}
    <div class="modal fade" id="modal_filter_bulan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filter By Bulan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Bulan</label>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="select_filter_bulan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_filter_bulan">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal ADD --}}

    {{-- Modal Add --}}
    <div class="modal fade" id="modal_filter_karyawan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filter By Karyawan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Select Karyawan</label>
                            <select name="" id="" class="form-select select-2-select_filter_karyawan"
                                data-name="select_filter_karyawan">
                                <option value="">-- Select Karyawan --</option>
                                @foreach ($filterkaryawan as $key => $val)
                                    <option value="{{ $val->id_kry }},{{ $val->npk }} - {{ $val->name }}">
                                        {{ $val->npk }} - {{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_filter_karyawan">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal ADD --}}

    {{-- Modal Setting Bulan THR --}}
    <div class="modal fade" id="modal_setting_bulan_thr" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Setting Bulan THR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Tahun Dan Bulan</label>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="setting_tahun_bulan">
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable_bulanthr">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TAHUN & BULAN</th>
                                        <th>UPDATE BY</th>
                                        <th>DATETIME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($listbulanthr as $key => $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ convertToIndonesianMonth($val->tahun . '-' . $val->bulan . '-01') }}
                                            </td>
                                            <td>{{ $val->name }}</td>
                                            <td>{{ $val->last_update }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_setting_thr">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Setting Bulan THR --}}

    {{-- JS Update Chart --}}
    <script>
        $(document).ready(function() {
            setTimeout(updatechart);
        });

        function js_autogenerateloan() {
            var cek = 0;
            var data = 0;
            $.ajax({
                url: "{{ route('action_autogenerateloan') }}",
                type: "POST",
                data: {
                    cek: cek,
                    data: data
                },
                dataType: 'json',
                global: false,
                cache: false,
                success: function(data) {
                    console.log(data);
                },
                complete: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
    {{-- End JS Update Chart --}}

    {{-- Js Auto Generate Loan --}}
    <script></script>
    {{-- End Js Auto Generate Loan --}}

    {{-- Js Add  Setting Bulan THR --}}
    <script>
        $(document).on("click", "[data-name='add_setting_bulan_thr']", function(e) {
            $("[data-name='setting_tahun_bulan']").val('');
            $("#modal_setting_bulan_thr").modal('show');
        });

        $(document).on("click", "[data-name='save_setting_thr']", function(e) {
            var tahun_bulan = $("[data-name='setting_tahun_bulan']").val();
            var thn_i = tahun_bulan.split("-");
            var is_active = 1;
            var update_by = "{!! $idn_user->id !!}";
            var table = "trx_setting_bulan_thr";

            if (tahun_bulan === '') {
                Swal.fire({
                    position: 'center',
                    title: 'Form is empty!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {

                var id = thn_i[0];
                var field = 'tahun';

                $.ajax({
                    type: "POST",
                    url: "{{ route('actionshowdata') }}",
                    data: {
                        id: id,
                        table: table,
                        field: field
                    },
                    cache: false,
                    success: function(data) {
                        // console.log(data['data']);

                        if (data['data'] == null) {
                            // alert('Data Tidak Ada');

                            var is_active = 1;
                            var update_by = "{!! $idn_user->id !!}";

                            var data = {
                                tahun: thn_i[0],
                                bulan: thn_i[1],
                                is_active: is_active,
                                update_by: update_by,
                            };

                            $.ajax({
                                type: "POST",
                                url: "{{ route('actionadd') }}",
                                data: {
                                    table: table,
                                    data: data
                                },
                                cache: false,
                                success: function(data) {
                                    // console.log(data);
                                    $("#modal_setting_bulan_thr").modal('hide');
                                    js_autogenerateloan();
                                    Swal.fire({
                                        position: 'center',
                                        title: 'Success!',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((data) => {
                                        location.reload();
                                    })
                                },
                                error: function(data) {
                                    Swal.fire({
                                        position: 'center',
                                        title: 'Action Not Valid!',
                                        icon: 'warning',
                                        showConfirmButton: true,
                                        // timer: 1500
                                    }).then((data) => {
                                        // location.reload();
                                    })
                                }
                            });


                        } else {
                            // alert('Data Ada');
                            var whr = "id";
                            var id = data['data'].id;
                            var dats = {
                                bulan: thn_i[1],
                                update_by: update_by
                            };

                            $.ajax({
                                type: "POST",
                                url: "{{ route('actionedit') }}",
                                data: {
                                    id: id,
                                    whr: whr,
                                    table: table,
                                    dats: dats
                                },
                                cache: false,
                                success: function(data) {
                                    // console.log(data);
                                    $("#modal_setting_bulan_thr").modal('hide');
                                    js_autogenerateloan();
                                    Swal.fire({
                                        position: 'center',
                                        title: 'Success!',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((data) => {
                                        location.reload();
                                    })
                                },
                                error: function(data) {
                                    Swal.fire({
                                        position: 'center',
                                        title: 'Action Not Valid!',
                                        icon: 'warning',
                                        showConfirmButton: true,
                                        // timer: 1500
                                    }).then((data) => {
                                        // location.reload();
                                    })
                                }
                            });

                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            position: 'center',
                            title: 'Action Not Valid!',
                            icon: 'warning',
                            showConfirmButton: true,
                            // timer: 1500
                        }).then((data) => {
                            // location.reload();
                        })
                    }
                });

            }

        });
    </script>
    {{-- Js Add  Setting Bulan THR --}}

    {{-- Js Add --}}
    <script>
        $(document).on("click", "[data-name='add']", function(e) {
            $("[data-name='nominal']").val('');
            $("[data-name='bulan_loan']").val('');
            $("[data-name='show_pembayaran_perbulan']").val('');
            $("[data-name='pembayaran_perbulan']").val('');
            $("[data-name='id_karyawan']").val('').trigger("change");
            $("#modal_add").modal('show');
        });

        $(document).on("click", "[data-name='save_add']", function(e) {
            var id_karyawan = $("[data-name='id_karyawan']").val();
            var nominal = $("[data-name='nominal']").val();
            var nominal_loan = nominal.replace(/[^\d]/g, '');
            var bulan_loan = $("[data-name='bulan_loan']").val();
            var pembayaran_perbulan = $("[data-name='pembayaran_perbulan']").val();
            var loan_perbulan = pembayaran_perbulan.replace(/[^\d]/g, '');
            var start_bulan = $("[data-name='start_bulan']").val();
            var ending_bulan = $("[data-name='ending_bulan']").val();
            var list_pembayaran = '[]';
            var is_active = 1;
            var update_by = "{!! $idn_user->id !!}";
            var table = "trx_employe_loan";

            var data = {
                id_karyawan: id_karyawan,
                nominal_loan: nominal_loan,
                bulan_loan: bulan_loan,
                loan_perbulan: loan_perbulan,
                start_bulan: start_bulan,
                ending_bulan: ending_bulan,
                list_pembayaran: list_pembayaran,
                is_active: is_active,
                update_by: update_by,
            };

            if (id_karyawan === '' || nominal_loan === '' || bulan_loan === '' || loan_perbulan === '' ||
                start_bulan === '' || ending_bulan === '' || list_pembayaran === '') {
                Swal.fire({
                    position: 'center',
                    title: 'Form is empty!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('actionadd') }}",
                    data: {
                        table: table,
                        data: data
                    },
                    cache: false,
                    success: function(data) {
                        // console.log(data);
                        $("#modal_add").modal('hide');
                        js_autogenerateloan();
                        Swal.fire({
                            position: 'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            location.reload();
                        })
                    },
                    error: function(data) {
                        Swal.fire({
                            position: 'center',
                            title: 'Action Not Valid!',
                            icon: 'warning',
                            showConfirmButton: true,
                            // timer: 1500
                        }).then((data) => {
                            // location.reload();
                        })
                    }
                });
            }

        });
    </script>
    {{-- End JS Data --}}

    {{-- JS Filter --}}
    <script>
        $(document).on("click", "[data-name='filter_realtime']", function(e) {
            var bulan = 0;
            var type = 0;
            var idkry = 0;
            updatechart(type, bulan, idkry);
            $("#nameidentitas").text("Chart Employen Realtime");
        });

        $(document).on("click", "[data-name='filter_bulan']", function(e) {
            $("[data-name='select_filter_bulan']").val('');
            $("#modal_filter_bulan").modal('show');
        });

        $(document).on("click", "[data-name='save_filter_bulan']", function(e) {
            var bulan = $("[data-name='select_filter_bulan']").val();
            var type = "bulan";
            var idkry = 0;
            updatechart(type, bulan, idkry);
            $("#modal_filter_bulan").modal('hide');
            $("#nameidentitas").text("Chart Employen Bulan " + bulan);
            // alert(bulan);
        });

        $(document).on("click", "[data-name='filter_karyawan']", function(e) {
            $("[data-name='select_filter_karyawan']").val('').trigger("change");
            $("#modal_filter_karyawan").modal('show');
        });

        $(document).on("click", "[data-name='save_filter_karyawan']", function(e) {
            var bulan = 0;
            var type = "karyawan";
            var krywse = $("[data-name='select_filter_karyawan']").val();
            var slykry = krywse.split(",");
            var idkry = slykry[0];
            updatechart(type, bulan, idkry);
            $("#modal_filter_karyawan").modal('hide');
            $("#nameidentitas").text("Chart Employen " + slykry[1]);

            // alert(bulan);
        });
    </script>
    {{-- End JS Filter --}}

    {{-- Chart Employen --}}
    <script>
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },

            title: {
                text: '',
            },
            subtitle: {
                text: ''
            },
            credits: {
                enabled: false
            },

            xAxis: {
                categories: []
            },

            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: ''
                }
            },

            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>Rp. {point.y}</b><br/>',
                shared: true
            },

            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },

            series: [{
                name: 'Dibayar',
                data: [],
                stack: 'Employen'
            }, {
                name: 'Terbayarkan',
                data: [],
                stack: 'Employen'
            }, {
                name: 'Sisa',
                data: [],
                stack: 'Employen'
            }]
        });

        var timeouts = {};

        function updatechart(type, bulan, idkry) {
            var type = type;
            var bulan = bulan;
            var idkry = idkry;
            var chart = $('#chart').highcharts();
            $.ajax({
                url: "{{ route('dataemploye') }}",
                type: "POST",
                data: {
                    type: type,
                    bulan: bulan,
                    idkry: idkry
                },
                dataType: 'json',
                global: false,
                cache: false,
                success: function(data) {
                    console.log(data);
                    chart.xAxis[0].update({
                        categories: data.categories
                    });
                    chart.series[0].setData(data.dibayar);
                    chart.series[1].setData(data.terbayarkan);
                    chart.series[2].setData(data.sisa);

                    // Check if start and end are undefined
                    if (type === undefined) {
                        // If timeout for this id already exists, clear it
                        if (timeouts['chart']) {
                            clearTimeout(timeouts['chart']);
                        }
                        // Set a new timeout for this id
                        timeouts['chart'] = setTimeout(function() {
                            updatechart();
                        }, 1000); // call updateChart every 3 seconds
                    }
                },
                complete: function(data) {
                    if (type !== undefined) {
                        clearTimeout(timeouts['chart']);
                    }
                }
            });
        }
    </script>
    {{-- Chart Employen --}}

    {{-- JS Konvert To rupiah --}}
    <script>
        $(document).ready(function() {
            $("[data-name='nominal']").keyup(function(event) {
                // Mendapatkan nilai yang dimasukkan oleh pengguna
                var inputVal = $(this).val();

                // Menghilangkan semua karakter selain angka
                inputVal = inputVal.replace(/[^\d]/g, '');

                // Mengonversi ke format Rupiah
                var formattedVal = formatRupiah(inputVal);

                // Menetapkan nilai yang telah diubah kembali ke input
                $(this).val(formattedVal);
            });

            // Fungsi untuk mengonversi ke format Rupiah
            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return 'Rp ' + ribuan;
            }
        });

        $("[data-name='bulan_loan']").keyup(function(event) {
            // Mendapatkan nilai yang dimasukkan oleh pengguna
            var inputVal = $("[data-name='nominal']").val();
            var bulanloan = $(this).val();

            // Menghapus simbol 'Rp' dan titik dari nilai
            inputVal = inputVal.replace(/[^\d]/g, '');

            // Mengonversi nilai string menjadi integer
            var intValue = parseInt(inputVal);

            // Pembagian

            var pembagian = Math.round(intValue / bulanloan);
            var reverse = pembagian.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');

            // Menetapkan nilai integer ke dalam input tersembunyi
            $("[data-name='pembayaran_perbulan'").val('Rp ' + ribuan);
        });
    </script>
    {{-- End JS Konvert To Rupiah --}}

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(document).ready(function() {
            $('#dataTable_bulanthr').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

    {{-- Select2 --}}
    <script>
        $(".select-2-add").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_add")
        });

        $(".select-2-edit").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_edit")
        });

        $(".select-2-select_filter_karyawan").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_filter_karyawan")
        });
    </script>
    {{-- End Select2 --}}

    <script>
        $('input[data-name="start_bulan"]').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });

        $('input[data-name="ending_bulan"]').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });

        $('input[data-name="select_filter_bulan"]').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });

        $('input[data-name="setting_tahun_bulan"]').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });

        $('input[data-name="setting_bulan_thr"]').datepicker({
            format: "mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });

        $('input[data-name="setting_thn_thr"]').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });
    </script>

@stop
