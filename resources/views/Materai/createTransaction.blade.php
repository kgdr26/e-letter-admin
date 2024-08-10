    @extends('main')
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
                            <strong>Jumlah Stok Materai: </strong> {{ $materai->stock }} <!-- Menampilkan stok materai -->
                        </div>
                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipe Transaksi:</label>
                                <select name="type" class="form-select" required>
                                    <option value="out">Ambil Materai</option>
                                    <option value="in">Kembalikan Materai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah:</label>
                                <input type="number" name="quantity" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @stop
