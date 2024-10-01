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
            <div class="col-lg-5">
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
                            <form action="{{ route('stok.add') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="number" name="jumlah_stok" class="form-control"placeholder="Entry Stock"
                                        required>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-emoji-laughing-fill"></i>
                                    </button>
                                </div>
                            </form>
                            <script>
                                document.getElementById('jumlah_stok').addEventListener('input', function(e) {
                                    // Remove any character that isn't a digit or comma
                                    this.value = this.value.replace(/[^\d,]/g, '');

                                    // Replace comma with dot for correct number parsing
                                    var numValue = parseFloat(this.value.replace(',', '.'));

                                    // Format the number with thousand separators
                                    if (!isNaN(numValue)) {
                                        this.value = numValue.toLocaleString('id-ID');
                                    }
                                });
                            </script>
                        @else
                            <div class="alert alert-danger">
                                You do not have permission to add stock.
                            </div>
                        @endif

                        {{-- Form Entry Minus & Returned (untuk requester) --}}
                        <h5 class="card-title mt-4">Form Entry Minus & Returned</h5>
                        <form action="{{ route('stok.minusReturn') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" id="jumlah_ambil" name="jumlah_ambil" placeholder="Minus"
                                    class="form-control" required>
                                <input type="number" id="jumlah_kembali" name="jumlah_kembali" placeholder="Return"
                                    class="form-control" required>
                                <input type="text" id="keterangan" name="keterangan" placeholder="Reason"
                                    class="form-control">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-arrow-left"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <h6 class="ps-4 fw-bolder text-danger">*NB : Please Complete The Data</h6>
                </div>
            </div>
            <!-- Grafik Highcharts di bawah card stok existing -->
            {{-- <div class="col-lg-7 mb-4">
                <div id="container" style="height:410px;"></div>
            </div> --}}
            {{-- Histori Stok Berjalan --}}
            <section class="section">
                <div class="row align-items-top">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Stock History</h5>
                                <a href="{{ route('export-stock-history') }}" class="btn btn-success mb-4">Export to
                                    Excel</a>
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
        </div>
    </section>


    <script>
        $(document).ready(function() {
            $('#stockHistoryTable').DataTable({
                "pageLength": 100,
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


    {{-- <div id="container" style="width:100%; height:400px;"></div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script>
        // Data stok dari database
        var addData = @json(array_values($addData));
        var minusData = @json(array_values($minusData));
        var returnData = @json(array_values($returnData));

        // Grafik stok
        Highcharts.chart('container', {
            chart: {
                type: 'column' // Tipe grafik kolom
            },
            title: {
                text: 'Inventory Stok Materai per Bulan',
                align: 'left'
            },
            subtitle: {
                text: 'Data stok yang di-add, minus, dan return per bulan',
                align: 'left'
            },
            xAxis: {
                categories: [
                    'January', 'February', 'March', 'April', 'May', 'June', 'July',
                    'August', 'September', 'October', 'November', 'December'
                ],
                crosshair: true,
                title: {
                    text: 'Bulan'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Stok'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Add',
                data: addData // Data stok yang di-add dari database
            }, {
                name: 'Minus',
                data: minusData // Data stok yang di-minus dari database
            }, {
                name: 'Return',
                data: returnData // Data stok yang di-return dari database
            }]
        });
    </script> --}}

@stop
