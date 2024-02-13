@extends('main')
@section('content')

<section class="section dashboard">
    <div class="row align-items-top">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabs Menu</h5>

                <ul class="nav nav-tabs">
                    <li class="nav-item" role="presentation">
                        <a href="{{route('assetsdash')}}" class="nav-link" >Dahboard</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{route('assetscreate')}}" class="nav-link">Create Form</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{route('assetsdephed')}}" class="nav-link active">DepHead Approved</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link">First Approved</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link">Second Approved</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link">Director Approve</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link">Show Lending Asset</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link">Data Asset</a>
                    </li>
                </ul>

                <div class="tab-content pt-2 mt-3">
                    <div class="tab-pane fade show active" >
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Necessity</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                   @foreach($asset as $key => $value)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$value->usr_name}}</td>
                                            <td>{{$value->date_start}}</td>
                                            <td>{{$value->date_end}}</td>
                                            <td>{{$value->necessity}}</td>
                                            <td>{{$value->status}}</td>
                                            <td></td>
                                        </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- JS Datatable --}}
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
{{-- End JS Datatable --}}

@stop
