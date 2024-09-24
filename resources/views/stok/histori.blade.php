@extends('main')
@section('content')
    <h2>Histori Stok Berjalan</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Employee</th>
                <th>Add</th>
                <th>Minus</th>
                <th>Return</th>
                <th>Balancing Stok</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histori as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->user_finance ?? $data->user_requester }}</td>
                    <td>{{ $data->jumlah_stok }}</td>
                    <td>{{ $data->jumlah_ambil }}</td>
                    <td>{{ $data->jumlah_kembali }}</td>
                    <td>{{ $data->balancing }}</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
