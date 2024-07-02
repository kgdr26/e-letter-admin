@extends('main')
@section('content')
    <style>
        .text-right {
            text-align: right;
        }
    </style>
    <section class="section dashboard">
        <div class="row align-items-top">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>List Form</span>

                            <div>
                                <button type="button" class="btn btn-info" data-name="export"><i class="bi bi-file-earmark-spreadsheet"></i>Export</button>
                                <button type="button" class="btn btn-success" data-name="add">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Letter Admin</th>
                                        <th>Notes</th>
                                        <th>From Dept</th>
                                        <th>Date Release</th>
                                        <th>Employee</th>
                                        <th>To Dept</th>
                                        <th>Date Creation</th>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">Show Files</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        $role_show_data = explode(",",$whrshow);
                                    @endphp
                                    @foreach ($arr as $key => $value)
                                        @if (in_array($value->role_id, $role_show_data))
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                {{-- <td>st{{ $value->is_active }}</td> --}}
                                                <td>{{ $value->letter_admin }}</td>
                                                <td>{{ $value->notes }}</td>
                                                <td class="text-center">{{ $value->usr_role }}</td>
                                                <td class="text-right">
                                                    {{ \Carbon\Carbon::parse($value->date_release)->isoFormat('dddd, DD MMM YYYY') }}
                                                </td>
                                                <td class="text-center">{{ $value->usr_name }}</td>
                                                <td class="text-center">{{ $value->usr_to_dept }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($value->last_update)->isoFormat('dddd, DD MMM YYYY HH:mm:ss') }}
                                                </td>

                                                <td class="text-center">
                                                    @if ($value->update_by == $idn_user->id || $idn_user->role_id == 1)
                                                        @php
                                                            $disabled_button = '';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $disabled_button = 'disabled';
                                                        @endphp
                                                    @endif
                                                    <button type="button" class="btn btn-outline-info btn-sm"
                                                        data-name="edit" data-item="{{ $value->id }}"
                                                        {{ $disabled_button }}>
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-outline-warning btn-sm"
                                                        data-name="upload_file" data-item="{{ $value->id }}">
                                                        Upload
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-name="delete" data-item="{{ $value->id }}"
                                                        {{ $disabled_button }}>
                                                        Delete
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    @if ($value->name_file == null)
                                                        <a href="" class="btn btn-outline-danger btn-sm"
                                                            target="_blank" disabled>
                                                            <i class="bi bi-filetype-pdf" style="font-size: 15px"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('assets/file/' . $value->name_file) }}"
                                                            class="btn btn-outline-danger btn-sm" target="_blank">
                                                            <i class="bi bi-filetype-pdf" style="font-size: 15px"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
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
    <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Date</label>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="date_release" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Noted/Remark</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" data-name="notes"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Dept. Purpose</label>
                            <select name="" id="" class="form-select select-2-add" data-name="to_dept">
                                <option value="">-- Select Dept --</option>
                                @foreach ($roleinput as $kr => $vr)
                                    <option value="{{ $vr->id }}">{{ $vr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_add">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal ADD --}}

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Update Date</label>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="edit_date_release" readonly>
                            <input type="hidden" data-name="edit_id">
                            <input type="hidden" data-name="edit_letter_admin">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Update Note/Remark</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" data-name="edit_notes"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Update Dept. Purpose</label>
                            {{-- <input type="text" class="form-control" id="" data-name="edit_to_dept"> --}}
                            <select name="" id="" class="form-select select-2-edit" data-name="edit_to_dept">
                                <option value="">-- Select Dept --</option>
                                @foreach ($roleinput as $kr => $vr)
                                    <option value="{{ $vr->id }}">{{ $vr->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" data-name="edit_to_dept_old">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_edit">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit --}}

    {{-- Modal Upload File --}}
    <div class="modal fade" id="modal_upload_file" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File</h1>
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
                                    <input type="hidden" data-name="id_surat">
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_file">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Upload File --}}

    {{-- Modal Export Excel --}}
    <div class="modal fade" id="modal_export" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Export To Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Start Date</label>
                            <input type="text" class="form-control" id="" placeholder="" data-name="start_date_expore">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">End Date</label>
                            <input type="text" class="form-control" id="" placeholder="" data-name="end_date_expore">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_export">Export</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Export Excel --}}

    {{-- JS Export Excel --}}
    <script>
        $(document).on("click", "[data-name='export']", function(e) {
            $("[data-name='start_date_expore']").val('');
            $("[data-name='end_date_expore']").val('');
            $("#modal_export").modal('show');
        });

        $(document).on("click", "[data-name='save_export']", function(e) {
            var start   = $("[data-name='start_date_expore']").val();
            var end     = $("[data-name='end_date_expore']").val();
            var select_bulan    = start+'/'+end;

            if (start === '' || end === '') {
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
                var urlTemplate =
                    '{{ route('exportsuratadmin', ['select_bulan' => 'selectbulanid']) }}';
                var replacements = [{
                        pattern: 'selectbulanid',
                        replacement: select_bulan
                    }
                ];
                // var url         = urlTemplate.replace('kategoriid', kategori);
                replacements.forEach(function(replacement) {
                    url = urlTemplate.replace(replacement.pattern, replacement.replacement);
                });
                window.location.href = url;

                $("#modal_export").modal('hide');
            }
        });
    </script>
    {{-- End JS Export Excel --}}

    {{-- JS Add Data --}}
    <script>
        $(document).on("click", "[data-name='add']", function(e) {
            // $("[data-name='date_release']").val('');
            $("[data-name='notes']").val('');
            $("[data-name='to_dept']").val('');
            $("#modal_add").modal('show');
        });

        $(document).on("click", "[data-name='save_add']", function(e) {
            var date_release = $("[data-name='date_release']").val();
            var notes = $("[data-name='notes']").val();
            var to_dept = $("[data-name='to_dept']").val();
            var is_active = 1;
            var employe = "{!! $idn_user->id !!}";
            var table = "trx_surat";

            var data = {
                date_release: date_release,
                notes: notes,
                to_dept: to_dept,
                is_active: is_active,
                employe: employe
            };

            if (date_release === '' || notes === '' || to_dept === '') {
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
                    url: "{{ route('addform') }}",
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
                            title: data.kode_letter,
                            icon: 'success',
                            showConfirmButton: true,
                            // timer: 1500
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
    {{-- End JS Add Data --}}

    {{-- JS Edit Data --}}
    <script>
        $(document).on("click", "[data-name='edit']", function(e) {
            var id = $(this).attr("data-item");
            var table = 'trx_surat';
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
                    $("[data-name='edit_date_release']").val(data['data'].date_release);
                    $("[data-name='edit_notes']").val(data['data'].notes);
                    $("[data-name='edit_to_dept']").val(data['data'].to_dept).trigger("change");
                    $("[data-name='edit_to_dept_old']").val(data['data'].to_dept);
                    $("[data-name='edit_letter_admin']").val(data['data'].letter_admin);
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
            var date_release = $("[data-name='edit_date_release']").val();
            var notes = $("[data-name='edit_notes']").val();
            var to_dept = $("[data-name='edit_to_dept']").val();
            var to_dept_old = $("[data-name='edit_to_dept_old']").val();
            var letter_admin = $("[data-name='edit_letter_admin']").val();

            var table = "trx_surat";
            var whr = "id";
            var id = $("[data-name='edit_id']").val();
            var dats = {
                date_release: date_release,
                notes: notes,
                to_dept: to_dept,
                letter_admin: letter_admin,
                to_dept_old: to_dept_old
            };

            if (date_release === '' || notes === '' || to_dept === '') {
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
                    url: "{{ route('actioneditform') }}",
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
            var table = 'trx_surat';
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

    {{-- JS Upload FIle --}}
    <script>
        $(document).on("click", "[data-name='upload_file']", function(e) {
            var id = $(this).attr("data-item");
            $("[data-name='file_name']").val('');
            $("#file_name").val('');
            $("[data-name='id_surat']").val(id);
            $("#modal_upload_file").modal('show');
        });

        $(document).ready(function() {
            // Handle change event of file input
            $("[data-name='file_name']").change(function(e) {
                // Get the files


                var ext = $("#add_file").val().split('.').pop().toLowerCase();
                // console.log(e.target.files[0])
                if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'pdf', 'xlsx', 'xls']) == -1) {
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

                            $('#file_name').val(res);
                            $('#fileInfo').append(html);
                        }
                    })

                }
            });
        });

        $(document).on("click", "[data-name='save_file']", function(e) {
            var name_file = $("[data-name='name_file']").val();
            var table = "trx_surat";
            var whr = "id";
            var id = $("[data-name='id_surat']").val();
            var dats = {
                name_file: name_file,
            };

            if (name_file === '') {
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
    {{-- End JS Upload File --}}

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

    <script>
        $('input[data-name="date_release"]').datepicker({
            format: "yyyy-mm-dd",
            viewMode: "days",
            minViewMode: "days",
            autoclose: true
        });

        $('input[data-name="start_date_expore"]').datepicker({
            format: "yyyy-mm-dd",
            viewMode: "days",
            minViewMode: "days",
            autoclose: true
        });

        $('input[data-name="end_date_expore"]').datepicker({
            format: "yyyy-mm-dd",
            viewMode: "days",
            minViewMode: "days",
            autoclose: true
        });
    </script>



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
