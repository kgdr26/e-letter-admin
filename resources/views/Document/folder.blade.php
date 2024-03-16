@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row">

        @php
            $role_data_document    = ['1','12'];
        @endphp
        @if(in_array($idn_user->role_id , $role_data_document))
            <div class="col-xxl-2 col-md-2">
                <a href="#" data-name="add">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">ADD FOLDER</h5>
        
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-folder-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
        
        @foreach($arr as $key => $v)
            <div class="col-xxl-2 col-md-2">
                
                <div class="card info-card sales-card">

                    @php
                        $role_data_document    = ['1','12'];
                    @endphp
                    @if(in_array($idn_user->role_id , $role_data_document))
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Action</h6>
                                </li>
            
                                <li><a class="dropdown-item" href="#" data-name="edit" data-item="{{$v->id}}">Edit</a></li>
                                <li><a class="dropdown-item" href="#" data-name="delete" data-item="{{$v->id}}">Delete</a></li>
                            </ul>
                        </div>
                    @endif
    
                    <div class="card-body">
                        <a href="{{route('detaildocument',['id_folder'=>$v->id])}}">
                            <h5 class="card-title">{{$v->folder_name}}</h5>
            
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-check"></i>
                                    </div>
                                    <div class="ps-3">
                                    <h6>{{$countingfile[$v->id]}}</h6>
                                    <span class="text-muted small pt-2 ps-1">Files</span>
                                </div>
                            </div>
                        </a>
                    </div>
    
                </div>
            </div>
        @endforeach

    </div>
</section>

{{-- Modal Add --}}
<div class="modal fade" id="modal_add" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Folder Name</label>
                        <input type="text" class="form-control" id="" data-name="folder_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_add">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Add --}}

{{-- Modal Edit --}}
<div class="modal fade" id="modal_edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Folder Name</label>
                        <input type="text" class="form-control" id="" data-name="edit_folder_name">
                        <input type="hidden" data-name="edit_id">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_edit">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Edit --}}

{{-- JS Add Data --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("[data-name='folder_name']").val('');
        $("#modal_add").modal('show');
    });

    $(document).on("click", "[data-name='save_add']", function (e) {
        var folder_name = $("[data-name='folder_name']").val();
        var is_active   = 1;
        var update_by   = "{!! $idn_user->id !!}";
        var table       = "trx_folder";

        var data = {
                folder_name:folder_name,
                is_active: is_active,
                update_by: update_by
            };

        if (folder_name === '') {
            Swal.fire({
                position:'center',
                title: 'Form is empty!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
            })
        }else{
            $.ajax({
                type: "POST",
                url: "{{ route('actionadd') }}",
                data: {table: table, data: data},
                cache: false,
                success: function(data) {
                    // console.log(data);
                    $("#modal_add").modal('hide');
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        location.reload();
                    })
                },            
                error: function (data) {
                    Swal.fire({
                        position:'center',
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
{{-- End JS Add Data --}}

{{-- JS Edit Data --}}
<script>
    $(document).on("click", "[data-name='edit']", function(e) {
        var id = $(this).attr("data-item");
        var table = 'trx_folder';
        var field = 'id';

        $.ajax({
            type: "POST",
            url: "{{ route('actionshowdata') }}",
            data: {
                id: id,
                table: table,
                field: field
            },
            cache: false,
            success: function(data) {
                // console.log(data['data']);
                $("[data-name='edit_id']").val(data['data'].id);
                $("[data-name='edit_folder_name']").val(data['data'].folder_name);
                $("#modal_edit").modal('show');
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

    $(document).on("click", "[data-name='save_edit']", function(e) {
        var folder_name = $("[data-name='edit_folder_name']").val();

        var table = "trx_folder";
        var whr = "id";
        var id = $("[data-name='edit_id']").val();
        var dats = {
            folder_name: folder_name,
        };

        if (folder_name === '') {
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
{{-- End JS Edit Data --}}

{{-- JS Delete Data --}}
<script>
    $(document).on("click", "[data-name='delete']", function(e) {
        var id = $(this).attr("data-item");
        var table = 'trx_folder';
        var whr = 'id';

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Aksi ini tidak dapat diulang!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('actiondelete') }}",
                    data: {
                        id: id,
                        whr: whr,
                        table: table
                    },
                    cache: false,
                    success: function(data) {
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
        })
    });
</script>
{{-- End JS Delete Data --}}

@stop