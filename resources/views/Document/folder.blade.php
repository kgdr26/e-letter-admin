@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row">

        <div class="col-xxl-2 col-md-6">
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
        
        @foreach($arr as $key => $v)
            <div class="col-xxl-4 col-md-6">
                <a href="#" data-name="add">
                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Action</h6>
                                </li>
            
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div>
        
                        <div class="card-body">
                            <h5 class="card-title">Folder Name <span>| {{$v->folder_name}}</span></h5>
            
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-check"></i>
                                    </div>
                                    <div class="ps-3">
                                    <h6>145</h6>
                                    <span class="text-muted small pt-2 ps-1">Files</span>
                                </div>
                            </div>
                        </div>
        
                    </div>
                </a>
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

@stop