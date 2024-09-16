@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Notifikasi Sukses -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Notifikasi Error -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h5 class="card-title">Transaksi Materai</h5>
                    <div class="#">
                        <label> Stock Materai</label>
                        <br>
                        <button type="button"
                            class="btn btn-primary mb-2 mt-2">{{ number_format($stok_saat_ini, 0, ',', '.') }}</button>
                    </div>
                    <hr>
                    <form action="{{ route('materai.ambil') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="jumlah_ambil">Jumlah Ambil</label>
                            <input type="number" class="form-control" id="jumlah_ambil" name="jumlah_ambil" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ambil Materai</button>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User Requester</th>
                                <th>Keterangan</th>
                                <th>Jumlah Ambil</th>
                                <th>Jumlah Kembali</th>
                                <th>Tanggal</th>
                                <th>inLine</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($materai as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->requester_name }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->jumlah_ambil }}</td>
                                    <td>{{ $item->jumlah_kembali }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <form method="POST"
                                            action="{{ route('kembalikan.materai', ['id' => $item->id]) }}">
                                            @csrf
                                            {{-- <input type="number" name="jumlah_kembali" class="form-control" min="1"
                                                max="{{ $item->jumlah_ambil - $item->jumlah_kembali }}" required>
                                            <button type="submit" class="btn btn-success">?</button> --}}
                                            <div class="input-group mb-3">
                                                <input type="number" name="jumlah_kembali" class="form-control"
                                                    min="1" max="{{ $item->jumlah_ambil - $item->jumlah_kembali }}"
                                                    required placeholder="Jumlah Kembali">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-arrow-return-left"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        function getHistori() {
            fetch('{{ route('materai.histori') }}')
                .then(response => response.json())
                .then(data => {
                    // Update tabel histori dengan data yang diterima
                    console.log(data);
                });
        }

        // Panggil fungsi getHistori setiap 5 detik
        setInterval(getHistori, 5000);
    </script>
@stop
