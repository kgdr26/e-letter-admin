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
                                                <td>{{ $value->date_start }}</td>
                                                <td>{{ $value->date_end }}</td>
                                                <td>{{ $value->ast_name }} - {{ $value->ast_no }}</td>
                                                <td>{{ $value->necessity }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-name="approve"
                                                        data-item="{{ $value->id }}">
                                                        Returned
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

    {{-- Approve Assets --}}
    <script>
        $(document).on("click", "[data-name='approve']", function(e) {
            var id = $(this).attr("data-item");
            var id_director = "{!! $idn_user->id !!}";
            var status = 5;

            var table = "trx_assets_landing";
            var whr = "id";
            var dats = {
                id_director: id_director,
                status: status
            };

            if (id === '' || id_director === '') {
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

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

@stop
