<div class="col-lg-6">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="color: red;">Create Form Asset Lending</h5>

            <!-- Vertical Form -->
            <div class="row mb-3">
                <div class="col-6">
                    <label for="inputName" class="form-label">Name Employee</label>
                    <input type="text" class="form-control form-control" id="inputName" placeholder="Name Employee" value="{{$idn_user->name}}" disabled>
                </div>
                <div class="col-6">
                    <label for="inputNpk" class="form-label">NPK</label>
                    <input type="text" class="form-control" id="inputNpk" placeholder="NPK" value="{{$idn_user->npk}}" disabled>
                </div>
                <div class="col-6">
                    <label for="inputStartdate" class="form-label">Start Date</label>
                    <input type="text" class="form-control" id="InputStartdate" data-name="date_start">
                </div>
                <div class="col-6">
                    <label for="inputDuedate" class="form-label">Due Date</label>
                    <input type="text" class="form-control" id="inputDuedate" data-name="date_end">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-success w-100" data-name="add_dtast"><i class="bi bi-plus-lg"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12" id="add_dtast">
                    <div class="row mb-3" id="data_asset">
                        <div class="col-5">
                            <label for="inputAsset" class="form-label">Asset Name</label>
                            <select id="inputAsset" class="form-select select-2" data-name="asset_name[]">
                                <option>Choose...</option>
                                @foreach($asset as $k => $v)
                                    <option value="{{$v->name}}">{{$v->name}}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <label for="inputNopol" class="form-label">No Police</label>
                            <select id="inputNopol" class="form-select select-2" data-name="asset_id[]">
                                <option>Choose...</option>
                            </select>
                        </div>
                        <div class="col-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger" onclick="rmv_dtast();"><i class="bi bi-dash-lg"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <label for="inputNecessity" class="form-label">Necessity</label>
                    <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div ><!-- Vertical Form -->

        </div>
    </div>

    {{-- JS select Assets --}}
    <script>
        $(document).on("change", "[data-name='asset_name[]']", function (e) {
            var name    = $(this).val();
            var table   = 'mst_asset';
            var field   = 'name';
            // alert(name);
            $.ajax({
                type: "POST",
                url: "{{ route('actionlistdata') }}",
                data: {
                    id: name,
                    field: field,
                    table: table
                },
                cache: false,
                success: function(data) {
                    console.log(data);

                    var html = '<option value="">Select Nopol</option>';
                    data.forEach(function(data) {
                        if(data.status === 0){
                            html += '<option value="'+data.id+'">'+data.no_assets+'</option>';
                        }
                    });

                    $("[data-name='asset_id[]']").html(html);
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
        });

        var i = $("#data_asset").length + 1;
        var html_dtast = '';

        html_dtast += '<div class="row mb-3" id="data_asset">';
        html_dtast += '<div class="col-5">';
        html_dtast += '<label for="inputAsset" class="form-label">Asset Name</label>';
        html_dtast += '<select id="inputAsset" class="form-select select-2" data-name="asset_name[]">';
        html_dtast += '<option>Choose...</option>';
        html_dtast += '@foreach($asset as $k => $v)';
        html_dtast += '<option value="{{$v->name}}">{{$v->name}}</option>    ';
        html_dtast += '@endforeach';
        html_dtast += '</select>';
        html_dtast += '</div>';
        html_dtast += '<div class="col-5">';
        html_dtast += '<label for="inputNopol" class="form-label">No Police</label>';
        html_dtast += '<select id="inputNopol" class="form-select select-2" data-name="asset_id[]">';
        html_dtast += '<option>Choose...</option>';
        html_dtast += '</select>';
        html_dtast += '</div>';
        html_dtast += '<div class="col-2 d-flex align-items-end">';
        html_dtast += '<button type="button" class="btn btn-danger" onclick="rmv_dtast();"><i class="bi bi-dash-lg"></i></button>';
        html_dtast += '</div>';
        html_dtast += '</div>';

        $(function() {
            $("[data-name='add_dtast']").click(function() {
                $(html_dtast).appendTo($('#add_dtast'));
                i++;
                return false;
            });
        });

        function rmv_dtast() {
            var tag1    = $(this).prev();
            var tag2    = tag1.prev() 
            // console.log(tag2)
            if (i > 1) {
                tag1.remove();
                i--;
            }
        }
    </script>

    <script>
        $('input[data-name="date_start"]').datepicker({
            format: "yyyy-mm-dd",
            viewMode: "days",
            minViewMode: "days",
            autoclose: true
        });

        $('input[data-name="date_end"]').datepicker({
            format: "yyyy-mm-dd",
            viewMode: "days",
            minViewMode: "days",
            autoclose: true
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $(".select-2").select2({
                allowClear: false,
                width: '100%',
            });
        });
    </script>