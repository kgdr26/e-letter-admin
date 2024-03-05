@extends('main')
@section('content')

    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabs Menu</h5>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="{{ route('assetsdash') }}" class="nav-link">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('assetscreate') }}" class="nav-link active">Create Form</a>
                        </li>

                        @if ($idn_user->id == 1)
                            <li class="nav-item">
                                <a href="{{ route('assetsdephed') }}" class="nav-link">DepHead Approved</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('assetsfirst') }}" class="nav-link">HRGA Approved</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('assetsdata') }}" class="nav-link">Show Lending Asset</a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">Data Asset</a>
                        </li>
                    </ul>

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
                                                        @foreach ($type as $k => $v)
                                                            <option value="{{ $v->kategori }}">{{ $v->kategori }}</option>
                                                        @endforeach
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
                                                        @foreach ($asset as $k => $v)
                                                            <option value="{{ $v->id }}">{{ $v->merk }} -
                                                                {{ $v->no_assets }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-3"
                                            <label for="inputNecessity" class="form-label">Necessity</label>
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

    <script>
        $(document).on("click", "[data-name='save_data']", function(e) {
            var date_start = $("[data-name='date_start']").val();
            var date_end = $("[data-name='date_end']").val();
            var data_asset = $("[data-name='data_asset']").val();
            var necessity = $("[data-name='necessity']").val();
            var id_user = "{!! $idn_user->id !!}";
            var table = "trx_assets_landing";
            var status = 1;

            var data = {
                date_start: date_start,
                date_end: date_end,
                data_asset: data_asset,
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
