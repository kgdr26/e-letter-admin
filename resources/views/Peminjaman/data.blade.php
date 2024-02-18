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
                        <a href="{{route('assetsdephed')}}" class="nav-link">DepHead Approved</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{route('assetsfirst')}}" class="nav-link">First Approved</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{route('assetssecond')}}" class="nav-link">Second Approved</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{route('assetsdirector')}}" class="nav-link">Director Approve</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{route('assetsdata')}}" class="nav-link active">Show Lending Asset</a>
                    </li>
                </ul>

                <div class="tab-content pt-2 mt-3">
                    <div class="tab-pane fade show active" >
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>User Create</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Assets</th>
                                        <th>Necessity</th>
                                        <th class="text-center">Status</th>
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
                                            <td>{{$value->ast_name}} - {{$value->ast_no}}</td>
                                            <td>{{$value->necessity}}</td>
                                            <td class="text-center">
                                                @if($value->status == 1)
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        Create
                                                    </button>
                                                @elseif($value->status == 2)
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        Approve Dephed
                                                    </button>
                                                @elseif($value->status == 3)
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        Approve First
                                                    </button>
                                                @elseif($value->status == 4)
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        Approve Second
                                                    </button>
                                                @elseif($value->status == 5)
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        Approve Director
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        APPROVE
                                                    </button>
                                                @endif
                                            </td>
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
