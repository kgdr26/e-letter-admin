@extends('main')
@section('content')

    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabs Menu</h5>

                    @include('Peminjaman.navtab')
                    {{-- <ul class="nav nav-tabs">
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsdash') }}" class="nav-link">Dashboard</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetscreate') }}" class="nav-link">Create Form</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsdephed') }}" class="nav-link">DepHead Approved</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsfirst') }}" class="nav-link">HRGA Approved</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetssecond') }}" class="nav-link">Security</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsdirector') }}" class="nav-link">Returned</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('assetsdata') }}" class="nav-link">Show Lending Asset</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dataasset') }}" class="nav-link">Data Asset</a>
                        </li>
                    </ul> --}}

                    <div class="tab-content pt-2 mt-3">
                        <div class="tab-pane fade show active">

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title" style="color: red;">Create Form Asset Lending</h5>

                                    <!-- Vertical Form -->
                                    <div class="row mb-3">
                                        <div class="col-6 mb-3">
                                            <label for="inputName" class="form-label">Name Employee</label>
                                            <input type="text" class="form-control form-control" id="inputName"
                                                placeholder="Name Employee" value="{{ $idn_user->name }}" disabled>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="inputNpk" class="form-label">NPK</label>
                                            <input type="text" class="form-control" id="inputNpk" placeholder="NPK"
                                                value="{{ $idn_user->npk }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="inputStartdate" class="form-label">Start Date</label>
                                            <input type="text" class="form-control" id="InputStartdate"
                                                data-name="date_start">
                                        </div>
                                        <div class="col-6">
                                            <label for="inputDuedate" class="form-label">Due Date</label>
                                            <input type="text" class="form-control" id="inputDuedate"
                                                data-name="date_end">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Type</label>
                                                    <select id="" class="form-select select2" data-name="data_type">
                                                        <option>Choose...</option>
                                                        <option value="1">Mobil</option>
                                                        <option value="2">Ruangan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label for="" class="form-label">Assets Name</label>
                                                    <select id="" class="form-select select2" data-name="data_asset">
                                                        <option>Choose...</option>
                                                        {{-- @foreach ($asset as $k => $v)
                                                            <option value="{{ $v->id }}">{{ $v->merk }} -
                                                                {{ $v->no_assets }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-3"
                                            <label for="" class="form-label">Necessity</label>
                                            <textarea name="" id="" cols="30" rows="5" class="form-control" data-name="necessity"></textarea>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary"
                                                data-name="save_data">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </div><!-- Vertical Form -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JS Create Data --}}
    <script>
        $(document).on("change", "[data-name='data_type']", function(e) {
            var kategori = $(this).val();
            var date_start = $("[data-name='date_start']").val();
            var date_end = $("[data-name='date_end']").val();

            var arrstart = moment(date_start);
            var arrend = moment(date_end);
            var arrtglloop = [];
            while (arrstart <= arrend) {
                arrtglloop.push(arrstart.format('YYYY-MM-DD HH'));
                arrstart.add(1, 'hours');
            }

            var arrtgl  = JSON.stringify(arrtglloop);

            // console.log(arrtgl);

            if (date_start === '' || date_end === '') {
                Swal.fire({
                    position: 'center',
                    title: 'Form is empty!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                })
            }else{
                $.ajax({
                    type: "POST",
                    url: "{{ route('maincekketersediaanassets') }}",
                    data: {
                        reqbooking: arrtgl,
                        kategori: kategori,
                        date_start: date_start,
                        date_end: date_end
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        var html = '<option>Choose...</option>';
                        $.each(data, function(index, value) {
                            html += "<option value='"+value.id+"'>"+value.name+" - "+value.no_assets+"</option>";
                        });

                        $("[data-name='data_asset']").html(html);
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

        $(document).on("click", "[data-name='save_data']", function(e) {
            var date_start = $("[data-name='date_start']").val();
            var date_end = $("[data-name='date_end']").val();
            var data_asset = $("[data-name='data_asset']").val();
            var necessity = $("[data-name='necessity']").val();
            var id_user = "{!! $idn_user->id !!}";
            var table = "trx_assets_landing";
            var status = 1;

            var date            = new Date();
            var datetime        = moment(date);
            var date_create     = datetime.format('YYYY-MM-DD HH:mm:ss');

            // var arrstart    = moment(date_start).format('Y-mm-D');
            // var arrend    = moment(date_end).format('Y-mm-D');

            var arrstart = moment(date_start);
            var arrend = moment(date_end);
            var arrtglloop = [];
            while (arrstart <= arrend) {
                arrtglloop.push(arrstart.format('YYYY-MM-DD HH'));
                arrstart.add(1, 'hours');
            }

            var arrtgl  = JSON.stringify(arrtglloop);

            var data = {
                date_create: date_create,
                date_start: date_start,
                date_end: date_end,
                data_asset: data_asset,
                arrtgl: arrtgl,
                necessity: necessity,
                id_user: id_user,
                status: status
            };

            if (date_start === '' || date_end === '' || data_asset === '' || necessity === '' || id_user === '') {
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
    {{-- End JS Create Data --}}

    <script>
        $('input[data-name="date_start"]').datetimepicker({
            format: 'Y-m-d H:i:s',
            step: 15,
            autoclose: true
        });

        $('input[data-name="date_end"]').datetimepicker({
            format: 'Y-m-d H:i:s',
            step: 15,
            autoclose: true
        });
    </script>

    <script>
        $(".select2").select2({
            allowClear: false,
            width: '100%',
        });
    </script>



@stop
