@extends('main')
@section('content')

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>List File</span>
                            @php
                                $role_data_document = ['1', '23'];
                            @endphp
                            @if (in_array($idn_user->role_id, $role_data_document))
                                <button type="button" class="btn btn-success" data-name="add">Add File</button>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tittle</th>
                                        <th>File</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                        <th>Rev-n</th>
                                        <th>Eff.Date</th>
                                        <th>Departement</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($arr as $key => $value)
                                        <tr class="text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $value->tittle }}</td>
                                            <td>{{ $value->file_name }}</td>
                                            <td>{{ $value->ukuran }}.Kb</td>
                                            <td>{{ $value->status }}</td>
                                            <td>{{ $value->revisi }}</td>
                                            <td>{{ $value->tgl_efektif }}</td>
                                            <td>{{ $value->role_name }}</td>

                                            <td class="text-center">
                                                @php
                                                    $role_data_document = ['1', '23'];
                                                @endphp
                                                @if (in_array($idn_user->role_id, $role_data_document))
                                                    <button type="button" class="btn btn-outline-info btn-sm"
                                                        data-name="edit" data-item="{{ $value->id }}">
                                                        Edit
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-outline-warning btn-sm"
                                                    data-name="show" data-item="{{ $value->file_name }}">
                                                    Show
                                                </button>
                                                @php
                                                    $role_data_document = ['1', '12'];
                                                @endphp
                                                @if (in_array($idn_user->role_id, $role_data_document))
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-name="delete" data-item="{{ $value->id }}">
                                                        Delete
                                                    </button>
                                                @endif
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
    </section>

    {{-- Modal Add --}}
    <div class="modal fade" id="modal_add" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12 mb-3">
                            <div class="card-style">
                                <div class="mb-3">
                                    <label for="" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="add_file" placeholder=""
                                        data-name="file_name">
                                    <input type="hidden" id="file_name" data-name="name_file">
                                    <input type="hidden" data-name="ukuran">
                                    <input type="hidden" data-name="id_folder" value="{{ $id_folder }}">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Tittle</label>
                                    <input type="text" class="form-control" id="add" data-name="tittle">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="" id="" class="form-select select-2-add"
                                        data-name="status">
                                        <option value="">-- Select Status --</option>
                                        <option value="AKTIVE">AKTIVE</option>
                                        <option value="NON-AKTIVE">NON-ACTIVE</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Rev-n</label>
                                    <input type="text" class="form-control" id="add" data-name="revisi">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Eff.Date</label>
                                    <input type="date" class="form-control" id="" placeholder=""
                                        data-name="tgl_efektif">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Departement</label>
                                    <select name="" id="" class="form-select select-2-add"
                                        data-name="to_dept">
                                        <option value="">-- Select Dept --</option>
                                        @php
                                            $idroletampil = ['7', '8', '9', '10'];
                                        @endphp
                                        @foreach ($role as $kr => $vr)
                                            @if (in_array($vr->id, $idroletampil))
                                                <option value="{{ $vr->id }}">{{ $vr->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row" id="fileInfo">

                            </div>
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
                    <h5 class="modal-title">Edit File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12 mb-3">
                            <div class="card-style">
                                <div class="mb-3">
                                    <label for="" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="edit_file" placeholder=""
                                        data-name="edit_file_name">
                                    <input type="hidden" id="edit_file_name" data-name="edit_name_file">
                                    <input type="hidden" data-name="edit_ukuran">
                                    <input type="hidden" data-name="edit_id">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Tittle</label>
                                    <input name="" id="" cols="30" rows="10"
                                        class="form-control" data-name="edit_tittle"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="" id="" class="form-select select-2-edit"
                                        data-name="edit_status">
                                        <option value="">-- Select Status --</option>
                                        <option value="AKTIVE">AKTIVE</option>
                                        <option value="NON-AKTIVE">NON-ACTIVE</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Rev-n</label>
                                    <input name="" id="" cols="30" rows="10"
                                        class="form-control" data-name="edit_revisi"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Change Eff.Date</label>
                                    <input type="date" class="form-control" id="" placeholder=""
                                        data-name="edit_tgl_efektif">
                                    <input type="hidden" data-name="edit_id">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Departement</label>
                                    <select name="" id="" class="form-select select-2-edit"
                                        data-name="edit_to_dept">
                                        <option value="">-- Select Dept --</option>
                                        @php
                                            $idroletampil = ['7', '8', '9', '10'];
                                        @endphp
                                        @foreach ($role as $kr => $vr)
                                            @if (in_array($vr->id, $idroletampil))
                                                <option value="{{ $vr->id }}">{{ $vr->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row" id="fileInfoedit">

                            </div>
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

    {{-- Modal Show --}}
    <div class="modal fade" id="modal_show" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Show File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="show_file" type="application/pdf" src=""
                        style="width: 100%;height: 80vh;"></embed>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @php
                        $role_download = ['1', '12'];
                    @endphp
                    @if (in_array($idn_user->role_id, $role_download))
                        <a href="" class="btn btn-primary" target="_blank" data-name="download_documen">Download
                            File</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Show --}}

    {{-- JS Add Data --}}
    <script>
        $(document).on("click", "[data-name='add']", function(e) {
            $("[data-name='file_name']").val('');
            $("[data-name='tittle']").val('');
            $("[data-name='ukuran']").val('');
            $("[data-name='status']").val('');
            $("[data-name='revisi']").val('');
            $("[data-name='tgl_efektif']").val('');
            $("[data-name='to_dept']").val('');
            $("#modal_add").modal('show');
        });

        $(document).on("click", "[data-name='save_add']", function(e) {
            var file_name = $("[data-name='name_file']").val();
            var tittle = $("[data-name='tittle']").val();
            var ukuran = $("[data-name='ukuran']").val();
            var status = $("[data-name='status']").val();
            var revisi = $("[data-name='revisi']").val();
            var tgl_efektif = $("[data-name='tgl_efektif']").val();
            var to_dept = $("[data-name='to_dept']").val();
            var id_folder = $("[data-name='id_folder']").val();
            var is_active = 1;
            var update_by = "{!! $idn_user->id !!}";
            var table = "trx_file";

            var data = {
                file_name: file_name,
                tittle: tittle,
                ukuran: ukuran,
                status: status,
                revisi: revisi,
                tgl_efektif: tgl_efektif,
                to_dept: to_dept,
                id_folder: id_folder,
                is_active: is_active,
                update_by: update_by
            };

            if (file_name === '') {
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
                    url: "{{ route('actionadd') }}",
                    data: {
                        table: table,
                        data: data
                    },
                    cache: false,
                    success: function(data) {
                        // console.log(data);
                        $("#modal_add").modal('hide');
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

        $(document).ready(function() {
            // Handle change event of file input
            $("[data-name='file_name']").change(function(e) {
                // Get the files


                var ext = $("#add_file").val().split('.').pop().toLowerCase();
                // console.log(e.target.files[0])
                if ($.inArray(ext, ['pdf']) == -1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Format image failed!'
                    })
                } else {
                    var uploadedFile = URL.createObjectURL(e.target.files[0]);
                    var photo = e.target.files[0];
                    var formData = new FormData();
                    formData.append('add_file', photo);
                    $.ajax({
                        url: "{{ route('upload_surat') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            console.log(res);

                            var files = e.target.files[0];

                            // console.log(files);

                            // Clear previous file information
                            $('#fileInfo').html('');

                            // Loop through the files and display information
                            var html = '';

                            var fileName = files.name;
                            var fileSize = files.size;
                            var fileSizeKB = fileSize / 1024;

                            html += '<div class="col-12 mb-3">';
                            html += '<div class="card-preview-file">';
                            html +=
                                '<button class="btn btn-remove" type="button" data-item="remove_file">';
                            html += '<i class="bi bi-x-lg"></i>';
                            html += '</button>';
                            html += '<div class="card-info-file">';
                            html += '<p>' + fileName + '</p>';
                            html += '<p>' + fileSizeKB.toFixed(2) + ' KB</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            // Display file information

                            $('#file_name').val(fileName);
                            $("[data-name='ukuran']").val(fileSizeKB.toFixed(2));
                            $('#fileInfo').append(html);
                        }
                    })

                }
            });
        });
    </script>
    {{-- End JS Add Data --}}

    {{-- JS Edit Data --}}
    <script>
        $(document).on("click", "[data-name='edit']", function(e) {
            var id = $(this).attr("data-item");
            var table = 'trx_file';
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
                    console.log(data['data']);
                    $("[data-name='edit_id']").val(data['data'].id);
                    $("[data-name='edit_tittle']").val(data['data'].tittle);
                    $("[data-name='edit_name_file']").val(data['data'].file_name);
                    // $("[data-name='edit_file_name']").val(data['data'].file_name);
                    $("[data-name='edit_ukuran']").val(data['data'].ukuran);
                    $("[data-name='edit_status']").val(data['data'].status);
                    $("[data-name='edit_revisi']").val(data['data'].revisi);
                    $("[data-name='edit_tgl_efektif']").val(data['data'].tgl_efektif);
                    $("[data-name='edit_to_dept']").val(data['data'].to_dept).trigger("change");
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
            var file_name = $("[data-name='edit_name_file']").val();
            var ukuran = $("[data-name='edit_ukuran']").val();
            var status = $("[data-name='edit_status']").val();
            var revisi = $("[data-name='edit_revisi']").val();
            var tgl_efektif = $("[data-name='edit_tgl_efektif']").val();
            var to_dept = $("[data-name='edit_to_dept']").val();
            var tittle = $("[data-name='edit_tittle']").val();
            var update_by = "{!! $idn_user->id !!}";

            var table = "trx_file";
            var whr = "id";
            var id = $("[data-name='edit_id']").val();
            var dats = {
                file_name: file_name,
                ukuran: ukuran,
                status: status,
                revisi: revisi,
                tgl_efektif: tgl_efektif,
                to_dept: to_dept,
                tittle: tittle,
                update_by: update_by
            };

            if (file_name === '') {
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

        $(document).ready(function() {
            // Handle change event of file input
            $("[data-name='edit_file_name']").change(function(e) {
                // Get the files


                var ext = $("#edit_file").val().split('.').pop().toLowerCase();
                // console.log(e.target.files[0])
                if ($.inArray(ext, ['pdf']) == -1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Format image failed!'
                    })
                } else {
                    var uploadedFile = URL.createObjectURL(e.target.files[0]);
                    var photo = e.target.files[0];
                    var formData = new FormData();
                    formData.append('add_file', photo);
                    $.ajax({
                        url: "{{ route('upload_surat') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            console.log(res);

                            var files = e.target.files[0];

                            // console.log(files);

                            // Clear previous file information
                            $('#fileInfoedit').html('');

                            // Loop through the files and display information
                            var html = '';

                            var fileName = files.name;
                            var fileSize = files.size;
                            var fileSizeKB = fileSize / 1024;

                            html += '<div class="col-12 mb-3">';
                            html += '<div class="card-preview-file">';
                            html +=
                                '<button class="btn btn-remove" type="button" data-item="remove_file">';
                            html += '<i class="bi bi-x-lg"></i>';
                            html += '</button>';
                            html += '<div class="card-info-file">';
                            html += '<p>' + fileName + '</p>';
                            html += '<p>' + fileSizeKB.toFixed(2) + ' KB</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            // Display file information

                            $('#edit_file_name').val(fileName);
                            $("[data-name='edit_ukuran']").val(fileSizeKB.toFixed(2));
                            $('#fileInfoedit').append(html);
                        }
                    })

                }
            });
        });
    </script>
    {{-- End JS Edit Data --}}

    {{-- JS Delete Data --}}
    <script>
        $(document).on("click", "[data-name='delete']", function(e) {
            var id = $(this).attr("data-item");
            var table = 'trx_file';
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

    {{-- JS Show file --}}
    <script>
        $(document).on("click", "[data-name='show']", function(e) {
            var file_name = $(this).attr("data-item");
            var to_dept = $(this).attr("data-item");
            var file = "{{ asset('assets/file') }}/" + file_name;
            $('#show_file').attr('src', file);
            $("[data-name='download_documen']").attr('href', file);
            $("#modal_show").modal('show');
        });
    </script>
    {{-- End JS Show File  --}}

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

    {{-- Select2 --}}
    <script>
        $(".select-2-add").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_add")
        });

        $(".select-2-edit").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_edit")
        });
    </script>
    {{-- End Select2 --}}

@stop
