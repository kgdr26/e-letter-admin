@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stock Existing <span>| Today</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <button type="button"
                                    class="btn btn-primary">{{ number_format($stok_saat_ini, 0, ',', '.') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('materai.updateStok') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" placeholder="Entry Stock" class="form-control" id="jumlah_stok"
                                    name="jumlah_stok" required>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Transaksi Materai</h5>
                        <div>
                            <button type="button" class="btn btn-info mb-2 mt-3" data-name="export">
                                <i class="bi bi-file-earmark-spreadsheet"></i> Export
                            </button>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Add</th>
                                    <th>Minus</th>
                                    <th>Return</th>
                                    <th>Balancing</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction_history as $item)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['employee'] }}</td>
                                        <td>{{ $item['add'] }}</td>
                                        <td>{{ $item['minus'] }}</td>
                                        <td>{{ $item['return'] }}</td>
                                        <td>{{ number_format($item['balance'], 0, ',', '.') }}</td>
                                        <td>{{ $item['date'] }}</td>
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
