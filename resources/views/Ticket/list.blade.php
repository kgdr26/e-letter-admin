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
                                        <th class="text-center small">NO</th>
                                        <th class="text-center small">ID TICKET</th>
                                        <th class="text-center small">USER.REQ</th>
                                        <th class="text-center small">CREATE ON</th>
                                        <th class="text-center small">TITLE REQUEST</th>
                                        <th class="text-center small">DESCRIPTION</th>
                                        <th class="text-center small">ATTACHMENT</th>
                                        <th class="text-center small">DUE DATE</th>
                                        <th class="text-center small">MODIFIET ON</th>
                                        <th class="text-center small">STATUS</th>
                                        <th class="text-center small">REMARK</th>
                                        <th class="text-center small">PIC</th>
                                        <th class="text-center small">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="text-midle">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($arr as $key => $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="small">{{ $val->id_ticket }}</td>
                                            <td class="small">{{ $val->usr_name }}</td>
                                            <td class="small">
                                                {{ \Carbon\Carbon::parse($val->date_create)->isoFormat('DD MMM YYYY HH:mm:ss') }}
                                            </td>
                                            <td class="small">{{ $val->summary }}</td>
                                            <td class="small">{{ $val->description }}</td>
                                            <td class="text-center small">
                                                <button type="button" class="btn btn-info btn-sm"
                                                    data-name="show_file_button" data-item="{{ $val->file_name }}">
                                                    <i class="bi bi-filetype-pdf"></i>
                                                </button>
                                            </td>
                                            <td class="small">
                                                @if ($val->due_date == null)
                                                    -
                                                @else
                                                    {{ \Carbon\Carbon::parse($val->due_date)->isoFormat('DD MMM YYYY HH:mm:ss') }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($val->last_update)->isoFormat('DD MMM YYYY HH:mm:ss') }}
                                            </td>
                                            <td class="text-center small">
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
                                                        $class_st = 'warning';
                                                        $persen = '100';
                                                    @endphp
                                                @elseif ($val->status == 4)
                                                    @php
                                                        $class_st = 'success';
                                                        $persen = '50';
                                                    @endphp
                                                @elseif ($val->status == 5)
                                                    @php
                                                        $class_st = 'success';
                                                        $persen = '80';
                                                    @endphp
                                                @elseif ($val->status == 6)
                                                    @php
                                                        $class_st = 'success';
                                                        $persen = '100';
                                                    @endphp
                                                @elseif ($val->status == 7)
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
                                            <td class="small">{{ $val->note }}</td>
                                            <td class="small">
                                                @if ($val->status >= 3)
                                                    {{ $val->pic_name }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center text-nowrap small">
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
                                    <select class="form-control select-2-add" id="departement" data-name="departement">
                                        <option value="">Pilih Departemen</option>
                                        @foreach ($dep as $key => $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
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

                                <div class="mb-3">
                                    <label for="" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="add_file"
                                        placeholder=""data-name="file_name">
                                    <input type="hidden" id="file_name" data-name="name_file">
                                    <input type="hidden" data-name="ukuran">
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
                                    <select class="form-control select-2-edit" id=""
                                        data-name="edit_departement">
                                        <option value="">Pilih Departemen</option>
                                        @foreach ($dep as $key => $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Departement</label>
                                    <input type="text" class="form-control" id="" placeholder="Departement"
                                        data-name="">
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

                                <div class="mb-3">
                                    <label for="" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="edit_file" placeholder=""
                                        data-name="edit_file_name">
                                    <input type="hidden" id="edit_file_name" data-name="edit_name_file">
                                    <input type="hidden" data-name="edit_ukuran">
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
                                    <select class="form-control select-2-edit" id="" data-name="upd_departement" disabled>
                                        <option value="">Pilih Departemen</option>
                                        @foreach ($dep as $key => $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
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
                                </div>

                                <div class="mb-3" id="duedate" style="display: none">
                                    <label for="" class="form-label">Due Date</label>
                                    <input type="text" class="form-control" id="" placeholder="Due Date" data-name="due_date">
                                </div>

                                <div class="mb-3" id="shownote" style="display: none">
                                    <label for="" class="form-label">Noted</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="5" data-name="note" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-name="reject_update">Reject</button>
                    <div id="thp1">
                        <button type="button" class="btn btn-primary" data-name="save_update" data-item="4">Taket A Ticket</button>
                        <button type="button" class="btn btn-warning" data-name="save_update" data-item="2">Request Approve</button>
                    </div>
                    <button type="button" class="btn btn-primary" data-name="save_update" id="thp2" data-item="3">Approve</button>
                    <button type="button" class="btn btn-primary" data-name="save_update" id="thp3" data-item="4">Approve</button>
                    <button type="button" class="btn btn-primary" data-name="save_update" id="thp4" data-item="5">Approve</button>
                    <button type="button" class="btn btn-primary" data-name="save_update" id="thp5" data-item="6">Approve</button>
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

    {{-- Modal Show --}}
    <div class="modal fade" id="modal_show_file" tabindex="-1">
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
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Show --}}

    {{-- JS Add Data --}}
    <script>
        $(document).on("click", "[data-name='add']", function(e) {
            $("[data-name='departement']").val('');
            $("[data-name='summary']").val('');
            $("[data-name='description']").val('');
            $("[data-name='name_file']").val('');

            $("#modal_add").modal('show');
        });

        $(document).on("click", "[data-name='save_add']", function(e) {
            var departement = $("[data-name='departement']").val();
            var summary = $("[data-name='summary']").val();
            var description = $("[data-name='description']").val();
            var file_name = $("[data-name='name_file']").val();

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
                        description: description,
                        file_name: file_name
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
                    $("[data-name='edit_departement']").val(data['data'].departement).trigger("change");
                    $("[data-name='edit_summary']").val(data['data'].summary);
                    $("[data-name='edit_description']").val(data['data'].description);
                    $("[data-name='edit_name_file']").val(data['data'].file_name);

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
            var file_name = $("[data-name='edit_name_file']").val();
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
                        file_name: file_name,
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
                    $("[data-name='upd_departement']").val(data.departement).trigger("change");
                    $("[data-name='upd_summary']").val(data.summary);
                    $("[data-name='upd_description']").val(data.description);
                    $("[data-name='upd_step']").val(step);
                    $("[data-name='due_date']").val(data.due_date);
                    $("[data-name='note']").val(data.note);

                    if (data.status === 1) {
                        $("#shownote").show();
                        $("[data-name='note']").prop('disabled', false);
                        $("#duedate").hide();
                        $("#thp1").show();
                        $("#thp2").hide();
                        $("#thp3").hide();
                        $("#thp4").hide();
                        $("#thp5").hide();
                    } else if (data.status === 2) {
                        $("#shownote").show();
                        $("[data-name='note']").prop('disabled', true);
                        $("#duedate").hide();
                        $("#thp1").hide();
                        $("#thp2").show();
                        $("#thp3").hide();
                        $("#thp4").hide();
                        $("#thp5").hide();
                    } else if (data.status === 3) {
                        $("#shownote").show();
                        $("[data-name='note']").prop('disabled', true);
                        $("#duedate").hide();
                        $("#thp1").hide();
                        $("#thp2").hide();
                        $("#thp3").show();
                        $("#thp4").hide();
                        $("#thp5").hide();
                    } else if (data.status === 4) {
                        $("#shownote").show();
                        $("[data-name='note']").prop('disabled', false);
                        $("#duedate").show();
                        $("#thp1").hide();
                        $("#thp2").hide();
                        $("#thp3").hide();
                        $("#thp4").show();
                        $("#thp5").hide();
                    } else if (data.status === 5) {
                        $("#shownote").show();
                        $("[data-name='note']").prop('disabled', false);
                        $("#duedate").hide();
                        $("#thp1").hide();
                        $("#thp2").hide();
                        $("#thp3").hide();
                        $("#thp4").hide();
                        $("#thp5").show();
                    } else {
                        $("#shownote").hide();
                        $("#duedate").hide();
                        $("#thp1").hide();
                        $("#thp2").hide();
                        $("#thp3").hide();
                        $("#thp4").hide();
                        $("#thp5").hide();
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
            var step = $(this).attr("data-item");
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
            var step = 7;
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

    {{-- JS Show file --}}
    <script>
        $(document).on("click", "[data-name='show_file_button']", function(e) {
            var file_name = $(this).attr("data-item");
            var to_dept = $(this).attr("data-item");
            var file = "{{ asset('assets/file') }}/" + file_name;
            $('#show_file').attr('src', file);
            $("#modal_show_file").modal('show');
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
