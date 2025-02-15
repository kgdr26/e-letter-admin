@extends('main')

@section('content')
    <h2>Approval Dephead</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>File</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                @if ($document->tahap == 'Dephead' && $document->status == 'Approved Sechead')
                    <tr>
                        <td>{{ $document->title }}</td>
                        <td><a href="{{ asset($document->file_name) }}">Download</a></td>
                        <td>{{ $document->status }}</td>
                        <td>
                            <form action="{{ route('document.approve.dephead', $document->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection
