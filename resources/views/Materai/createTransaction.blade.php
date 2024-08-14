    {{-- @extends('main')
    @section('content')

        <section class="section dashboard">
            <div class="row align-items-top">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="currentStock" class="form-label">Stok Materai Tersedia:</label>
                            <input type="text" id="currentStock" class="form-control" value="{{ $stock }}" readonly>
                        </div>

                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="employee" class="form-label">Nama Pegawai:</label>
                                <input type="text" name="employee" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah:</label>
                                <input type="number" name="quantity" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan:</label>
                                <input type="text" name="keterangan" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select name="status" class="form-select" required>
                                    <option value="Ambil Materai">Ambil Materai</option>
                                    <option value="Kembalikan Materai">Kembalikan Materai</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @stop --}}

    @extends('main')
    @section('content')
        <section class="section dashboard">
            <div class="row align-items-top">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi Materai</h5>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="currentStock" class="form-label">Stok Materai Tersedia:</label>
                            <input type="text" id="currentStock" class="form-control" value="{{ $currentStock }}"
                                readonly>
                        </div>

                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="employee" class="form-label">Nama Pegawai:</label>
                                <input type="text" name="employee" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah:</label>
                                <input type="number" name="quantity" class="form-control" required min="1">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan:</label>
                                <input type="text" name="keterangan" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select name="status" class="form-select" required>
                                    <option value="Ambil Materai">Ambil Materai</option>
                                    <option value="Kembalikan Materai">Kembalikan Materai</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @stop
