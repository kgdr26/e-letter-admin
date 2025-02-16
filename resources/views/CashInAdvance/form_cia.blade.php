@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success bg-green-200 text-dark p-3 m-3 text-center shadow-lg">
                    {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error bg-red-200 text-dark p-3 m-3 text-center shadow-lg">{{ session('error') }}
                </div>
            @endif
            <div class="card-body mt-3">
                @include('CashInAdvance.navtab')
                <div class="tab-content pt-2 mt-3">
                    <div class="tab-pane fade show active">
                        <form method="POST" action="{{ route('cia.store') }}">
                            @csrf
                            <div class="row d-flex align-items-stretch">
                                <div class="col-3">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <span class="d-flex justify-content-end fw-bold">Form Cash In Advance</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="date_create" class="form-label">Date</label>
                                                <input type="text" name="date_create" class="form-control"
                                                    value="{{ date('Y-m-d') }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="requester" class="form-label">Requester</label>
                                                <input type="text" class="form-control" value="{{ $idn_user->name }}"
                                                    disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="necessity" class="form-label">Necessity</label>
                                                <textarea name="necessity" class="form-control" placeholder="Necessity"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Amount</label>
                                                <input type="text" name="amount" class="form-control" id="amount"
                                                    onkeyup="formatRupiah(this)" placeholder="Rp 0"
                                                    value="{{ isset($cia) ? 'Rp ' . number_format($cia->amount, 0, ',', '.') : '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="qty" class="form-label">Qty</label>
                                                <input type="number" name="qty" class="form-control" placeholder="Qty"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="unit" class="form-label">Unit</label>
                                                <select name="unit" class="form-select" required>
                                                    <option value="">Pilih Unit</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Box">Box</option>
                                                    <option value="Pack">Pack</option>
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-3">Submit</button>
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- List Section -->
                                <div class="col-9">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <span class="d-flex justify-content-end fw-bold">List Cash In Advance</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive mt-3">
                                                <table class="table" id="ciaListTable"
                                                    class="table table-striped table-bordered table-hover">
                                                    <thead class="text-primary-emphasis bg-primary-subtle">
                                                        <tr class="text-center">
                                                            <th>NO</th>
                                                            <th>NAME</th>
                                                            <th>NO. CIA</th>
                                                            <th>CREATE ON</th>
                                                            <th>NECESSITY</th>
                                                            <th>AMOUNT</th>
                                                            <th>QTY</th>
                                                            <th>UNIT</th>
                                                            <th>STATUS</th>
                                                            <th>UPDATED AT</th>
                                                            <th>ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($cia_list as $index => $cia)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $cia->user_name }}</td>
                                                                <td class="text-center fw-bold text-primary">
                                                                    {{ $cia->no_cia }}
                                                                </td>
                                                                <td class="text-center">{{ $cia->date_create }}</td>
                                                                <td>{{ $cia->necessity }}</td>
                                                                <td class="text-center">Rp.
                                                                    {{ number_format($cia->amount, 0, ',', '.') }}</td>
                                                                <td class="text-center">{{ $cia->qty }}</td>
                                                                <td class="text-center">{{ $cia->unit }}</td>
                                                                <td class="text-center">
                                                                    @switch($cia->status)
                                                                        @case(1)
                                                                            <button class="btn btn-secondary btn-sm">Draft</button>
                                                                        @break

                                                                        @case(2)
                                                                            <button
                                                                                class="btn btn-primary btn-sm">Dept-Approve</button>
                                                                        @break

                                                                        @case(3)
                                                                            <button class="btn btn-info btn-sm">Approved by
                                                                                Finance</button>
                                                                        @break

                                                                        @case(4)
                                                                            <button class="btn btn-warning btn-sm">Prepaid
                                                                                Process</button>
                                                                        @break

                                                                        @case(5)
                                                                            <button class="btn btn-success btn-sm">Paid</button>
                                                                        @break

                                                                        @case(6)
                                                                            <button class="btn btn-warning btn-sm">Settlement in
                                                                                Process</button>
                                                                        @break

                                                                        @case(7)
                                                                            <button class="btn btn-success btn-sm">Approved
                                                                                Settlement</button>
                                                                        @break

                                                                        @case(8)
                                                                            <button class="btn btn-success btn-sm">Settlement
                                                                                Paid</button>
                                                                        @break

                                                                        @case(9)
                                                                            <button class="btn btn-dark btn-sm">Finished
                                                                                CIA</button>
                                                                        @break

                                                                        @case(10)
                                                                            <button class="btn btn-dark btn-sm">Rejected</button>
                                                                        @break

                                                                        @default
                                                                            <button
                                                                                class="btn btn-secondary btn-sm">Unknown</button>
                                                                    @endswitch
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($cia->last_update)->isoFormat('DD-MM-YY HH:mm') }}
                                                                </td>
                                                                <!-- Terakhir diperbarui -->
                                                                <td>
                                                                    <!-- Action: Edit / Delete etc -->
                                                                    {{-- <a href="{{ route('cia.edit', $cia->id) }}"
                                                                        class="btn btn-sm btn-warning">
                                                                        <i class="bx bxs-edit"></i>
                                                                    </a> --}}
                                                                    <a href="#" class="btn btn-sm btn-warning"
                                                                        data-name="edit" data-item="{{ $cia->id }}">
                                                                        <i class="bx bxs-edit"></i>
                                                                    </a>
                                                                    <a href="#" class="btn btn-sm btn-danger"
                                                                        data-name="delete"
                                                                        data-item="{{ $cia->id }}">
                                                                        <i class="bx bxs-x-square"></i>
                                                                    </a>
                                                                    <a href="{{ route('cia.print', $cia->id) }}"
                                                                        target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="bx bxs-printer"></i>
                                                                    </a>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <style>
        .modal-header {
            background-color: #007bff;
            /* Warna biru */
            color: #ffffff;
            border-bottom: 2px solid #0056b3;
            /* Biru lebih gelap */
        }

        .modal-title {
            font-weight: bold;
        }

        .btn-close {
            background-color: #ffffff;
            opacity: 0.8;
        }

        .btn-close:hover {
            opacity: 1;
            color: #ea00ff;
        }

        .dataTables_wrapper .dataTables_scrollHead thead th {
            background-color: #0056b3;
            color: white;
        }

        .table thead th {
            background-color: #0056b3;
            color: white;
            border: #007bff
                /* border-top: none; */
                /* border-radius: 5px; */
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 20px;
            padding: 5px 15px;
            width: 250px;
            box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 5px;
            padding: 5px;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #0056b3;
        }
    </style>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Menambahkan modal-dialog-centered agar modal muncul di tengah -->
            <div class="modal-content modal-lg">
                <form id="editForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Cash In Advance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" data-name="edit_id"> <!-- Field ID tersembunyi -->
                        <div class="mb-3">
                            <label for="edit_necessity" class="form-label">Necessity</label>
                            <textarea name="necessity" data-name="edit_necessity" class="form-control" placeholder="Necessity"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_amount" class="form-label">Amount</label>
                            <input type="text" name="amount" data-name="edit_amount" class="form-control"
                                placeholder="Rp 0">
                        </div>
                        <div class="mb-3">
                            <label for="edit_qty" class="form-label">Qty</label>
                            <input type="number" name="qty" data-name="edit_qty" class="form-control"
                                placeholder="Qty">
                        </div>
                        <div class="mb-3">
                            <label for="edit_unit" class="form-label">Unit</label>
                            <select name="unit" data-name="edit_unit" class="form-select">
                                <option value="Pcs">Pcs</option>
                                <option value="Box">Box</option>
                                <option value="Pack">Pack</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-name="save_edit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#ciaListTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                "searching": true,
                "ordering": true,
                "info": true,
                "paging": true,
                "responsive": true, // Tambahkan untuk membuat tabel lebih responsif
                "language": {
                    "lengthMenu": "Show _MENU_ Entry",
                    "zeroRecords": "---- Data Not Found ----",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "No Entries",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "search": "<i class='fa fa-search'></i>", // Ganti dengan ikon search
                    "paginate": {
                        "Previous": "<i class='fa fa-chevron-left'></i>", // Ganti teks dengan ikon
                        "Next": "<i class='fa fa-chevron-right'></i>" // Ganti teks dengan ikon
                    }
                },
                "dom": '<"top"lf>t<"bottom"ip><"clear">', // Atur posisi filter dan pagination
                "initComplete": function() {
                    // Style untuk custom placeholder
                    $('.dataTables_filter input').addClass('form-control').attr('placeholder',
                        'Search');
                }
            });
        });
    </script>

    <script>
        function formatRupiah(element) {
            let value = element.value;
            value = value.replace(/[^,\d]/g, '').toString(); // Hanya mengizinkan angka
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            element.value = 'Rp ' + rupiah; // Set nilai dengan format Rp dan titik
        }
    </script>

    <script>
        $(document).on("click", "[data-name='edit']", function(e) {
            var id = $(this).attr("data-item"); // Mendapatkan ID item yang akan di-edit
            var table = 'trx_cia'; // Nama tabel yang sesuai dengan aplikasi CIA
            var field = 'id'; // Field yang digunakan untuk identifikasi item

            // AJAX request untuk mengambil data dari server
            $.ajax({
                type: "POST",
                url: "{{ route('actionshowdata') }}", // Route untuk mengambil data dari server
                data: {
                    id: id,
                    table: table,
                    field: field
                },
                cache: false,
                success: function(data) {
                    // Memastikan data yang didapat dari server diisi ke dalam form modal
                    $("[data-name='edit_id']").val(data['data'].id); // Mengisi field ID
                    $("[data-name='edit_necessity']").val(data['data']
                        .necessity); // Mengisi field necessity
                    $("[data-name='edit_amount']").val(data['data'].amount); // Mengisi field amount
                    $("[data-name='edit_qty']").val(data['data'].qty); // Mengisi field qty
                    $("[data-name='edit_unit']").val(data['data'].unit).trigger(
                        "change"); // Mengisi field unit dan memicu change event pada dropdown

                    // Tampilkan modal setelah data diisi
                    $("#editModal").modal('show');
                },
                error: function(xhr) {
                    // Jika ada kesalahan, tampilkan pesan error
                    Swal.fire({
                        position: 'center',
                        title: 'Failed to load data!',
                        icon: 'warning',
                        showConfirmButton: true
                    });
                    console.log(xhr.responseText); // Untuk debugging
                }
            });
        });
    </script>

    <script>
        $(document).on("click", "[data-name='save_edit']", function(e) {
            e.preventDefault(); // Mencegah submit form default

            // Mengambil data dari form modal
            var necessity = $("[data-name='edit_necessity']").val();
            var amount = $("[data-name='edit_amount']").val();
            var qty = $("[data-name='edit_qty']").val();
            var unit = $("[data-name='edit_unit']").val();
            var id = $("[data-name='edit_id']").val(); // Mengambil ID dari item yang di-edit

            // Data yang dikirim ke server
            var dats = {
                id: id,
                necessity: necessity,
                amount: amount,
                qty: qty,
                unit: unit
            };

            // Validasi apakah semua field telah diisi
            if (necessity === '' || amount === '' || qty === '' || unit === '') {
                Swal.fire({
                    position: 'center',
                    title: 'Form is empty!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                });
            } else {
                // Proses AJAX untuk update
                $.ajax({
                    type: "POST", // Pastikan metode yang benar
                    url: "{{ route('actioneditform') }}", // URL untuk route update
                    data: dats, // Data yang dikirim ke server
                    cache: false,
                    success: function(response) {
                        console.log(response); // Debug untuk melihat apakah update berhasil
                        Swal.fire({
                            position: 'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload(); // Reload halaman setelah sukses
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Debugging untuk melihat pesan error
                        Swal.fire({
                            position: 'center',
                            title: 'Update Failed!',
                            icon: 'warning',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    </script>


    <script>
        $(document).on("click", "[data-name='delete']", function(e) {
            e.preventDefault(); // Menghentikan perilaku default dari anchor

            var id = $(this).attr("data-item");
            var table = 'trx_cia'; // Ganti dengan tabel yang sesuai
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
                        url: "{{ route('actiondelete') }}", // Ubah dengan rute delete yang sesuai
                        data: {
                            id: id,
                            whr: whr,
                            table: table,
                            _token: '{{ csrf_token() }}' // Token CSRF untuk keamanan
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
                                location.reload(); // Reload halaman setelah berhasil
                            });
                        },
                        error: function(data) {
                            Swal.fire({
                                position: 'center',
                                title: 'Action Not Valid!',
                                icon: 'warning',
                                showConfirmButton: true,
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
