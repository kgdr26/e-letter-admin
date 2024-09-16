@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="card">
            <div class="card-body mt-3">
                @include('CashInAdvance.navtab')
                <div class="tab-content pt-2 mt-3">
                    <div class="tab-pane fade show active">
                        <div class="row align-items-top">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <span>Overview Cash In Advance</span>

                                            <form action="{{ route('downloadcia') }}" method="get" class="w-50">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="input-group">
                                                            <span class="input-group-text" id=""><i
                                                                    class="bi bi-calendar-week-fill"></i></span>
                                                            {{-- <input type="text" class="form-control" name="date"
                                                                data-name="date" value="{{ date('Y-m-d') }}"> --}}
                                                            <input type="text" class="form-control" name="date"
                                                                data-name="date">
                                                        </div>

                                                        <div class="col-4">
                                                            <select class="form-select" name="status">
                                                                <option value="all">All</option>
                                                                <option value="1">Draft</option>
                                                                <option value="2">Approve Dephead</option>
                                                                <option value="3">Approve Finance</option>
                                                                <option value="5">Paid</option>
                                                                <option value="6">Settlement</option>
                                                                <option value="7">Oustandaing</option>
                                                                <option value="8">Finish</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-info"
                                                                data-name="export"><i
                                                                    class="bi bi-file-earmark-spreadsheet"></i>Export</button>
                                                        </div>

                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mt-3">
                                            <table class="table" id="dataTable">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>No</th>
                                                        <th>NO. CIA</th>
                                                        <th>Requested</th>
                                                        <th>Create On</th>
                                                        <th>Necessity</th>
                                                        <th>Amount</th>
                                                        <th>Unit</th>
                                                        <th>Status</th>
                                                        <th>Modified</th>
                                                        <th>Amount Actual</th>
                                                        <th>Selisih</th>
                                                        <th>Remark</th>
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
                </div>
            </div>
        </div>
    </section>

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $(document).ajaxStart(function() {
                $(".preload-wrapper").css("display", "none");
            });
            $(document).ajaxComplete(function() {
                $(".preload-wrapper").css("display", "none");
            });
            setInterval(function() {
                $('#dataTable').DataTable().ajax.reload(function() {
                    $(".preload-wrapper").css("display", "none");
                });
            }, 1000);
        });
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                "processing": false,
                "serverSide": false,
                "ajax": {
                    "url": "{{ route('looplistcia') }}",
                    "type": "GET",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            // Menggunakan meta.row untuk mendapatkan nomor urut
                            return meta.row + 1;
                        }
                    },
                    {
                        "data": "no_cia"
                    },
                    {
                        "data": "requested"
                    },
                    {
                        "data": "create_on"
                    },
                    {
                        "data": "necessity"
                    },
                    {
                        "data": "amount"
                    },
                    {
                        "data": "unit"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "modified"
                    },
                    {
                        "data": "amount_actual"
                    },
                    {
                        "data": "selisih"
                    },
                    {
                        "data": "remark"
                    }
                ],
                "columnDefs": [{
                    "targets": [0, 7],
                    "className": "text-center"
                }, {
                    "targets": [1, 4, 8, 9],
                    "className": "text-nowrap"
                }]
            });
        });
    </script>
    {{-- End JS Datatable --}}

    {{-- <script>
        $('input[data-name="date"]').datepicker({
            format: "yyyy-mm-dd",
            viewMode: "days",
            minViewMode: "days",
            autoclose: true
        });
    </script> --}}

    <script>
        $(function() {
            $('input[data-name="date"]').daterangepicker({
                opens: 'left',
                startDate: moment().startOf('month'), // Tanggal awal bulan
                endDate: moment().endOf('month'), // Tanggal akhir bulan
                locale: {
                    format: 'YYYY-MM-DD' // Format tanggal: Tahun-Bulan-Hari
                },
                ranges: {
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>

@stop
