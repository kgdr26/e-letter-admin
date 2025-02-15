@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card-body mt-3">
                @include('CashInAdvance.navtab')
                <div class="tab-content pt-2 mt-3">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <span class="d-flex justify-content-end fw-bold">Dephead Approval || Cash In Advance</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped" id="depheadApprovalTable">
                                        <thead>
                                            <tr>
                                            <tr class="text-center">
                                                <th>NO</th>
                                                <th>NAME</th>
                                                <th>NO. CIA</th>
                                                <th>CREATE ON</th>
                                                <th>NECESSITY</th>
                                                <th>AMOUNT</th>
                                                <th>QTY</th>
                                                <th>UNIT</th>
                                                <th>STATUS</th>
                                                <th>UPDATED AT</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cia_list as $index => $cia)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $cia->user_name }}</td>
                                                    <td class="text-center fw-bold text-primary">
                                                        {{ $cia->no_cia }}
                                                    </td>
                                                    <td class="text-center">{{ $cia->date_create }}</td>
                                                    <td class="text-center">{{ $cia->necessity }}</td>
                                                    <td class="text-center">Rp.
                                                        {{ number_format($cia->amount, 0, ',', '.') }}</td>
                                                    <td class="text-center">{{ $cia->qty }}</td>
                                                    <td class="text-center">{{ $cia->unit }}</td>
                                                    <td class="text-center">
                                                        @switch($cia->status)
                                                            @case(1)
                                                                <button class="btn btn-secondary btn-sm">Draft</button>
                                                            @break

                                                            @case(2)
                                                                <button class="btn btn-primary btn-sm">Dept-Approve</button>
                                                            @break

                                                            @case(3)
                                                                <button class="btn btn-info btn-sm">Approved by
                                                                    Finance</button>
                                                            @break

                                                            @case(4)
                                                                <button class="btn btn-warning btn-sm">Prepaid
                                                                    Process</button>
                                                            @break

                                                            @case(5)
                                                                <button class="btn btn-success btn-sm">Paid</button>
                                                            @break

                                                            @case(6)
                                                                <button class="btn btn-warning btn-sm">Settlement in
                                                                    Process</button>
                                                            @break

                                                            @case(7)
                                                                <button class="btn btn-success btn-sm">Approved
                                                                    Settlement</button>
                                                            @break

                                                            @case(8)
                                                                <button class="btn btn-success btn-sm">Settlement
                                                                    Paid</button>
                                                            @break

                                                            @case(9)
                                                                <button class="btn btn-dark btn-sm">Finished
                                                                    CIA</button>
                                                            @break

                                                            @case(10)
                                                                <button class="btn btn-dark btn-sm">Rejected</button>
                                                            @break

                                                            @default
                                                                <button class="btn btn-secondary btn-sm">Unknown</button>
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $cia->last_update }}</td>
                                                    <td>
                                                        <!-- Form untuk Approve -->
                                                        <form action="{{ route('cia.depheadApproveOrReject') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="cia_id"
                                                                value="{{ $cia->id }}">
                                                            <button type="submit" name="action" value="approve"
                                                                class="btn btn-success btn-sm">
                                                                Approve
                                                            </button>

                                                            <!-- Tombol untuk Reject, memunculkan modal -->
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#rejectModal"
                                                                data-id="{{ $cia->id }}">
                                                                Reject
                                                            </button>
                                                        </form>
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
        </div>
    </section>

    <!-- Modal Reject -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cia.depheadApproveOrReject') }}" method="POST" id="rejectForm">
                    @csrf
                    <input type="hidden" name="action" value="reject">
                    <input type="hidden" name="cia_id" id="reject_cia_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Reject Cash In Advance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="rejection_reason" class="form-label">Alasan Penolakan</label>
                            <textarea name="rejection_reason" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#rejectModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var ciaId = button.data('id'); // Ambil ID CIA

            var modal = $(this);
            modal.find('#reject_cia_id').val(ciaId); // Set ID CIA ke form
        });
    </script>
@endsection
