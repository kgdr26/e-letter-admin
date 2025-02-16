@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="card">
            <div class="card-body mt-3">
                <form method="POST" action="{{ route('cia.update', $cia->id_user) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="date_create" class="form-label">Date</label>
                        <input type="text" name="date_create" class="form-control" value="{{ $cia->date_create }}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label for="necessity" class="form-label">Necessity</label>
                        <textarea name="necessity" class="form-control">{{ $cia->necessity }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control" value="{{ $cia->amount }}">
                    </div>

                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty</label>
                        <input type="number" name="qty" class="form-control" value="{{ $cia->qty }}">
                    </div>

                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <select name="unit" class="form-select">
                            <option value="Pcs" {{ $cia->unit == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="Box" {{ $cia->unit == 'Box' ? 'selected' : '' }}>Box</option>
                            <option value="Pack" {{ $cia->unit == 'Pack' ? 'selected' : '' }}>Pack</option>
                        </select>
                    </div>
                    {{-- justify-content-end --}}
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('cia.form') }}" class="btn btn-secondary ms-2">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
