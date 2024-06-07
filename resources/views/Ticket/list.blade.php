@extends('main')
@section('content')

    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-success" data-name="add">
                                Create
                            </button>
                            {{-- <button type="button" class="btn btn-success" data-name="add">Request Ticket</button> --}}
                            <div>
                                <button type="button" class="btn btn-primary" data-name="export">
                                    Export
                                </button>
                                {{-- <button type="button" class="btn btn-info" data-name="export">Export To Excel</button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">ID TICKET</th>
                                        <th class="text-center">USER.REQ</th>
                                        <th class="text-center">CREATE ON</th>
                                        <th class="text-center">TITLE REQUEST</th>
                                        <th class="text-center">DESCRIPTION</th>
                                        <th class="text-center">DUE DATE</th>
                                        <th class="text-center">MODIFIET ON</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">REMARK</th>
                                        <th class="text-center">PIC</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="text-midle">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($arr as $key => $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $val->id_ticket }}</td>
                                            <td>{{ $val->usr_name }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($val->date_create)->isoFormat('DD MMM YYYY HH:mm:ss') }}
                                            </td>
                                            <td>{{ $val->summary }}</td>
                                            <td>{{ $val->description }}</td>
                                            <td>
                                                @if ($val->due_date == null)
                                                    -
                                                @else
                                                    {{ \Carbon\Carbon::parse($val->due_date)->isoFormat('DD MMM YYYY HH:mm:ss') }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($val->last_update)->isoFormat('DD MMM YYYY HH:mm:ss') }}
                                            </td>
                                            <td class="text-center">
                                                @if ($val->status == 1)
                                                    @php
                                                        $class_st = 'info';
                                                        $persen = '100';
                                                    @endphp
                                                @elseif ($val->status == 2)
                                                    @php
                                                        $class_st = 'warning';
                                                        $persen = '100';
                                                    @endphp
                                                @elseif ($val->status == 3)
                                                    @php
                                                        $class_st = 'success';
                                                        $persen = '50';
                                                    @endphp
                                                @elseif ($val->status == 4)
                                                    @php
                                                        $class_st = 'success';
                                                        $persen = '80';
                                                    @endphp
                                                @elseif ($val->status == 5)
                                                    @php
                                                        $class_st = 'success';
                                                        $persen = '100';
                                                    @endphp
                                                @elseif ($val->status == 6)
                                                    @php
                                                        $class_st = 'danger';
                                                        $persen = '100';
                                                    @endphp
                                                @else
                                                    @php
                                                        $class_st = 'info';
                                                        $persen = '100';
                                                    @endphp
                                                @endif
                                                <figure class="figure-progress-bar">
                                                    <figcaption class="{{ $class_st }}" style="font-size: 0.7rem">
                                                        {{ $val->sts_name }}</figcaption>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-{{ $class_st }} progress-bar-striped active"
                                                            style="width: {{ $persen }}%;"></div>
                                                    </div>
                                                </figure>
                                            </td>
                                            <td>{{ $val->note }}</td>
                                            <td>
                                                @if ($val->status >= 3)
                                                    {{ $val->pic_name }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center text-nowrap">
                                                @if ($val->status == 1)
                                                    <button type="button" class="btn btn-info btn-sm" data-name="edit"
                                                        data-item="{{ $val->id }}"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                @endif
                                                <button type="button" class="btn btn-primary btn-sm" data-name="show"
                                                    data-item="{{ $val->id }}"><i class="bi bi-eye-fill"></i></button>
                                                @php
                                                    $whrin = explode(',', $wherein->whr_show_ticket);
                                                @endphp
                                                @if (in_array($val->status, $whrin))
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-name="updatestep" data-item="{{ $val->id }}"
                                                        data-status="{{ $val->status + 1 }}"><i
                                                            class="bi bi-check2-circle"></i></button>
                                                @endif

                                                {{-- @if ($val->status == 1)
                                                    <button type="button" class="btn btn-success btn-sm" data-name="updatestep" data-item="{{$val->id}}" data-status="2"><i class="bi bi-check2-circle"></i></button>
                                                @elseif($val->status == 2)
                                                    <button type="button" class="btn btn-success btn-sm" data-name="updatestep" data-item="{{$val->id}}" data-status="3"><i class="bi bi-check2-circle"></i></button>
                                                @elseif($val->status == 3)
                                                    <button type="button" class="btn btn-success btn-sm" data-name="updatestep" data-item="{{$val->id}}" data-status="4"><i class="bi bi-check2-circle"></i></button>
                                                @elseif($val->status == 4)
                                                    <button type="button" class="btn btn-success btn-sm" data-name="updatestep" data-item="{{$val->id}}" data-status="5"><i class="bi bi-check2-circle"></i></button>
                                                @endif --}}
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-style">
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Name"
                                        value="{{ $idn_user->name }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">NPK</label>
                                    <input type="text" class="form-control" id="" placeholder="NPK"
                                        value="{{ $idn_user->npk }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="" placeholder="Phone"
                                        value="{{ $idn_user->no_tlp }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="" placeholder="Email"
                                        value="{{ $idn_user->email }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Departement</label>
                                    <input type="text" class="form-control" id="" placeholder="Departement"
                                        data-name="departement">
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Title Request</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Title Request" data-name="summary">
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Description Of Request</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="5"
                                        data-name="description"></textarea>
                                </div>

                            </div>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-style">
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Name"
                                        value="{{ $idn_user->name }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">NPK</label>
                                    <input type="text" class="form-control" id="" placeholder="NPK"
                                        value="{{ $idn_user->npk }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="" placeholder="Phone"
                                        value="{{ $idn_user->no_tlp }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="" placeholder="Email"
                                        value="{{ $idn_user->email }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Departement</label>
                                    <input type="text" class="form-control" id="" placeholder="Departement"
                                        data-name="edit_departement">
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Title Request</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Title Request" data-name="edit_summary">
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Description Of Request</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="5"
                                        data-name="edit_description"></textarea>
                                    <input type="hidden" name="" id="" data-name="edit_id">
                                </div>

                            </div>
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

    {{-- Modal Update --}}
    <div class="modal fade" id="modal_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="judulmodal">Update Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-style">
                                <div class="mb-3">
                                    <label for="" class="form-label">User Create</label>
                                    <input type="text" class="form-control" id="" placeholder="Name"
                                        data-name="upd_usr" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="" placeholder="Phone"
                                        data-name="upd_no_tlp" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="" placeholder="Email"
                                        data-name="upd_email" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Departement</label>
                                    <input type="text" class="form-control" id="" placeholder="Departement"
                                        data-name="upd_departement" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Title Request</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Title Request" data-name="upd_summary" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Description Of Request</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="5"
                                        data-name="upd_description" disabled></textarea>
                                    <input type="hidden" name="" id="" data-name="upd_id">
                                    <input type="hidden" name="" id="" data-name="upd_step">
                                </div>

                                <div class="mb-3" id="duedate" style="display: none">
                                    <label for="" class="form-label">Due Date</label>
                                    <input type="text" class="form-control" id="" placeholder="Due Date"
                                        data-name="due_date">
                                </div>

                                <div class="mb-3" id="shownote" style="display: none">
                                    <label for="" class="form-label">Noted</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="5" data-name="note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-name="reject_update">Reject</button>
                    <button type="button" class="btn btn-primary" data-name="save_update" id="textbtn">-</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Update --}}

    {{-- Modal Show --}}
    <div class="modal fade" id="modal_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Show Data Request Ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-style">
                                <div class="mb-3">
                                    <label for="" class="form-label">User Create</label>
                                    <input type="text" class="form-control" id="" placeholder="Name"
                                        data-name="show_usr" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="" placeholder="Phone"
                                        data-name="show_no_tlp" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="" placeholder="Email"
                                        data-name="show_email" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="" placeholder="Departement"
                                        data-name="show_status" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Departement</label>
                                    <input type="text" class="form-control" id="" placeholder="Departement"
                                        data-name="show_departement" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Title Request</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Title Request" data-name="show_summary" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Description Of Request</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="5"
                                        data-name="show_description" disabled></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Due Date</label>
                                    <input type="text" class="form-control" id="" placeholder="Due Date"
                                        data-name="show_due_date" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Noted</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="5" data-name="show_note"
                                        disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Show --}}

    {{-- Modal Export Excel --}}
    <div class="modal fade" id="modal_export" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Export</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Start Bulan</label>
                            <input type="text" class="form-control" id="" placeholder=""
                                data-name="select_bulan">
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

    {{-- JS Add Data --}}
    <script>
        $(document).on("click", "[data-name='add']", function(e) {
            $("[data-name='departement']").val('');
            $("[data-name='summary']").val('');
            $("[data-name='description']").val('');
            $("#modal_add").modal('show');
        });

        $(document).on("click", "[data-name='save_add']", function(e) {
            var departement = $("[data-name='departement']").val();
            var summary = $("[data-name='summary']").val();
            var description = $("[data-name='description']").val();

            if (departement === '' || summary === '' || description === '') {
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
                    url: "{{ route('addticketrequest') }}",
                    data: {
                        departement: departement,
                        summary: summary,
                        description: description
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
            var table = 'trx_ticket_request';
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
                    $("[data-name='edit_departement']").val(data['data'].departement);
                    $("[data-name='edit_summary']").val(data['data'].summary);
                    $("[data-name='edit_description']").val(data['data'].description);
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
            var id = $("[data-name='edit_id']").val();
            var departement = $("[data-name='edit_departement']").val();
            var summary = $("[data-name='edit_summary']").val();
            var description = $("[data-name='edit_description']").val();
            var step = 0;

            if (id === '' || departement === '' || summary === '' || description === '') {
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
                    url: "{{ route('editticketrequest') }}",
                    data: {
                        id: id,
                        departement: departement,
                        summary: summary,
                        description: description,
                        step: step
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

    {{-- JS Update Status --}}
    <script>
        $(document).on("click", "[data-name='updatestep']", function(e) {
            var id = $(this).attr("data-item");
            var step = $(this).attr("data-status");

            $.ajax({
                type: "POST",
                url: "{{ route('showdataticket') }}",
                data: {
                    id: id,
                },
                cache: false,
                success: function(data) {
                    // console.log(data);
                    $("[data-name='upd_id']").val(data.id);
                    $("[data-name='upd_usr']").val(data.usr_npk + ' - ' + data.usr_name);
                    $("[data-name='upd_no_tlp']").val(data.usr_tlp);
                    $("[data-name='upd_email']").val(data.usr_email);
                    $("[data-name='upd_departement']").val(data.departement);
                    $("[data-name='upd_summary']").val(data.summary);
                    $("[data-name='upd_description']").val(data.description);
                    $("[data-name='upd_step']").val(step);
                    $("[data-name='due_date']").val(data.due_date);
                    $("[data-name='note']").val(data.note);

                    if (data.status === 1) {
                        $("#judulmodal").text('APPRIVE DEPHEAD');
                        $("#textbtn").text('APPRIVE DEPHEAD');
                        $("#shownote").hide();
                        $("#duedate").hide();
                    } else if (data.status === 2) {
                        $("#judulmodal").text('ON PROGRESS BY IT');
                        $("#textbtn").text('ON PROGRESS BY IT');
                        $("#shownote").hide();
                        $("#duedate").show();
                    } else if (data.status === 3) {
                        $("#judulmodal").text('RESOLVED BY IT');
                        $("#textbtn").text('RESOLVED BY IT');
                        $("#shownote").hide();
                        $("#duedate").hide();
                    } else if (data.status === 4) {
                        $("#judulmodal").text('CLOSED BY IT');
                        $("#textbtn").text('CLOSED BY IT');
                        $("#shownote").show();
                        $("#duedate").hide();
                    } else {
                        $("#judulmodal").text('');
                        $("#textbtn").text('');
                        $("#shownote").hide();
                        $("#duedate").hide();
                    }

                    $("#modal_update").modal('show');
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

        $(document).on("click", "[data-name='save_update']", function(e) {
            var id = $("[data-name='upd_id']").val();
            var step = $("[data-name='upd_step']").val();
            var due_date = $("[data-name='due_date']").val();
            var note = $("[data-name='note']").val();

            if (id === '' || step === '') {
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
                    url: "{{ route('editticketrequest') }}",
                    data: {
                        id: id,
                        step: step,
                        due_date: due_date,
                        note: note
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

        $(document).on("click", "[data-name='reject_update']", function(e) {
            var id = $("[data-name='upd_id']").val();
            var step = 6;
            var due_date = $("[data-name='due_date']").val();
            var note = '-';

            if (id === '' || step === '') {
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
                    url: "{{ route('editticketrequest') }}",
                    data: {
                        id: id,
                        step: step,
                        due_date: due_date,
                        note: note
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
    {{-- End Update Status --}}

    {{-- JS Show Data --}}
    <script>
        $(document).on("click", "[data-name='show']", function(e) {
            var id = $(this).attr("data-item");

            $.ajax({
                type: "POST",
                url: "{{ route('showdataticket') }}",
                data: {
                    id: id,
                },
                cache: false,
                success: function(data) {
                    // console.log(data);
                    $("[data-name='show_usr']").val(data.usr_npk + ' - ' + data.usr_name);
                    $("[data-name='show_no_tlp']").val(data.usr_tlp);
                    $("[data-name='show_email']").val(data.usr_email);
                    $("[data-name='show_status']").val(data.sts_name);
                    $("[data-name='show_departement']").val(data.departement);
                    $("[data-name='show_summary']").val(data.summary);
                    $("[data-name='show_description']").val(data.description);
                    $("[data-name='show_due_date']").val(data.due_date);
                    $("[data-name='show_note']").val(data.note);

                    $("#modal_show").modal('show');
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
    {{-- End JS Show Dat --}}

    {{-- JS Export Data --}}
    <script>
        $(document).on("click", "[data-name='export']", function(e) {
            $("[data-name='select_bulan']").val('');

            $("#modal_export").modal('show');
        });

        $(document).on("click", "[data-name='save_export']", function(e) {
            var select_bulan = $("[data-name='select_bulan']").val();

            if (select_bulan === '') {
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
                var urlTemplate = '{{ route('exportrequestticket', ['select_bulan' => 'selectbulanid']) }}';
                var replacements = [{
                    pattern: 'selectbulanid',
                    replacement: select_bulan
                }];
                // var url         = urlTemplate.replace('kategoriid', kategori);
                replacements.forEach(function(replacement) {
                    url = urlTemplate.replace(replacement.pattern, replacement.replacement);
                });
                window.location.href = url;

                $("#modal_export").modal('hide');
            }
        });
    </script>
    {{-- End JS Export Data --}}

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

    {{-- JS Date Picker --}}
    <script>
        $('input[data-name="due_date"]').datetimepicker({
            format: 'Y-m-d H:i:s',
            step: 15,
            autoclose: true
        });
    </script>
    {{-- End JS Date Picker --}}

    {{-- Date Picker --}}
    <script>
        $('input[data-name="select_bulan"]').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
    </script>
    {{-- End Date Picker --}}

@stop
