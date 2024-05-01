@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Chart Employen</span>
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
                            <button type="button" class="btn btn-success" data-name="add">ADD Employe Loan</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAME</th>
                                        <th>NIK</th>
                                        <th>NOMINAL</th>
                                        <th>JUMLAH BULAN</th>
                                        <th>PEMBAYARAN PERBULAN</th>
                                        <th>START BULAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($arr as $key => $val)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$val->name}}</td>
                                            <td>{{$val->npk}}</td>
                                            <td>{{'Rp ' . number_format($val->nominal_loan, 0, ',', '.')}}</td>
                                            <td>{{$val->bulan_loan}} Bulan</td>
                                            <td>{{'Rp ' . number_format($val->loan_perbulan, 0, ',', '.')}}</td>
                                            <td>{{convertToIndonesianMonth($val->start_bulan.'-01')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Add --}}
    <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add LOAN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-style">
                        <div class="mb-3">
                            <label for="" class="form-label">Select Karyawan</label>
                            <select name="" id="" class="form-select select-2-add" data-name="id_karyawan">
                                <option value="">-- Select Karyawan --</option>
                                @foreach($listkarayawan as $key => $val)
                                    <option value="{{$val->id}}">{{$val->npk}} - {{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nominal</label>
                            <input type="text" class="form-control" id="" placeholder="" data-name="nominal">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jumlah Bulan</label>
                            <input type="number" class="form-control" id="" placeholder="" data-name="bulan_loan">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Pembayaran Perbulan</label>
                            <input type="text" class="form-control" id="" placeholder="" data-name="pembayaran_perbulan" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Start Bulan</label>
                            <input type="text" class="form-control" id="" placeholder="" data-name="start_bulan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-name="save_add">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal ADD --}}

    <script>
        $(document).ready(function() {
            setTimeout(updatechart);
        });
    </script>

    {{-- Js Add --}}
    <script>
        $(document).on("click", "[data-name='add']", function(e) {
            $("[data-name='nominal']").val('');
            $("[data-name='bulan_loan']").val('');
            $("[data-name='show_pembayaran_perbulan']").val('');
            $("[data-name='pembayaran_perbulan']").val('');
            $("[data-name='id_karyawan']").val('').trigger("change");
            $("#modal_add").modal('show');
        });
        
        $(document).on("click", "[data-name='save_add']", function(e) {
            var id_karyawan     = $("[data-name='id_karyawan']").val();
            var nominal         = $("[data-name='nominal']").val();
            var nominal_loan    = nominal.replace(/[^\d]/g, '');
            var bulan_loan      = $("[data-name='bulan_loan']").val();
            var pembayaran_perbulan = $("[data-name='pembayaran_perbulan']").val();
            var loan_perbulan   = pembayaran_perbulan.replace(/[^\d]/g, '');
            var start_bulan     = $("[data-name='start_bulan']").val();
            var list_pembayaran = '[]';
            var is_active = 1;
            var update_by = "{!! $idn_user->id !!}";
            var table = "trx_employe_loan";

            var data = {
                id_karyawan: id_karyawan,
                nominal_loan: nominal_loan,
                bulan_loan: bulan_loan,
                loan_perbulan: loan_perbulan,
                start_bulan: start_bulan,
                list_pembayaran: list_pembayaran,
                is_active: is_active,
                update_by: update_by,
            };

            if (id_karyawan === '' || nominal_loan === '' || bulan_loan === '' || loan_perbulan === '' || start_bulan === '' || list_pembayaran === '') {
                Swal.fire({
                    position: 'center',
                    title: 'Form is empty!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('actionadd') }}",
                    data: {
                        table: table,
                        data: data
                    },
                    cache: false,
                    success: function(data) {
                        // console.log(data);
                        $("#modal_add").modal('hide');
                        Swal.fire({
                            position: 'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            location.reload();
                        })
                    },
                    error: function(data) {
                        Swal.fire({
                            position: 'center',
                            title: 'Action Not Valid!',
                            icon: 'warning',
                            showConfirmButton: true,
                            // timer: 1500
                        }).then((data) => {
                            // location.reload();
                        })
                    }
                });
            }

        });
    </script>
    {{-- End JS Data --}}

    {{-- Chart Employen --}}
    <script>
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },

            title: {
                text: '',
            },
            subtitle: {
                text: ''
            },
            credits: {
                enabled: false
            },

            xAxis: {
                categories: []
            },

            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: ''
                }
            },

            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>Rp. {point.y}</b><br/>',
                shared: true
            },

            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },

            series: [{
                name: 'Dibayar',
                data: [],
                stack: 'Employen'
            }, {
                name: 'Terbayarkan',
                data: [],
                stack: 'Employen'
            },{
                name: 'Sisa',
                data: [],
                stack: 'Employen'
            }]
        });

        var timeouts = {};
        function updatechart(type, bulan, idkry) {
            var type    = type;
            var bulan   = bulan;
            var idkry   = idkry;
            var chart = $('#chart').highcharts();
            $.ajax({
                url: "{{route('dataemploye')}}",
                type: "POST",
                data: {
                    type: type, bulan:bulan, idkry:idkry
                },
                dataType: 'json',
                global: false,
                cache: false,
                success: function(data) {
                    console.log(data);
                    chart.xAxis[0].update({
                        categories: data.categories
                    });
                    chart.series[0].setData(data.dibayar);
                    chart.series[1].setData(data.terbayarkan);
                    chart.series[2].setData(data.sisa);
                    
                    // Check if start and end are undefined
                    if (type === undefined) {
                        // If timeout for this id already exists, clear it
                        if (timeouts['chart']) {
                            clearTimeout(timeouts['chart']);
                        }
                        // Set a new timeout for this id
                        timeouts['chart'] = setTimeout(function () {
                            updatechart();
                        }, 1000); // call updateChart every 3 seconds
                    }
                },
                complete: function(data) {
                    if (type !== undefined ) {
                        clearTimeout(timeouts['chart']);
                    }
                }
            });
        }
    </script>
    {{-- Chart Employen --}}

    {{-- JS Konvert To rupiah --}}
    <script>
        $(document).ready(function(){
            $("[data-name='nominal']").keyup(function(event){
                // Mendapatkan nilai yang dimasukkan oleh pengguna
                var inputVal = $(this).val();
                
                // Menghilangkan semua karakter selain angka
                inputVal = inputVal.replace(/[^\d]/g, '');
        
                // Mengonversi ke format Rupiah
                var formattedVal = formatRupiah(inputVal);
                
                // Menetapkan nilai yang telah diubah kembali ke input
                $(this).val(formattedVal);
            });
            
            // Fungsi untuk mengonversi ke format Rupiah
            function formatRupiah(angka){
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return 'Rp ' + ribuan;
            }
        });

        $("[data-name='bulan_loan']").keyup(function(event){
            // Mendapatkan nilai yang dimasukkan oleh pengguna
            var inputVal = $("[data-name='nominal']").val();
            var bulanloan = $(this).val();
            
            // Menghapus simbol 'Rp' dan titik dari nilai
            inputVal = inputVal.replace(/[^\d]/g, '');
            
            // Mengonversi nilai string menjadi integer
            var intValue = parseInt(inputVal);

            // Pembagian

            var pembagian   = Math.round(intValue/bulanloan);
            var reverse = pembagian.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            
            // Menetapkan nilai integer ke dalam input tersembunyi
            $("[data-name='pembayaran_perbulan'").val('Rp ' +ribuan);
        });
        </script>
    {{-- End JS Konvert To Rupiah --}}

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

    {{-- Select2 --}}
    <script>
        $(".select-2-add").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_add")
        });

        $(".select-2-edit").select2({
            allowClear: false,
            width: '100%',
            dropdownParent: $("#modal_edit")
        });
    </script>
    {{-- End Select2 --}}

    <script>
        $('input[data-name="start_bulan"]').datepicker({
            format: "yyyy-mm",
            viewMode: "months", 
                minViewMode: "months",
            autoclose: true
        });
    </script>

@stop