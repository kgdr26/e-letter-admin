@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Finance Cash In Advance</span>

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

    {{-- Modal Selisih --}}
    <div class="modal fade" id="modal_selisih" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Print To Casier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="">
                    <div class="card-style">
                        <h2>PT. ASTRA DAIDO STEEL INDONESIA</h2>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Type</td>
                                    <td>:</td>
                                    <td id="app_no_cia">-</td>
                                </tr>
                                <tr>
                                    <td>Date Create</td>
                                    <td>:</td>
                                    <td id="app_date_create">-</td>
                                </tr>
                                <tr>
                                    <td>Requester</td>
                                    <td>:</td>
                                    <td id="app_name_user">-</td>
                                </tr>
                                <tr>
                                    <td>Necessity</td>
                                    <td>:</td>
                                    <td id="app_necessity">-</td>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <td>:</td>
                                    <td id="app_amount">-</td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>:</td>
                                    <td id="app_unit">-</td>
                                </tr>
                                <tr>
                                    <td>Amount Actual</td>
                                    <td>:</td>
                                    <td id="app_amount_actual">-</td>
                                </tr>
                                <tr>
                                    <td>Selisih</td>
                                    <td>:</td>
                                    <td id="app_selisih">-</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <label for="" class="form-label">Methode</label>
                            <select data-name="metode" class="form-select select-2-metode-ambil">
                                <option value="">-- Select Metode --</option>
                                <option value="1">Cash</option>
                                <option value="2">Transfer</option>
                            </select>
                        </div>

                        <div id="mtf" style="display: none">
                            <div class="mb-3">
                                <label for="" class="form-label">No Rekening</label>
                                <input type="text" class="form-control" data-name="no_rek">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Bank</label>
                                <input type="text" class="form-control" data-name="bank">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">On Name</label>
                                <input type="text" class="form-control" data-name="atas_nama">
                            </div>
                        </div>

                        <table class="table table-borderless">
                            <tr>
                                <td class="text-center">Approve By Finance</td>
                                <td class="text-center">Approve By Dephead</td>
                                <td class="text-center">Requester</td>
                            </tr>
                            <tr>
                                <td class="text-center">(<span id="app_name_finance"></span>)</td>
                                <td class="text-center">(<span id="app_name_dephead"></span>)</td>
                                <td class="text-center">(<span id="app_name_userapr"></span>)</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="submit_selisih">Submit</button>
                    <input type="hidden" id="app_id_cia">
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Selisih --}}

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
                    "url": "{{ route('looplistciafinance') }}",
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
                url: "{{ route('approvefinancecia') }}",
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

    {{-- JS Selisih --}}
    <script>
        function converttorupiah(val) {
            let roundedNumber = Math.round(val * 100) / 100;
            let rupiah = roundedNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return "Rp. " + rupiah;
        }

        $(document).on("change", "[data-name='metode']", function(e) {
            var metode = $('[data-name="metode"]').val();

            if (metode == 2) {
                $('#mtf').show();
            } else {
                $('#mtf').hide();
            }
        });

        $(document).on("click", "[data-name='slisih_action']", function(e) {
            var id = $(this).attr("data-item");

            $.ajax({
                type: "POST",
                url: "{{ route('showdatainputcia') }}",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    // console.log(data);

                    $('#app_id_cia').val(data.id);
                    $('#app_no_cia').text(data.no_cia);
                    $('#app_name_dephead').text(data.name_dephead);
                    $('#app_name_finance').text(data.name_finance);
                    $('#app_name_user').text(data.name_user);
                    $('#app_name_userapr').text(data.name_user);
                    $('#app_date_create').text(data.date_create);
                    $('#app_necessity').text(data.necessity);
                    $('#app_unit').text(data.unit);
                    $('#app_amount').text(converttorupiah(data.amount));
                    $('#app_amount_actual').text(converttorupiah(data.amount_actual));
                    $('#app_selisih').text(converttorupiah(data.selisih));

                    $("[data-name='id_actual_cia']").val(data.id);
                    $('#modal_selisih').modal('show');
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

        $(document).on("click", "[data-name='submit_selisih']", function(e) {
            var id = $('#app_id_cia').val();
            var methode_selisih = $('[data-name="metode"]').val();

            if(id === '' || methode_selisih === ''){
                Swal.fire({
                    position: 'center',
                    title: 'Action Not Valid!',
                    icon: 'warning',
                    showConfirmButton: true,
                    // timer: 1500
                }).then((data) => {
                    // location.reload();
                })
            }else{
                $.ajax({
                    type: "POST",
                    url: "{{ route('submitselisih') }}",
                    data: {
                        id: id,
                        methode_selisih: methode_selisih
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
                            $('#modal_selisih').modal('hide');
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

        $(document).on("click", "[data-name='closecia']", function(e) {
            var id = $(this).attr("data-item");

            if(id === ''){
                Swal.fire({
                    position: 'center',
                    title: 'Action Not Valid!',
                    icon: 'warning',
                    showConfirmButton: true,
                    // timer: 1500
                }).then((data) => {
                    // location.reload();
                })
            }else{
                $.ajax({
                    type: "POST",
                    url: "{{ route('submitclosecia') }}",
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
                            $('#modal_selisih').modal('hide');
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
    {{-- End JS Selisih --}}

    {{-- Select2 --}}
    <script>
        $(".select-2-metode-ambil").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_selisih")
        });
    </script>
    {{-- End Select2 --}}
@stop
