@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row align-items-top">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabs Menu</h5>

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="{{route('assetsdash')}}" class="nav-link active">Dahboard</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('assetscreate')}}" class="nav-link">Create Form</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('assetsdephed')}}" class="nav-link">DepHead Approved</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('assetsfirst')}}" class="nav-link">First Approved</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('assetssecond')}}" class="nav-link">Second Approved</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('assetsdirector')}}" class="nav-link">Director Approve</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('assetsdata')}}" class="nav-link">Show Lending Asset</a>
                    </li>
                </ul>

                <div class="tab-content pt-2 mt-3">
                    <div class="tab-pane fade show active" >
                        <div class="row mb-3">
                            <!-- Card with an Borrowed -->
                            <div class="col-lg-2">
                                <div class="card">
                                    {{-- <img src="assets/img/card.jpg" class="card-img-top" alt="..."> --}}
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Borrowed</h5>
                                        <hr>
                                        <button type="button" class="btn btn-info" data-name="add">5</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card with an Borrowed -->

                            <!-- Card with an Is Being Borrowed -->
                            <div class="col-lg-2">
                                <div class="card">
                                    {{-- <img src="assets/img/card.jpg" class="card-img-top" alt="..."> --}}
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Is Being Borrowed</h5>
                                        <hr>
                                        <button type="button" class="btn btn-info" data-name="add">5</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card with an Is Being Borrowed -->

                            <!-- Card with an Is Being Borrowed -->
                            <div class="col-lg-2">
                                <div class="card">
                                    {{-- <img src="assets/img/card.jpg" class="card-img-top" alt="..."> --}}
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Is Being Borrowed</h5>
                                        <hr>
                                        <button type="button" class="btn btn-info" data-name="add">5</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card with an Is Being Borrowed -->

                            <!-- Card with an Is Being Borrowed -->
                            <div class="col-lg-2">
                                <div class="card">
                                    {{-- <img src="assets/img/card.jpg" class="card-img-top" alt="..."> --}}
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Is Being Borrowed</h5>
                                        <hr>
                                        <button type="button" class="btn btn-info" data-name="add">5</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card with an Is Being Borrowed -->

                            <!-- Card with an Is Being Borrowed -->
                            <div class="col-lg-2">
                                <div class="card">
                                    {{-- <img src="assets/img/card.jpg" class="card-img-top" alt="..."> --}}
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Is Being Borrowed</h5>
                                        <hr>
                                        <button type="button" class="btn btn-info" data-name="add">5</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card with an Is Being Borrowed -->
                            <!-- Card with an Is Being Borrowed -->
                            <div class="col-lg-2">
                                <div class="card">
                                    {{-- <img src="assets/img/card.jpg" class="card-img-top" alt="..."> --}}
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Is Being Borrowed</h5>
                                        <hr>
                                        <button type="button" class="btn btn-info" data-name="add">5</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card with an Is Being Borrowed -->
                        </div>

                        <div class="row mb-3">
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
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            selectable: true,
            events: 'assetscall'
        });
    
        calendar.render();
    });
  
</script>
{{-- End Fullcalendar --}}

@stop