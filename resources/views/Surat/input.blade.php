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

                            <button type="button" class="btn btn-success" data-name="add">ADD FORM</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Letter Admin</th>
                                        <th>Notes</th>
                                        <th>From Dept</th>
                                        <th>Date Release</th>
                                        <th>Employee</th>
                                        <th>To Dept</th>
                                        <th>Date Creation</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($arr as $key => $value)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $value->letter_admin }}</td>
                                            <td>{{ $value->notes }}</td>
                                            <td class="text-center">{{ $value->usr_role }}</td>
                                            <td class="text-right">
                                                {{ \Carbon\Carbon::parse($value->date_release)->isoFormat('dddd, DD MMM YYYY') }}
                                            </td>
                                            <td class="text-center">{{ $value->usr_name }}</td>
                                            <td class="text-center">{{ $value->tujuan }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($value->last_update)->isoFormat('dddd, DD MMM YYYY HH:mm:ss') }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-info" data-name="edit"
                                                    data-item="{{ $value->id }}">
                                                    Edit
                                                </button>

                                                <button type="button" class="btn btn-outline-danger" data-name="delete"
                                                    data-item="{{ $value->id }}">
                                                    Delete
                                                </button>
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
    <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="date_release">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" data-name="notes"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tujuan Dept</label>
                            <input type="text" class="form-control" id="" data-name="tujuan">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="edit_date_release">
                            <input type="hidden" data-name="edit_id">
                            <input type="hidden" data-name="edit_letter_admin">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" data-name="edit_notes"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tujuan Dept</label>
                            <input type="text" class="form-control" id="" data-name="edit_tujuan">
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

    {{-- JS Add Data --}}
    <script>
        $(document).on("click", "[data-name='add']", function(e) {
            $("[data-name='date_release']").val('');
            $("[data-name='notes']").val('');
            $("[data-name='tujuan']").val('');
            $("#modal_add").modal('show');
        });

        $(document).on("click", "[data-name='save_add']", function(e) {
            var date_release = $("[data-name='date_release']").val();
            var notes = $("[data-name='notes']").val();
            var tujuan = $("[data-name='tujuan']").val();
            var is_active = 1;
            var employe = "{!! $idn_user->id !!}";
            var table = "trx_surat";

            var data = {
                date_release: date_release,
                notes: notes,
                tujuan: tujuan,
                is_active: is_active,
                employe: employe
            };

            if (date_release === '' || notes === '' || tujuan === '') {
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
                    $("[data-name='edit_tujuan']").val(data['data'].tujuan);
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
            var tujuan = $("[data-name='edit_tujuan']").val();
            var letter_admin = $("[data-name='edit_letter_admin']").val();

            var table = "trx_surat";
            var whr = "id";
            var id = $("[data-name='edit_id']").val();
            var dats = {
                date_release: date_release,
                notes: notes,
                tujuan: tujuan,
                letter_admin: letter_admin,
            };

            if (date_release === '' || notes === '') {
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

        $('input[data-name="edit_date_release"]').datepicker({
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
