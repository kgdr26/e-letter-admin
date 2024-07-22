@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>List Cashier Cash In Advance</span>

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
                                        <th>Status</th>
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

    {{-- Modal Print To Casier --}}
    <div class="modal fade" id="modal_to_casier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak To Casier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datashowchasier">
                    <div class="card-style">
                        <h2>PT. ASTRA DAIDO STEEL INDONESIA</h2>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>NO CIA</td>
                                    <td>:</td>
                                    <td id="no_cia">-</td>
                                </tr>
                                <tr>
                                    <td>Date Create</td>
                                    <td>:</td>
                                    <td id="date_create">-</td>
                                </tr>
                                <tr>
                                    <td>Requester</td>
                                    <td>:</td>
                                    <td id="name_user">-</td>
                                </tr>
                                <tr>
                                    <td>Necessity</td>
                                    <td>:</td>
                                    <td id="necessity">-</td>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <td>:</td>
                                    <td id="amount">-</td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>:</td>
                                    <td id="unit">-</td>
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

                        <input type="hidden" data-name="id_cia">

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
                                <label for="" class="form-label">Atas Nama</label>
                                <input type="text" class="form-control" data-name="atas_nama">
                            </div>
                        </div>

                        <table class="table table-borderless">
                            <tr>
                                <td class="text-center">Approve By Finance</td>
                                <td class="text-center">Approve By Dephead</td>
                                <td class="text-center">Recivied</td>
                            </tr>
                            <tr>
                                <td class="text-center">(<span id="name_finance"></span>)</td>
                                <td class="text-center">(<span id="name_dephead"></span>)</td>
                                <td class="text-center">(<span id="name_userapr"></span>)</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="submit_ambil">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Print To Casier --}}

    {{-- Modal Setlement --}}
    <div class="modal fade" id="modal_setlement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Settelment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datashowchasier">
                    <div class="card-style">
                        <h2>PT. ASTRA DAIDO STEEL INDONESIA</h2>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>NO CIA</td>
                                    <td>:</td>
                                    <td id="app_no_cia">-</td>
                                    <td class="text-midle text-center" rowspan="6">
                                        <img src="" style="width: 10rem" id="imgae_status">
                                    </td>
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
                                    <td>Norek</td>
                                    <td>:</td>
                                    <td id="">-</td>
                                </tr>

                                <tr>
                                    <td>Bank</td>
                                    <td>:</td>
                                    <td id="">-</td>
                                </tr>

                                <tr>
                                    <td>Atas Nama</td>
                                    <td>:</td>
                                    <td id="">-</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-center">Approve By Finance</td>
                                <td class="text-center">Approve By Dephead</td>
                                <td class="text-center">Recivied</td>
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
                    <button type="button" class="btn btn-primary" data-name="download_to_casier"><i class="bi bi-cloud-arrow-down-fill"></i> Doownload</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Setlement --}}

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
                    "url": "{{route('looplistciacashier')}}",
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
                    { "data":"status"},
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
        function converttorupiah(val){
            let roundedNumber = Math.round(val * 100) / 100;
            let rupiah = roundedNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return "Rp. " + rupiah;
        }

        $(document).on("click", "[data-name='approve']", function(e) {
            var id = $(this).attr("data-item");

            $.ajax({
                type: "POST",
                url: "{{ route('showdatainputcia') }}",
                data: {
                    id:id
                },
                cache: false,
                success: function(data) {
                    // console.log(data);

                    $('#no_cia').text(data.no_cia);
                    $('#name_dephead').text(data.name_dephead);
                    $('#name_finance').text(data.name_finance);
                    $('#name_user').text(data.name_user);
                    $('#name_userapr').text(data.name_user);
                    $('#date_create').text(data.date_create);
                    $('#necessity').text(data.necessity);
                    $('#unit').text(data.unit);
                    $('#amount').text(converttorupiah(data.amount));

                    $("[data-name='metode']").val('').trigger("change");
                    $("[data-name='no_rek']").val('');
                    $("[data-name='bank']").val('');
                    $("[data-name='atas_nama']").val('');
                    $('[data-name="id_cia"]').val(data.id);

                    $('#modal_to_casier').modal('show');
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

        $(document).on("change", "[data-name='metode']", function (e) {
            var metode = $('[data-name="metode"]').val();

            if(metode == 2){
                $('#mtf').show();
            }else{
                $('#mtf').hide();
            }
        });

        $(document).on("click", "[data-name='submit_ambil']", function(e) {
            var metode = $('[data-name="metode"]').val();
            var no_rek = $('[data-name="no_rek"]').val();
            var bank = $('[data-name="bank"]').val();
            var atas_nama = $('[data-name="atas_nama"]').val();
            var id_cia  = $('[data-name="id_cia"]').val();

            if(metode === '' || id_cia === ''){
                Swal.fire({
                    position: 'center',
                    title: 'Form is empty!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                })
            }else{
                if(metode === '1'){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('submitciaambilchasir') }}",
                        data: {
                            id_cia:id_cia,
                            metode:metode,
                            no_rek:no_rek,
                            bank:bank,
                            atas_nama:atas_nama
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
                                $('#modal_to_casier').modal('hide');
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
                }else{
                    if(no_rek === '' || bank === '' || atas_nama === ''){
                        Swal.fire({
                            position: 'center',
                            title: 'Form is empty!',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }else{
                        $.ajax({
                            type: "POST",
                            url: "{{ route('submitciaambilchasir') }}",
                            data: {
                                id_cia:id_cia,
                                metode:metode,
                                no_rek:no_rek,
                                bank:bank,
                                atas_nama:atas_nama
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
                                    $('#modal_to_casier').modal('hide');
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
                }
            }

        });

        $(document).on("click", "[data-name='settlement']", function(e) {
            var id = $(this).attr("data-item");

            $.ajax({
                type: "POST",
                url: "{{ route('showdatainputcia') }}",
                data: {
                    id:id
                },
                cache: false,
                success: function(data) {
                    console.log(data);

                    $('#app_no_cia').text(data.no_cia);
                    $('#app_name_dephead').text(data.name_dephead);
                    $('#app_name_finance').text(data.name_finance);
                    $('#app_name_user').text(data.name_user);
                    $('#app_name_userapr').text(data.name_user);
                    $('#app_date_create').text(data.date_create);
                    $('#app_necessity').text(data.necessity);
                    $('#app_unit').text(data.unit);
                    $('#app_amount').text(converttorupiah(data.amount));

                    if(data.status === 4){
                        var show_foto = "{{ asset('assets/img/draft.png') }}";
                    }else{
                        if(data.metode === 1){
                            var show_foto = "{{ asset('assets/img/cash.png') }}";
                        }else{
                            var show_foto = "{{ asset('assets/img/transfer.png') }}";
                        }
                    }

                    $('#imgae_status').attr('src', show_foto);
                    $('#modal_setlement').modal('show');
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

    {{-- Select2 --}}
    <script>
        $(".select-2-metode-ambil").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_to_casier")
        });
    </script>
    {{-- End Select2 --}}

@stop
