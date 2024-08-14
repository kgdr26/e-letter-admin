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
                                            <span>Dephead Cash In Advance</span>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mt-3">
                                            <table class="table" id="dataTable">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>No</th>
                                                        <th>Type</th>
                                                        <th>Requested</th>
                                                        <th>Create On</th>
                                                        <th>Necessity</th>
                                                        <th>Amount</th>
                                                        <th>Unit</th>
                                                        <th>Modified</th>
                                                        <th>Amount Actual</th>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal rEJECT --}}
    <div class="modal fade" id="modal_remark" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Remark</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datashowchasier">
                    <div class="card-style">
                        <label for="" class="label">Remark</label>
                        <textarea name="" id="" cols="30" rows="10" class="form-control" data-name="remark"></textarea>
                        <input type="hidden" data-name="id_reject">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_reject">Save Reject</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Show rEJECT --}}

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
                    "url": "{{ route('looplistciadephead') }}",
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
                    },
                    {
                        "data": "action"
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

    {{-- JS Approve --}}
    <script>
        $(document).on("click", "[data-name='approve']", function(e) {
            var id = $(this).attr("data-item");

            $.ajax({
                type: "POST",
                url: "{{ route('approvedepheadcia') }}",
                data: {
                    id: id
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

    {{-- JS Reject --}}
    <script>
        $(document).on("click", "[data-name='reject']", function(e) {
            var id = $(this).attr("data-item");
            var remark = $(this).attr("data-note");

            $("[data-name='id_reject']").val(id);
            $("[data-name='remark']").val(remark);

            $('#modal_remark').modal('show');
        });

        $(document).on("click", "[data-name='save_reject']", function(e) {
            var id = $("[data-name='id_reject']").val();
            var remark = $("[data-name='remark']").val();

            if (id === '') {
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
                $.ajax({
                    type: "POST",
                    url: "{{ route('rejectcia') }}",
                    data: {
                        id: id,
                        remark: remark
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
                            $('#modal_remark').modal('hide');
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
    {{-- End JS Reject --}}

@stop
