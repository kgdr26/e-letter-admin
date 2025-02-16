@extends('main')
@section('content')

    <section class="section dashboard">
        <div class="row align-items-top">

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Bagian untuk menampilkan stok ketersediaan (sum stok) --}}
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="hstack gap-3 mt-4">
                            <div class="card-title">Stock Existing</div>
                            <div class="bg-light border ms-auto">Today</div>
                            <div class="vr"></div>
                            <div class="btn btn-primary border">{{ number_format($total_stok, 0, ',', '.') }}</div>
                        </div>

                        {{-- Form Entry Add Stok Materai (untuk finance) --}}
                        {{-- <h5 class="card-title mt-4">Form Entry Add Stok Materai</h5> --}}
                        {{-- <form action="{{ route('stok.add') }}" method="POST">
                            @csrf
                            <input type="number" name="jumlah_stok" placeholder="Entry Stock" required>
                            <button type="submit" class="btn btn-success">Add Stock</button>
                        </form> --}}

                        @php
                            $allowedRoleIds = [1, 4, 11]; // User finance role IDs
                        @endphp
                        @if (in_array(Auth::user()->role_id, $allowedRoleIds))
                            <h5 class="card-title mt-4">Form Entry Add Stok Materai</h5>
                            <form id="form-add-stok" action="{{ route('stok.add') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <!-- Gunakan type="text" untuk memanipulasi angka dengan format ribuan -->
                                    <input type="text" name="jumlah_stok_display" id="jumlah_stok_display"
                                        class="form-control" placeholder="Entry Stock" required>
                                    <!-- Ini adalah input hidden yang akan dikirim ke backend tanpa titik pemisah -->
                                    <input type="hidden" name="jumlah_stok" id="jumlah_stok">
                                    <button type="submit" class="btn btn-success" id="submit-add-stok">
                                        <i class="bi bi-emoji-laughing-fill"></i>
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-danger">
                                You do not have permission to add stock.
                            </div>
                        @endif

                        {{-- Form Entry Minus & Returned (untuk requester) --}}
                        <h5 class="card-title mt-4">Form Entry Minus & Returned</h5>
                        <form id="form-minus-return" action="{{ route('stok.minusReturn') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <!-- Input jumlah ambil dengan format ribuan (gunakan input hidden untuk jumlah sebenarnya) -->
                                <input type="text" id="jumlah_ambil_display" name="jumlah_ambil_display"
                                    placeholder="Minus" class="form-control" required>
                                <input type="hidden" id="jumlah_ambil" name="jumlah_ambil">

                                <!-- Input jumlah kembali dengan format ribuan (gunakan input hidden untuk jumlah sebenarnya) -->
                                <input type="text" id="jumlah_kembali_display" name="jumlah_kembali_display"
                                    placeholder="Return" class="form-control" required>
                                <input type="hidden" id="jumlah_kembali" name="jumlah_kembali">

                                <!-- Input keterangan wajib diisi -->
                                <input type="text" id="keterangan" name="keterangan" placeholder="Reason"
                                    class="form-control" required>

                                <button type="submit" class="btn btn-warning" id="submit-minus-return">
                                    <i class="bi bi-arrow-left"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <h6 class="ps-4 fw-bolder text-danger">*NB : Please Complete The Data</h6>
                </div>
            </div>


            {{-- Histori Stok Berjalan --}}
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stock History</h5>
                        <a href="{{ route('export-stock-history') }}" class="btn btn-success mb-4">Export to Excel</a>
                        <table id="stockHistoryTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-center">Employee</th>
                                    <th>Add</th>
                                    <th>Minus</th>
                                    <th>Return</th>
                                    <th class="text-center">Note</th>
                                    <th class="text-center">Balancing</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $remainingStock = 0; @endphp
                                @foreach ($history as $index => $entry)
                                    @php
                                        $remainingStock +=
                                            $entry->jumlah_stok - $entry->jumlah_ambil + $entry->jumlah_kembali;
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($entry->finance_name)
                                                {{ $entry->finance_name }} {{-- Nama user finance --}}
                                            @elseif($entry->requester_name)
                                                {{ $entry->requester_name }} {{-- Nama user requester --}}
                                            @else
                                                Unknown User
                                            @endif
                                        </td>
                                        <td>{{ $entry->jumlah_stok }}</td>
                                        <td>{{ $entry->jumlah_ambil }}</td>
                                        <td>{{ $entry->jumlah_kembali }}</td>
                                        <td>{{ $entry->keterangan }}</td>
                                        <td class="text-center">{{ $remainingStock }}</td>
                                        <td>{{ \Carbon\Carbon::parse($entry->created_at)->isoFormat('dddd, DD MMM YYYY HH:mm:ss') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function() {
            $('#stockHistoryTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                "searching": true,
                "ordering": true,
                "info": true,
                "paging": true
            });
        });
    </script>

    {{-- JS Form Add --}}
    <script>
        document.getElementById('jumlah_stok_display').addEventListener('input', function(e) {
            // Ambil nilai tanpa titik (untuk penghitungan)
            var value = this.value.replace(/\./g, '');

            // Pastikan input hanya berisi angka
            if (!isNaN(value) && value.length > 0) {
                // Format angka dengan pemisah ribuan
                this.value = parseInt(value).toLocaleString('id-ID');
                // Set nilai tanpa titik pada input hidden yang akan dikirim ke backend
                document.getElementById('jumlah_stok').value = value;
            } else {
                this.value = '';
                document.getElementById('jumlah_stok').value = '';
            }
        });

        // Pop-up konfirmasi
        document.getElementById('submit-add-stok').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form from submitting immediately
            // Validasi untuk reason agar tidak kosong
            const add = document.getElementById('jumlah_stok').value.trim();
            if (add === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Apa yang di Add..??',
                    text: 'Tolong dibiasakan untuk entry "Add"',
                });
                return;
            }
            Swal.fire({
                title: 'Apakah data sudah benar?',
                text: "Anda tidak dapat mengubah data setelah submit!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-add-stok').submit(); // Submit form if confirmed
                }
            });
        });
    </script>

    {{-- JS Form Minus Return --}}
    <script>
        // Fungsi untuk mengubah input menjadi format ribuan
        function formatNumber(inputDisplayId, inputHiddenId) {
            const inputDisplay = document.getElementById(inputDisplayId);
            const inputHidden = document.getElementById(inputHiddenId);

            inputDisplay.addEventListener('input', function(e) {
                // Ambil nilai tanpa titik
                var value = this.value.replace(/\./g, '');

                // Pastikan input hanya berisi angka
                if (!isNaN(value) && value.length > 0) {
                    // Format angka dengan pemisah ribuan
                    this.value = parseInt(value).toLocaleString('id-ID');
                    // Set nilai tanpa titik pada input hidden yang akan dikirim ke backend
                    inputHidden.value = value;
                } else {
                    this.value = '';
                    inputHidden.value = '';
                }
            });
        }

        // Terapkan fungsi formatNumber untuk field Minus dan Return
        formatNumber('jumlah_ambil_display', 'jumlah_ambil');
        formatNumber('jumlah_kembali_display', 'jumlah_kembali');

        // Kedua form input aktif pada awalnya
        const jumlahAmbilDisplay = document.getElementById('jumlah_ambil_display');
        const jumlahKembaliDisplay = document.getElementById('jumlah_kembali_display');

        // Jika form minus diisi, return menjadi disabled
        jumlahAmbilDisplay.addEventListener('input', function() {
            if (this.value !== '') {
                jumlahKembaliDisplay.disabled = true; // Disable return jika minus diisi
            } else {
                jumlahKembaliDisplay.disabled = false; // Enable return jika minus dikosongkan
            }
        });

        // Jika form return diisi, minus menjadi disabled
        jumlahKembaliDisplay.addEventListener('input', function() {
            if (this.value !== '') {
                jumlahAmbilDisplay.disabled = true; // Disable minus jika return diisi
            } else {
                jumlahAmbilDisplay.disabled = false; // Enable minus jika return dikosongkan
            }
        });

        // Pop-up konfirmasi untuk form minus & return
        document.getElementById('submit-minus-return').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form from submitting immediately

            // Validasi untuk reason agar tidak kosong
            const reason = document.getElementById('keterangan').value.trim();
            if (reason === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Sertakan "Reason" ya..!',
                    text: 'Tolong dibiasakan untuk memberi "Reason"',
                });
                return;
            }

            Swal.fire({
                title: 'Apakah data sudah benar?',
                text: "Anda tidak dapat mengubah data setelah submit!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-minus-return').submit(); // Submit form if confirmed
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jumlahAmbil = document.getElementById('jumlah_ambil');
            const jumlahKembali = document.getElementById('jumlah_kembali');
            const keterangan = document.getElementById('keterangan');

            // Ketika field Minus diisi
            jumlahAmbil.addEventListener('input', function() {
                if (this.value.length > 0) {
                    // Disable field Return
                    jumlahKembali.disabled = true;
                    // Enable Reason
                    keterangan.disabled = false;
                } else {
                    // Enable field Return jika Minus kosong
                    jumlahKembali.disabled = false;
                }
            });

            // Ketika field Return diisi
            jumlahKembali.addEventListener('input', function() {
                if (this.value.length > 0) {
                    // Disable field Minus
                    jumlahAmbil.disabled = true;
                    // Enable Reason
                    keterangan.disabled = false;
                } else {
                    // Enable field Minus jika Return kosong
                    jumlahAmbil.disabled = false;
                }
            });
        });
    </script>


    {{-- Json SweetALlertTesting --}}
    {{-- <script>
        document.getElementById('id="form-minus-return"').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // To make it an AJAX request
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        swal({
                            title: "Success!",
                            text: data.message,
                            icon: "success",
                            button: "Okay",
                        }).then(() => {
                            window.location.href =
                            '{{ route('stok.index') }}'; // Reload the page on success
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Okay",
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    swal({
                        title: "Error!",
                        text: "Terjadi kesalahan. Silakan coba lagi.",
                        icon: "error",
                        button: "Okay",
                    });
                });
        });
    </script> --}}



@stop
