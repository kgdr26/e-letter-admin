@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Approve Dephead Cash In Advance</span>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>No CIA</th>
                                        <th>Requested</th>
                                        <th>Creat On</th>
                                        <th>Necessity</th>
                                        <th>Ammount</th>
                                        <th>Unit</th>
                                        <th>Modified</th>
                                        <th>Ammount Actual</th>
                                        <th>Selisih</th>
                                        <th>Remark</th>
                                        <th>Action</th>
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
                    "url": "{{route('looplistciadephead')}}",
                    "type": "GET",
                    "dataSrc": ""
                },
                "columns": [
                    {
                    "data": null,
                    "render": function (data, type, row, meta) {
                        // Menggunakan meta.row untuk mendapatkan nomor urut
                        return meta.row + 1;
                    }
                    },
                    { "data":"no_cia"},
                    { "data":"requested"},
                    { "data":"create_on"},
                    { "data":"necessity"},
                    { "data":"amount"},
                    { "data":"unit"},
                    { "data":"modified"},
                    { "data":"amount_actual"},
                    { "data":"selisih"},
                    { "data":"remark"},
                    { "data":"action"}
                ],
                "columnDefs": [
                    {
                        "targets": [0,7],
                        "className": "text-center"
                    },{
                        "targets": [1,4,8,9],
                        "className": "text-nowrap"
                    }
                ]
            });
        });
    </script>
    {{-- End JS Datatable --}}

    {{-- JS Approve --}}
    <script>
        $(document).on("click", "[data-name='approve']", function(e) {
            var id = $(this).attr("data-item");

            $.ajax({
                type: "POST",
                url: "{{ route('approvedepheadcia') }}",
                data: {
                    id:id
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
        });
    </script>
    {{-- End JS Approve --}}

@stop
