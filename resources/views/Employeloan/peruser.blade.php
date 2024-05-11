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
                                        <th class="text-center">TAHUN BULAN</th>
                                        <th>NOMINAL PEMBAYARAN</th>
                                        <th>NOMINAL TERBAYARKAN</th>
                                        <th>NOMINAL SISA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($arr as $key => $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ convertToIndonesianMonth($val->bulan.'-01') }}</td>
                                            <td>{{ 'Rp ' . number_format($val->nominal, 0, ',', '.') }}</td>
                                            <td>{{ 'Rp ' . number_format($val->terbayarkan, 0, ',', '.') }}</td>
                                            <td>{{ 'Rp ' . number_format($val->sisa, 0, ',', '.') }}</td>
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

    {{-- JS Update Chart --}}
    <script>
        $(document).ready(function() {
            setTimeout(updatechart('karyawan','0',"{!! $idkaryawan !!}"));
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
