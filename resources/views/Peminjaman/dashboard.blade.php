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

                    {{-- <div class="tab-content pt-2 mt-3">
                        <div class="tab-pane fade show active">
                            <div class="row mb-3"> --}}
                    <!-- Card with an Borrowed -->
                    {{-- <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Available</h5>
                                            <hr>
                                            <button type="button" class="btn btn-info" data-name="add">0</button>
                                        </div>
                                    </div>
                                </div> --}}
                    <!-- End Card with an Borrowed -->

                    <!-- Card with an Is Being Borrowed -->
                    {{-- <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Already Booked</h5>
                                            <hr>
                                            <button type="button" class="btn btn-info" data-name="add">{{count($dataapphrga)}}</button>
                                        </div>
                                    </div>
                                </div> --}}
                    <!-- End Card with an Is Being Borrowed -->

                    <!-- Card with an Is Being Borrowed -->
                    {{-- <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Currently Borrowed</h5>
                                            <hr>
                                            <button type="button" class="btn btn-info" data-name="add">{{count($dataappscurity)}}</button>
                                        </div>
                                    </div>
                                </div> --}}
                    <!-- End Card with an Is Being Borrowed -->

                    <!-- Card with an Is Being Borrowed -->
                    {{-- <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Returned</h5>
                                            <hr>
                                            <button type="button" class="btn btn-info" data-name="add">{{count($dataappbalik)}}</button>
                                        </div>
                                    </div>
                                </div> --}}
                    <!-- End Card with an Is Being Borrowed -->
                    {{-- </div> --}}

                    <div class="row mb-3 mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <div class="modal fade" id="show_list_event" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="tanggalevent"></h4>
                    <div id="listevent">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



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
                initialDate: new Date(),
                navLinks: false, // can click day/week names to navigate views
                businessHours: false, // display business hours
                editable: false,
                selectable: true,
                events: 'assetscall',
                dateClick: function(info) {

                    var clickedDate = info.date;
                    var eventsForDate = calendar.getEvents().filter(function(event) {
                        return event.start.toDateString() === clickedDate.toDateString();
                    });
                    var eventListHTML = '<ul>';
                    eventsForDate.forEach(function(event) {
                        console.log(event);
                        eventListHTML += '<li>';
                        eventListHTML += event.title + '<br>';
                        eventListHTML += 'Start Datetime : ' + event.extendedProps.tglstart +
                            '<br>';
                        eventListHTML += 'End Datetime : ' + event.extendedProps.tglend;
                        eventListHTML += '</li>';
                    });
                    eventListHTML += '</ul>';

                    var datereal = moment(clickedDate);
                    $('#tanggalevent').text('Tanggal : ' + datereal.format('DD MMM YYYY'));
                    $('#listevent').html(eventListHTML);
                    $('#show_list_event').modal('show');
                }
            });

            calendar.render();
        });
    </script>
    {{-- End Fullcalendar --}}

@stop
