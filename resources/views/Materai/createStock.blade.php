{{-- @extends('main')
@section('content')

    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-2"></h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('stock.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="stock" class="form-label">Jumlah Stok:</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <button type="button" class="btn btn-info mb-2 mt-3" data-name="export"><i
                                    class="bi bi-file-earmark-spreadsheet"></i>Export</button>
                        </div>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th style="width: 3%">No</th>
                                    <th class="text-center">Employee</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Necessity</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">On Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $transaction->employee }}</td>
                                        <td>{{ $transaction->quantity }}</td>
                                        <td>{{ $transaction->keterangan }}</td>
                                        <td>{{ $transaction->status }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
@stop --}}


@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <h5>Total Stok Materai: {{ $totalStock }}</h5>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Materai</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materais as $materai)
                                    <tr>
                                        <td>{{ $materai->name }}</td>
                                        <td>{{ $materai->stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <h5 class="card-title">Tambah Stok Materai</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="currentStock" class="form-label">Stok Materai Saat Ini:</label>
                            <input type="text" id="currentStock" class="form-control" value="{{ $currentStock }}"
                                readonly>
                        </div>

                        <form action="{{ route('stock.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Materai:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Jumlah Stok yang Ditambahkan:</label>
                                <input type="number" name="stock" class="form-control" required min="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Transaksi Materai</h5>
                        <div>
                            <a href="{{ route('transaction.create') }}" class="btn btn-primary mb-2 mt-3">
                                <i class="bi bi-plus-circle"></i> Transaksi Baru
                            </a>
                            <button type="button" class="btn btn-info mb-2 mt-3" data-name="export">
                                <i class="bi bi-file-earmark-spreadsheet"></i> Export
                            </button>
                        </div>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th style="width: 3%">No</th>
                                    <th class="text-center">Employee</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $index => $transaction)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $transaction->employee }}</td>
                                        <td>{{ $transaction->quantity }}</td>
                                        <td>{{ $transaction->keterangan }}</td>
                                        <td>{{ $transaction->status }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
