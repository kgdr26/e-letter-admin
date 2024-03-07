@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row">

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Checksheet Assets</h5>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="" class="form-label">Type</label>
                            <select id="" class="form-select select2" data-name="type">
                                <option>Choose...</option>
                                <option value="1">Perpanjang Pajak</option>
                                <option value="2">Service</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="" class="form-label">Select Assets</label>
                            <select id="" class="form-select select2" data-name="id_asset">
                                <option>Choose...</option>
                                @foreach ($assets as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->merk }} - {{ $v->no_assets }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="" data-name="tanggal">
                        </div>
                    </div>

                    <div class="row mb-3" id="showketerangan" style="display: none">
                        <div class="col-12">
                            <label for="" class="form-label">Rincian Service</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" data-name="keterangan"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary" data-name="save_data">Save</button>
                            <button type="button" class="btn btn-secondary" data-name="reset_data">Reset</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Calendar Checksheet Assets</h5>

                    <div id="calendar"></div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="show_list_event" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="tanggalevent"></h4>
                <div id="listevent">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_add">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("change", "[data-name='type']", function (e) {
        var type   = $(this).val();
        // alert(type);
        if(type == 1){
            $('#showketerangan').hide();
        }else{
            $('#showketerangan').show();
        }
    });

    $(document).on("click", "[data-name='save_data']", function(e) {
        var type            = $("[data-name='type']").val();
        var id_asset        = $("[data-name='id_asset']").val();
        var tanggal         = $("[data-name='tanggal']").val();
        var keterangan      = $("[data-name='keterangan']").val();
        var id_user         = "{!! $idn_user->id !!}";
        var table           = "trx_chceksheet_asset";

        var data = {
            id_user: id_user,
            id_asset: id_asset,
            type: type,
            tanggal: tanggal,
            keterangan: keterangan
        };

        if (type === '' || id_asset === '' || tanggal === '') {
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

    $(document).on("click", "[data-name='reset_data']", function(e) {
        location.reload();
    });
</script>

{{-- Fullcalendar --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            initialView: 'multiMonthYear',
            // initialDate: new Date(),
            navLinks: false, // can click day/week names to navigate views
            businessHours: false, // display business hours
            editable: false,
            selectable: true,
            events: 'assetchecksheetcall',
            dateClick: function(info) {
                var clickedDate = info.date;
                var eventsForDate = calendar.getEvents().filter(function(event) {
                    return event.start.toDateString() === clickedDate.toDateString();
                });
                var eventListHTML = '<ul>';
                eventsForDate.forEach(function(event) {
                    eventListHTML += '<li>' + event.title + '</li>';
                });
                eventListHTML += '</ul>';

                var datereal    = moment(clickedDate);
                $('#tanggalevent').text('Tanggal : '+datereal.format('DD MMM YYYY'));
                $('#listevent').html(eventListHTML);
                $('#show_list_event').modal('show');
            }
        });

        calendar.render();
    });
</script>
{{-- End Fullcalendar --}}

<script>
    $('input[data-name="tanggal"]').datepicker({
        format: "yyyy-mm-dd",
        viewMode: "days",
        minViewMode: "days",
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