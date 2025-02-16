@extends('main')

@section('content')
    <h2>PIC Document</h2>

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
                @if ($document->tahap == 'PIC' && $document->status == 'Approved Dephead')
                    <tr>
                        <td>{{ $document->title }}</td>
                        <td><a href="{{ asset($document->file_name) }}">Download</a></td>
                        <td>{{ $document->status }}</td>
                        <td>
                            <form action="{{ route('document.pic.docu', $document->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Complete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection
