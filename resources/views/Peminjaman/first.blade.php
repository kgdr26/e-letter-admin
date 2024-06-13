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
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-name="canceled" data-item="{{ $value->id }}">
                                                        Rejected
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-name="approve" data-item="{{ $value->id }}"
                                                        data-kategori="{{ $value->ast_kat }}">
                                                        Approve HRGA
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
    <div class="modal fade" id="modal_noted" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Noted</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="form-label">Note</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" data-name="text_note"></textarea>
                            <input type="hidden" data-name="id_trx_assets_landing">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_noted">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Noted Cancel --}}

    {{-- Approve Assets --}}
    <script>
        $(document).on("click", "[data-name='approve']", function(e) {
            var id = $(this).attr("data-item");
            var kategori = $(this).attr("data-kategori");
            var id_first = "{!! $idn_user->id !!}";
            var date = new Date();
            var datetime = moment(date);
            var first_detail = '["' + datetime.format('YYYY-MM-DD HH:mm:ss') + '","-"]';
            var update_by = "{!! $idn_user->id !!}";

            if (kategori === '1') {
                var status = 3;
            } else {
                var status = 5;
            }

            var table = "trx_assets_landing";
            var whr = "id";
            var dats = {
                id_first: id_first,
                first_detail: first_detail,
                status: status,
                update_by: update_by
            };

            if (id === '' || id_first === '' || first_detail === '') {
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
    {{-- End Approve Assets --}}

    {{-- Cancel Assets --}}
    <script>
        $(document).on("click", "[data-name='canceled']", function(e) {
            var id = $(this).attr("data-item");
            $("[data-name='id_trx_assets_landing']").val(id);
            $("#modal_noted").modal('show');
            var date = new Date();
            var datetime = moment(date);
            // console.log(datetime.format('YYYY-MM-DD HH:mm:ss'));
        });

        $(document).on("click", "[data-name='save_noted']", function(e) {
            var id = $("[data-name='id_trx_assets_landing']").val();
            var note = $("[data-name='text_note']").val();
            var id_first = "{!! $idn_user->id !!}";
            var date = new Date();
            var datetime = moment(date);
            var first_detail = '["' + datetime.format('YYYY-MM-DD HH:mm:ss') + '","' + note + '"]';
            var status = 6;
            var table = "trx_assets_landing";
            var whr = "id";
            var dats = {
                id_first: id_first,
                status: status
            };

            if (id === '' || id_first === '') {
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
    {{-- End Cancel Assets --}}

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

@stop
