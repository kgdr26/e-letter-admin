@extends('main')
@section('content')

    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabs Menu</h5>

                    @include('Peminjaman.navtab')
                    {{-- <ul class="nav nav-tabs">
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsdash') }}" class="nav-link">Dashboard</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetscreate') }}" class="nav-link">Create Form</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsdephed') }}" class="nav-link">DepHead Approved</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsfirst') }}" class="nav-link">HRGA Approved</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetssecond') }}" class="nav-link">Security</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsdirector') }}" class="nav-link">Returned</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsdata') }}" class="nav-link">Show Lending Asset</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dataasset') }}" class="nav-link">Data Asset</a>
                        </li>
                    </ul> --}}

                    <div class="tab-content pt-2 mt-3">
                        <div class="d-flex justify-content-end w-100">
                            <button type="button" class="btn btn-info text-white" data-name="export"><i
                                    class="bi bi-file-earmark-spreadsheet"></i> Export To Excel</button>
                        </div>

                        <div class="tab-pane fade show active">
                            <div class="table-responsive mt-3">
                                <table class="table" id="dataTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>User Create</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Assets</th>
                                            <th>Necessity</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($asset as $key => $value)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $value->usr_name }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($value->date_start)->isoFormat('DD MMMM YYYY HH:mm:ss') }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($value->date_end)->isoFormat('DD MMMM YYYY HH:mm:ss') }}
                                                </td>
                                                <td>{{ $value->ast_name }} - {{ $value->ast_no }}</td>
                                                <td>{{ $value->necessity }}</td>
                                                <td class="text-center">
                                                    @if ($value->status == 1)
                                                        <button type="button" class="btn btn-secondary btn-sm" disabled>
                                                            Create Form
                                                        </button>
                                                    @elseif($value->status == 2)
                                                        <button type="button" class="btn btn-info btn-sm" disabled>
                                                            Approve Dephed
                                                        </button>
                                                    @elseif($value->status == 3)
                                                        <button type="button" class="btn btn-success btn-sm" disabled>
                                                            Approve HRGA
                                                        </button>
                                                    @elseif($value->status == 4)
                                                        <button type="button" class="btn btn-warning btn-sm" disabled>
                                                            Validate
                                                        </button>
                                                    @elseif($value->status == 5)
                                                        <button type="button" class="btn btn-danger btn-sm" disabled>
                                                            Returned
                                                        </button>
                                                    @elseif($value->status == 6)
                                                        <button type="button" class="btn btn-danger btn-sm" disabled>
                                                            Rejected
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm" disabled>
                                                            Approved
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-name="detailtimeline" data-item="{{ $value->id }}">
                                                        Detail Timeline
                                                    </button>
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
        </div>
    </section>

    {{-- Modal Noted Cancel --}}
    <div class="modal fade" id="modal_timeline" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Timeline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade profile-overview active show mb-3" id="profile-overview" role="tabpanel">
                        <h5 class="card-title">Asset Lending Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Name Employee</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_name">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">NPK</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_npk">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Start Date</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_start">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Due Date</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_end">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Assets Name</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_assets">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Necessity</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_necee">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Status</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_status">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Remark</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_remark">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Current Time</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_currenttime">-</div>
                        </div>

                    </div>

                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="page-header">
                                <h1>Timeline</h1>
                            </div>
                            <div style="display:inline-block;width:100%;overflow-y:auto;">
                                <ul class="timeline timeline-horizontal" data-name="datatimeline">
                                </ul>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Noted Cancel --}}

    {{-- Modal Export Excel --}}
    <div class="modal fade" id="modal_export" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Export To Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Select Kategori</label>
                            <select name="" id="" class="form-select select-2" data-name="kategori">
                                <option value="">-- Select Kategori --</option>
                                <option value="1">Kendaraan</option>
                                <option value="2">Room</option>
                                <option value="1,2">All</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Start Bulan</label>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="select_bulan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_export">Export</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Export Excel --}}

    {{-- JS Show Detail Timeline --}}
    <script>
        $(document).on("click", "[data-name='detailtimeline']", function(e) {
            var id = $(this).attr("data-item");

            $.ajax({
                type: "POST",
                url: "{{ route('showdetailtimeline') }}",
                data: {
                    id: id,
                },
                cache: false,
                success: function(data) {
                    // console.log(data);

                    // console.log($.parseJSON(data.listdata.dephed_detail)[0]);

                    // console.log($.parseJSON(data.listdata.first_detail)[0]);

                    // console.log($.parseJSON(data.listdata.second_detail)[0]);

                    // console.log($.parseJSON(data.listdata.director_detail)[0]);

                    var detaildephed = data.listdata.dephed_detail;
                    var detailfirst = data.listdata.first_detail;
                    var detailsecond = data.listdata.second_detail;
                    var detaildirector = data.listdata.director_detail;

                    if (detaildirector !== null) {
                        $("[data-name='detail_remark']").text($.parseJSON(data.listdata
                            .director_detail)[1]);
                    } else if (detailsecond !== null) {
                        $("[data-name='detail_remark']").text($.parseJSON(data.listdata.second_detail)[
                            1]);
                    } else if (detailfirst !== null) {
                        $("[data-name='detail_remark']").text($.parseJSON(data.listdata.first_detail)[
                            1]);
                    } else if (detaildephed !== null) {
                        $("[data-name='detail_remark']").text($.parseJSON(data.listdata.dephed_detail)[
                            1]);
                    } else {
                        $("[data-name='detail_remark']").text('-');
                    }

                    if (data.listdata.status === 1) {
                        var detailstatus =
                            '<button type="button" class="btn btn-secondary btn-sm" disabled>Create</button>';
                        var statusname = "Create";
                    } else if (data.listdata.status === 2) {
                        var detailstatus =
                            '<button type="button" class="btn btn-info btn-sm" disabled>Approve Dephed</button>';
                        var statusname = "Approve Dephed";
                    } else if (data.listdata.status === 3) {
                        var detailstatus =
                            '<button type="button" class="btn btn-success btn-sm" disabled>Approve HRGA</button>';
                        var statusname = "Approve HRGA";
                    } else if (data.listdata.status === 4) {
                        var detailstatus =
                            '<button type="button" class="btn btn-warning btn-sm" disabled>Security Validate</button>';
                        var statusname = "Security Validate";
                    } else if (data.listdata.status === 5) {
                        var detailstatus =
                            '<button type="button" class="btn btn-danger btn-sm" disabled>Returned</button>';
                        var statusname = "Returned";
                    } else if (data.listdata.status === 6) {
                        var detailstatus =
                            '<button type="button" class="btn btn-danger btn-sm" disabled>Canceled</button>';
                        var statusname = "Canceled";
                    } else {
                        var detailstatus = '-';
                        var statusname = "-";
                    }

                    $("[data-name='detail_name']").text(data.listdata.usr_name);
                    $("[data-name='detail_npk']").text(data.listdata.npk);
                    $("[data-name='detail_start']").text(data.listdata.date_start);
                    $("[data-name='detail_end']").text(data.listdata.date_end);
                    $("[data-name='detail_assets']").text(data.listdata.ast_name + " - " + data.listdata
                        .ast_no);
                    $("[data-name='detail_necee']").text(data.listdata.necessity);
                    $("[data-name='detail_currenttime']").text("Telah di " + statusname + " oleh " +
                        data.listdata.updt_name + " - " + data.listdata.last_update);

                    $("[data-name='detail_status']").html(detailstatus);
                    // $("[data-name='datatimeline']").html(data.timeline);

                    $("#modal_timeline").modal('show');
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
    {{-- End JS Show Detail Timeline --}}

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

    {{-- JS Export Excel --}}
    <script>
        $(document).on("click", "[data-name='export']", function(e) {
            $("[data-name='kategori']").val('').trigger("change");
            $("[data-name='select_bulan']").val('');
            $("#modal_export").modal('show');
        });

        $(document).on("click", "[data-name='save_export']", function(e) {
            var kategori = $("[data-name='kategori']").val();
            var select_bulan = $("[data-name='select_bulan']").val();

            if (kategori === '' || select_bulan === '') {
                Swal.fire({
                    position: 'center',
                    title: 'Action Not Valid!',
                    icon: 'warning',
                    showConfirmButton: true,
                    // timer: 1500
                }).then((data) => {
                    // location.reload();
                })
            } else {
                var urlTemplate =
                    '{{ route('exportassetslanding', ['kategori' => 'kategoriid', 'select_bulan' => 'selectbulanid']) }}';
                var replacements = [{
                        pattern: 'selectbulanid',
                        replacement: select_bulan
                    },
                    {
                        pattern: 'kategoriid',
                        replacement: kategori
                    }
                ];
                // var url         = urlTemplate.replace('kategoriid', kategori);
                replacements.forEach(function(replacement) {
                    url = urlTemplate.replace(replacement.pattern, replacement.replacement);
                });
                window.location.href = url;

                $("#modal_export").modal('hide');
            }
        });
    </script>
    {{-- End JS Export Excel --}}

    {{-- Date Picker --}}
    <script>
        $('input[data-name="select_bulan"]').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
    </script>
    {{-- End Date Picker --}}

    {{-- Select2 --}}
    <script>
        $(".select-2").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_export")
        });
    </script>
    {{-- End Select2 --}}

@stop
