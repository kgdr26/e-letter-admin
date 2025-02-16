@extends('main')
@section('content')

    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span id="nameidentitas">Chart Employen</span>

                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-name="filter_realtime">Realtime</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#" data-name="filter_bulan">Bulan</a></li>
                                    <li><a class="dropdown-item" href="#" data-name="filter_karyawan">Karyawan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="chart"></div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Employe Loan</span>
                            <div>
                                <button type="button" class="btn btn-success" data-name="add_setting_bulan_thr">Setting
                                    Bulan THR</button>
                                <button type="button" class="btn btn-success" data-name="add">ADD Employe Loan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NAME</th>
                                        <th>NIK</th>
                                        <th>NOMINAL</th>
                                        <th class="text-center">JUMLAH CICILAN</th>
                                        <th>PEMBAYARAN PERBULAN</th>
                                        <th>START LOAN</th>
                                        <th>ENDING LOAN</th>
                                        <th class="text-center">ACTIONS</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($arr as $key => $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $val->name }}</td>
                                            <td>{{ $val->npk }}</td>
                                            <td>{{ 'Rp ' . number_format($val->nominal_loan, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $val->bulan_loan }} Bulan</td>
                                            <td>{{ 'Rp ' . number_format($val->loan_perbulan, 0, ',', '.') }}</td>
                                            <td>{{ convertToIndonesianMonth($val->start_bulan . '-01') }}</td>
                                            <td>{{ convertToIndonesianMonth($val->ending_bulan . '-01') }}</td>
                                            <td class="text-center">
                                                <a href=""><i class="bi bi-gift-fill fs-4"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
