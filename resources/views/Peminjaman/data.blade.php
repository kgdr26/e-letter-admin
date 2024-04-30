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
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($asset as $key => $value)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $value->usr_name }}</td>
                                                <td>{{ $value->date_start }}</td>
                                                <td>{{ $value->date_end }}</td>
                                                <td>{{ $value->ast_name }} - {{ $value->ast_no }}</td>
                                                <td>{{ $value->necessity }}</td>
                                                <td class="text-center">
                                                    @if ($value->status == 1)
                                                        <button type="button" class="btn btn-secondary btn-sm" disabled>
                                                            Create Form
                                                        </button>
                                                    @elseif($value->status == 2)
                                                        <button type="button" class="btn btn-info btn-sm" disabled>
                                                            Approve Dephed
                                                        </button>
                                                    @elseif($value->status == 3)
                                                        <button type="button" class="btn btn-success btn-sm" disabled>
                                                            Approve HRGA
                                                        </button>
                                                    @elseif($value->status == 4)
                                                        <button type="button" class="btn btn-warning btn-sm" disabled>
                                                            Validate
                                                        </button>
                                                    @elseif($value->status == 5)
                                                        <button type="button" class="btn btn-danger btn-sm" disabled>
                                                            Returned
                                                        </button>
                                                    @elseif($value->status == 6)
                                                        <button type="button" class="btn btn-danger btn-sm" disabled>
                                                            Rejected
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm" disabled>
                                                            Approved
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm" data-name="detailtimeline" data-item="{{ $value->id }}">
                                                        Detail Timeline
                                                    </button>
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

    {{-- Modal Noted Cancel --}}
    <div class="modal fade" id="modal_timeline" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Timeline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade profile-overview active show mb-3" id="profile-overview" role="tabpanel">
                        <h5 class="card-title">Asset Lending Details</h5>
      
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Name Employee</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_name">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">NPK</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_npk">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Start Date</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_start">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Due Date</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_end">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Assets Name</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_assets">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Necessity</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_necee">-</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Status</div>
                            <div class="col-lg-9 col-md-8" data-name="detail_status">-</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header">
                                <h1>Timeline</h1>
                            </div>
                            <div style="display:inline-block;width:100%;overflow-y:auto;">
                                <ul class="timeline timeline-horizontal" data-name="datatimeline">
                                    {{-- @for($i = 1; $i <= 6; $i++)
                                        <li class="timeline-item">
                                            <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Mussum ipsum cacilds 1</h4>
                                                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Mussum ipsum cacilds, vidis litro abertis. Consetis faiz elementum girarzis, nisi eros gostis.</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endfor --}}
                                    {{-- <li class="timeline-item">
                                        <div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">CREATE</h4>
                                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 2024-04-26 11:00:06</small></p>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label ">User Action</div>
                                                    <div class="col-lg-8 col-md-8">Medi</div>
                                                </div>
                        
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label ">NPK</div>
                                                    <div class="col-lg-8 col-md-8">123445</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label ">Note</div>
                                                    <div class="col-lg-8 col-md-8">Tessss trangkan</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li> --}}
                                    {{-- <li class="timeline-item">
                                        <div class="timeline-badge success"><i class="glyphicon glyphicon-check"></i></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Mussum ipsum cacilds 2</h4>
                                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Mussum ipsum cacilds, vidis faiz elementum girarzis, nisi eros gostis.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-badge info"><i class="glyphicon glyphicon-check"></i></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Mussum ipsum cacilds 3</h4>
                                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipisci. Mé faiz elementum girarzis, nisi eros gostis.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-badge danger"><i class="glyphicon glyphicon-check"></i></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Mussum ipsum cacilds 4</h4>
                                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-badge warning"><i class="glyphicon glyphicon-check"></i></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Mussum ipsum cacilds 5</h4>
                                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Mussum ipsum cacilds 6</h4>
                                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis.</p>
                                            </div>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Noted Cancel --}}

    {{-- JS Show Detail Timeline --}}
    <script>
        $(document).on("click", "[data-name='detailtimeline']", function(e) {
            var id = $(this).attr("data-item");

            $.ajax({
                type: "POST",
                url: "{{ route('showdetailtimeline') }}",
                data: {
                    id: id,
                },
                cache: false,
                success: function(data) {
                    console.log(data);

                    $("[data-name='detail_name']").text(data.listdata.usr_name);
                    $("[data-name='detail_npk']").text(data.listdata.npk);
                    $("[data-name='detail_start']").text(data.listdata.date_start);
                    $("[data-name='detail_end']").text(data.listdata.date_end);
                    $("[data-name='detail_assets']").text(data.listdata.ast_name+" - "+data.ast_no);
                    $("[data-name='detail_necee']").text(data.listdata.necessity);

                    if(data.listdata.status === 1){
                        var detailstatus = '<button type="button" class="btn btn-secondary btn-sm" disabled>Create</button>';
                    }else if(data.listdata.status === 2){
                        var detailstatus = '<button type="button" class="btn btn-info btn-sm" disabled>Approve Dephed</button>';
                    }else if(data.listdata.status === 3){
                        var detailstatus = '<button type="button" class="btn btn-success btn-sm" disabled>Approve HRGA</button>';
                    }else if(data.listdata.status === 4){
                        var detailstatus = '<button type="button" class="btn btn-warning btn-sm" disabled>Security Validate</button>';
                    }else if(data.listdata.status === 5){
                        var detailstatus = '<button type="button" class="btn btn-danger btn-sm" disabled>Returned</button>';
                    }else if(data.listdata.status === 6){
                        var detailstatus = '<button type="button" class="btn btn-danger btn-sm" disabled>Canceled</button>';
                    }else{
                        var detailstatus = '-';
                    }

                    $("[data-name='detail_status']").html(detailstatus);
                    $("[data-name='datatimeline']").html(data.timeline);
                    
                    $("#modal_timeline").modal('show');
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
    </script>
    {{-- End JS Show Detail Timeline --}}

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

@stop
