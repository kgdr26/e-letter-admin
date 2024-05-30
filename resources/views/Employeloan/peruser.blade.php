@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span id="nameidentitas">Chart Employen {{$namekaryawan}}</span>
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NOMINAL</th>
                                        <th>JUMLAH CICILAN</th>
                                        <th>PEMBAYARAN PERBULAN</th>
                                        <th>START LOAN</th>
                                        <th>STATUS LOAN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $databulan      = new DateTime();
                                        $datatanggal    = $databulan->format('Y-m-d');
                                        $pengecualian   = $databulan->format('Y-m-27');
                                        if($datatanggal >= $pengecualian){
                                            $bln    = $databulan->format('Y-m');
                                        }else{
                                            $databulan->modify('-1 month');
                                            $bln    = $databulan->format('Y-m');
                                        }
                                        $no = 1;
                                    @endphp
                                    {{-- @foreach ($arr as $key => $val)
                                        @if($val->bulan <= $bln)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ convertToIndonesianMonth($val->bulan.'-01') }}</td>
                                                <td>{{ 'Rp ' . number_format($val->nominal, 0, ',', '.') }}</td>
                                                <td>{{ 'Rp ' . number_format($val->terbayarkan, 0, ',', '.') }}</td>
                                                <td>{{ 'Rp ' . number_format($val->sisa, 0, ',', '.') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach --}}
                                    @foreach ($arr as $key => $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ 'Rp ' . number_format($val->nominal_loan, 0, ',', '.') }}</td>
                                            <td>{{$val->bulan_loan}} Bulan</td>
                                            <td>{{ 'Rp ' . number_format($val->loan_perbulan, 0, ',', '.') }}</td>
                                            <td>{{ convertToIndonesianMonth($val->start_bulan.'-01') }}</td>
                                            <td>
                                                @if($val->is_active == 1)
                                                    <span class="badge bg-primary">Masih Berjalan</span>
                                                @elseif($val->is_active == 2)
                                                    <span class="badge bg-success">Lunas</span>
                                                @elseif($val->is_active == 0)
                                                    <span class="badge bg-danger">Delete</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-name="show_list_table" data-item="{{$val->id}}"><i class="bi bi-gift-fill "></i></button>
                                                <button type="button" class="btn btn-success" data-name="show_chart" data-item="{{$val->id}}"><i class="bi bi-bar-chart-line "></i></button>
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

    {{-- Modal Show List Data Karyawan --}}
    <div class="modal fade" id="modal_show_list_table_karyawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">List Table Loan Per Karyawan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <input type="hidden" data-name="id_kar" value="1">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="" class="form-label">NAME</label>
                                <input type="text" class="form-control" id="" placeholder="" data-name="name_list_loan" disabled>
                            </div>
        
                            <div class="col-6 mb-3">
                                <label for="" class="form-label">NPK</label>
                                <input type="text" class="form-control" id="" placeholder="" data-name="npk_list_loan" disabled>
                            </div>
        
                            <div class="col-6 mb-3">
                                <label for="" class="form-label">NOMINAL LOAN</label>
                                <input type="text" class="form-control" id="" placeholder="" data-name="nominal_list_loan" disabled>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="" class="form-label">GOLONGAN</label>
                                <input type="text" class="form-control" id="" placeholder="" data-name="golongan_list_loan" disabled>
                            </div>
        
                            <div class="col-6">
                                <label for="" class="form-label">START LOAN</label>
                                <input type="text" class="form-control" id="" placeholder="" data-name="start_list_loan" disabled>
                            </div>
        
                            <div class="col-6">
                                <label for="" class="form-label">END LOAN</label>
                                <input type="text" class="form-control" id="" placeholder="" data-name="end_list_loan" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table" id="dataTableshow" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">TAHUN BULAN</th>
                                    <th>NOMINAL PEMBAYARAN</th>
                                    <th>NOMINAL TERBAYARKAN</th>
                                    <th>NOMINAL SISA</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Show List Data Karyawan --}}

    {{-- JS Update Chart --}}
    <script>
        $(document).ready(function() {
            var id = "{!! $idadaloan !!}";
            setTimeout(updatechart(id));
        });
    </script>
    {{-- End JS Update Chart --}}

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
        function updatechart(id) {
            var id = id;
            var chart = $('#chart').highcharts();
            $.ajax({
                url: "{{ route('dataemployeperuser') }}",
                type: "POST",
                data: {
                    id: id,
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

        $(document).on("click", "[data-name='show_chart']", function(e) {
            var id = $(this).attr("data-item");
            updatechart(id)
        });
    </script>
    {{-- Chart Employen --}}

    {{-- JS Show Table --}}
    <script>
        $(document).ready(function() {
            var table = $('#dataTableshow').DataTable({
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "{{route('listtableloanperuser')}}",
                    "type": "POST",
                    "dataSrc": "",
                    "data": function (d) {
                        // Ubah sumber data yang diterima dari server sesuai kebutuhan
                        d.id = $("[data-name='id_kar']").val();
                        // alert(d.id_machine);
                        return d;
                    }
                },
                "columns": [
                    { "data": "no" },
                    { "data": "thnbulan" },
                    { "data": "nominalloan" },
                    { "data": "nominalterbayarkan" },
                    { "data": "nominalsisa" }
                ]
            });

            // $(document).on("click", "[data-name='show_list_table']", function(e) {
            $("[data-name='show_list_table']").click(function() {
                var id = $(this).attr("data-item");
                $("[data-name='id_kar']").val(id);

                $.ajax({
                    type: "POST",
                    url: "{{ route('showlistdataloanperuser') }}",
                    data: {
                        id: id,
                    },
                    cache: false,
                    success: function(data) {
                        // console.log(data);

                        $("[data-name='name_list_loan']").val(data['name_list_loan']);
                        $("[data-name='npk_list_loan']").val(data['npk_list_loan']);
                        $("[data-name='nominal_list_loan']").val(data['nominal_list_loan']);
                        $("[data-name='golongan_list_loan']").val(data['golongan_list_loan']);
                        $("[data-name='start_list_loan']").val(data['start_list_loan']);
                        $("[data-name='end_list_loan']").val(data['end_list_loan']);
                        // $("#html_table").html(data['dt_html']);
                        table.ajax.reload(null, false);
                        $("#modal_show_list_table_karyawan").modal('show');
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
                
            });
        });

        $(document).on("click", "[data-name='show_list_table']", function(e) {
            // table.ajax.reload(null, false);
            table.ajax.reload(null, false);
            var id = $(this).attr("data-item");
            $("[data-name='id_kar']").val(id);

            $.ajax({
                type: "POST",
                url: "{{ route('showlistdataloanperuser') }}",
                data: {
                    id: id,
                },
                cache: false,
                success: function(data) {
                    // console.log(data);

                    $("[data-name='name_list_loan']").val(data['name_list_loan']);
                    $("[data-name='npk_list_loan']").val(data['npk_list_loan']);
                    $("[data-name='nominal_list_loan']").val(data['nominal_list_loan']);
                    $("[data-name='golongan_list_loan']").val(data['golongan_list_loan']);
                    $("[data-name='start_list_loan']").val(data['start_list_loan']);
                    $("[data-name='end_list_loan']").val(data['end_list_loan']);
                    // $("#html_table").html(data['dt_html']);

                    $("#modal_show_list_table_karyawan").modal('show');
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
            
        });
    </script>
    {{-- End Js Show Table --}}

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
