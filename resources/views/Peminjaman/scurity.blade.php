@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card info-card sales-card">
                <div class="card-header">
                    <h6>Check Assets</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="" class="form-label">NOPOL</label>
                            <div class="input-group">
                                <span class="input-group-text" id=""><i class="bi bi-person-vcard-fill"></i></span>
                                <input type="text" class="form-control" id="" data-name="no_assets">
                                <button type="button" class="input-group-text btn btn-success" data-name="cek_assets">Cek Assets</button>
                            </div>
                        </div>
                    </div>

                    <h5 class="card-title">Detail Assets</h5>
                    <input type="hidden" data-name="val_id">
                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label">Nama Peminjam</div>
                        <div class="col-lg-9 col-md-8" data-name="val_usr_name">: -</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label">Waktu Peminjaman</div>
                        <div class="col-lg-9 col-md-8" data-name="val_waktu_peminjaman">: -</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label">NOPOL</div>
                        <div class="col-lg-9 col-md-8" data-name="val_ast_no">: -</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label">Mobil Name</div>
                        <div class="col-lg-9 col-md-8" data-name="val_ast_merk">: -</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label">Deskripsi</div>
                        <div class="col-lg-9 col-md-8" data-name="val_ast_name">: -</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label">Tahun</div>
                        <div class="col-lg-9 col-md-8" data-name="val_ast_tahun">: -</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label">Lokasi</div>
                        <div class="col-lg-9 col-md-8" data-name="val_ast_lokasi">: -</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label">Kepemilikan</div>
                        <div class="col-lg-9 col-md-8" data-name="val_ast_kepemilikan">: -</div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-success" data-name="approve">Approve</button>
                    <button type="button" class="btn btn-success" data-name="returned" style="display: none">Returned</button>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    $(document).on("click", "[data-name='cek_assets']", function(e) {
        var no_assets   = $("[data-name='no_assets']").val();

        $.ajax({
            type: "POST",
            url: "{{ route('detaildataassets') }}",
            data: {
                no_assets: no_assets
            },
            cache: false,
            success: function(data) {
                // console.log(data['data']);
                if(data['data'] === null){
                    Swal.fire({
                        position: 'center',
                        title: 'Data is not ready!',
                        icon: 'warning',
                        showConfirmButton: true,
                        // timer: 1500
                    })
                }else{
                    $("[data-name='val_id']").val(data['data'].id);
                    $("[data-name='val_usr_name']").text(': '+data['data'].usr_name);
                    $("[data-name='val_waktu_peminjaman']").text(': '+data['data'].date_start+' s/d '+data['data'].date_end);
                    $("[data-name='val_ast_no']").text(': '+data['data'].ast_no);
                    $("[data-name='val_ast_merk']").text(': '+data['data'].ast_merk);
                    $("[data-name='val_ast_name']").text(': '+data['data'].ast_name);
                    $("[data-name='val_ast_tahun']").text(': '+data['data'].ast_tahun);
                    $("[data-name='val_ast_lokasi']").text(': '+data['data'].ast_lokasi);
                    $("[data-name='val_ast_kepemilikan']").text(': '+data['data'].ast_kepemilikan);
                    
                    if(data['data'].status == 4){
                        $("[data-name='approve']").hide();
                        $("[data-name='returned']").show();
                    }else{
                        $("[data-name='approve']").show();
                        $("[data-name='returned']").hide();
                    }
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

    });
</script>

{{-- Approve Assets --}}
<script>
    $(document).on("click", "[data-name='approve']", function(e) {
        var id          = $("[data-name='val_id']").val();
        var id_second   = "{!! $idn_user->id !!}";
        var status      = 4;

        var table = "trx_assets_landing";
        var whr = "id";
        var dats = {
            id_second: id_second,
            status: status
        };

        if (id === '' || id_second === '') {
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

<script>
    $(document).on("click", "[data-name='returned']", function(e) {
        var id          = $("[data-name='val_id']").val();
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

@stop