@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row d-flex align-items-stretch">
            <div class="col-3">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Input Cash In Advance</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Date</label>
                            <div class="input-group">
                                <span class="input-group-text" id=""><i class="bi bi-calendar-week-fill"></i></span>
                                <input type="text" class="form-control" data-name="date_create" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Requester</label>
                            <input type="text" class="form-control" data-name="" value="{{$idn_user->npk}} - {{$idn_user->name}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Necessity</label>
                            <textarea class="form-control" data-name="necessity"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Amount</label>
                            <input type="text" class="form-control" data-name="amount">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Unit</label>
                            <input type="text" class="form-control" data-name="unit">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary me-3" data-name="save_data">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>List Cash In Advance</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>No CIA</th>
                                        <th>Creat On</th>
                                        <th>Necessity</th>
                                        <th>Ammount</th>
                                        <th>Unit</th>
                                        <th>Status</th>
                                        <th>Modified</th>
                                        <th>Ammount Actual</th>
                                        <th>Selisih</th>
                                        <th>Remark</th>
                                        <th class="text-center">Action</th>
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
                                    <td class="text-midle text-center" rowspan="6">
                                        <img src="" style="width: 10rem" id="img_status">
                                    </td>
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
                    <button type="button" class="btn btn-primary" data-name="download_to_casier"><i class="bi bi-cloud-arrow-down-fill"></i> Doownload</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Print To Casier --}}

    {{-- Modal App Chasier --}}
    <div class="modal fade" id="modal_show_app_chasier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    {{-- End Modal Show App Chasier --}}

    {{-- Modal App Chasier --}}
    <div class="modal fade" id="show_cek_cia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pending Oustandaing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datashowchasier">
                    <div class="card-style">
                        <table class="table" id="listcekcia">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>No CIA</th>
                                    <th>Creat On</th>
                                    <th>Necessity</th>
                                    <th>Ammount</th>
                                    <th>Unit</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="showlistcia">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="next_urgent">Next Urgent</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Show App Chasier --}}

    {{-- Modal App Chasier --}}
    <div class="modal fade" id="modal_remark" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Next Urgent</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datashowchasier">
                    <div class="card-style">
                       <label for="" class="label">Remark</label>
                       <textarea name="" id="" cols="30" rows="10" class="form-control" data-name="remark"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_remark">Save Remark</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Show App Chasier --}}

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
                    "url": "{{route('listinputcia')}}",
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
                        "targets": [0,6,11],
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

    {{-- JS Create Data --}}
    <script>
        $("[data-name='amount']").on('keyup', function() {
            var inputVal = $(this).val();
            var numberString = inputVal.replace(/[^,\d]/g, '').toString();
            var split = numberString.split(',');
            var sisa = split[0].length % 3;
            var rupiah = split[0].substr(0, sisa);
            var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            $(this).val('Rp. '+rupiah);
        });

        $(document).on("click", "[data-name='save_data']", function(e) {
            var date_create     = $("[data-name='date_create']").val();
            var necessity       = $("[data-name='necessity']").val();
            var amount_asli     = $("[data-name='amount']").val();
            var amount          = amount_asli.replace(/[^0-9]/g, '');
            var unit            = $("[data-name='unit']").val();

            if (date_create === '' || necessity === '' || amount === '' || unit === '') {
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
                    url: "{{ route('cekdatacia') }}",
                    data: {
                        date_create:date_create,
                        necessity:necessity,
                        amount:amount,
                        unit:unit
                    },
                    cache: false,
                    success: function(data) {
                        // console.log(data);

                        if(data.cek === 0){
                            inputcia(date_create,necessity,amount,unit)
                        }else{
                            $('#showlistcia').html(data.html);
                            $('#show_cek_cia').modal('show');
                        }
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

        function inputcia(date_create,necessity,amount,unit){
            var remark = '';
            $.ajax({
                type: "POST",
                url: "{{ route('inpinputcia') }}",
                data: {
                    date_create:date_create,
                    necessity:necessity,
                    amount:amount,
                    unit:unit,
                    remark:remark
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
                        $("[data-name='date_create']").val('');
                        $("[data-name='necessity']").val('');
                        $("[data-name='amount']").val('');
                        $("[data-name='unit']").val('');
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

        $(document).on("click", "[data-name='next_urgent']", function(e) {
            $("[data-name='remark']").val('');
            $('#modal_remark').modal('show');
        });

        $(document).on("click", "[data-name='save_remark']", function(e) {
            var remark = $("[data-name='remark']").val();
            var date_create     = $("[data-name='date_create']").val();
            var necessity       = $("[data-name='necessity']").val();
            var amount_asli     = $("[data-name='amount']").val();
            var amount          = amount_asli.replace(/[^0-9]/g, '');
            var unit            = $("[data-name='unit']").val();

            if(remark === ''){
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
                    url: "{{ route('inpinputcia') }}",
                    data: {
                        date_create:date_create,
                        necessity:necessity,
                        amount:amount,
                        unit:unit,
                        remark:remark
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
                            $("[data-name='date_create']").val('');
                            $("[data-name='necessity']").val('');
                            $("[data-name='amount']").val('');
                            $("[data-name='unit']").val('');
                            $('#modal_remark').modal('hide');
                            $('#show_cek_cia').modal('hide');
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
    {{-- End JS Create Data --}}

    {{-- JS Print CIA --}}
    <script>
        function converttorupiah(val){
            let roundedNumber = Math.round(val * 100) / 100;
            let rupiah = roundedNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return "Rp. " + rupiah;
        }

        $(document).on("click", "[data-name='print_to_casier']", function(e) {
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
                    var show_foto = "{{ asset('assets/img/draft.png') }}";
                    $('#img_status').attr('src', show_foto);
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

        $(document).on("click", "[data-name='download_to_casier']", function (e) {
            var elementToCapture    = document.getElementById("datashowchasier");
            var namefilecapture     = $(this).attr("data-item");
            html2canvas(elementToCapture).then(function(canvas) {
                var imageDataUrl = canvas.toDataURL("image/png");
                var downloadLink = document.createElement("a");
                downloadLink.href = imageDataUrl;
                date    = new Date();
                downloadLink.download = "CIA-"+moment(date).format('DD-MMMM-YYYY')+".png";
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            });
        });

        $(document).on("click", "[data-name='show_app_chasier']", function(e) {
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
                    $('#modal_show_app_chasier').modal('show');
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
    {{-- End JS Print CIA --}}

    <script>
        $('input[data-name="date_create"]').datepicker({
            format: "yyyy-mm-dd",
            viewMode: "days",
            minViewMode: "days",
            autoclose: true
        });


    </script>

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#listcekcia').DataTable({
                responsive: true,
                autoWidth: false
            });
        });
    </script>
    {{-- End JS Datatable --}}


@stop
