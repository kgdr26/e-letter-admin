@extends('main')

@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="card">
                <div class="card-body">
                    <h1>Form Entri Dokumen</h1>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="create-form-tab" data-bs-toggle="tab" href="#create-form"
                                role="tab" aria-controls="create-form" aria-selected="true">Create Form</a>
                            <a class="nav-link" id="approve-sechead-tab" data-bs-toggle="tab" href="#approve-sechead"
                                role="tab" aria-controls="approve-sechead" aria-selected="false">Approval Sechead</a>
                            <a class="nav-link" id="approve-dephead-tab" data-bs-toggle="tab" href="#approve-dephead"
                                role="tab" aria-controls="approve-dephead" aria-selected="false">Approval Dephead</a>
                            <a class="nav-link" id="pic-docu-tab" data-bs-toggle="tab" href="#pic-docu" role="tab"
                                aria-controls="pic-docu" aria-selected="false">Approval PIC Docu</a>
                            <a class="nav-link" id="folder-tab" data-bs-toggle="tab" href="#folder" role="tab"
                                aria-controls="folder" aria-selected="false">Show Folder & File</a>
                        </div>
                    </nav>

                    <div class="tab-content mt-3" id="nav-tabContent">
                        <!-- Create Form Tab -->
                        <div class="tab-pane fade show active" id="create-form" role="tabpanel"
                            aria-labelledby="create-form-tab">
                            <form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data"
                                id="uploadForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul:</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="file" class="form-label">File:</label>
                                    <input type="file" id="fileInput" name="file" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori:</label>
                                    <input type="text" name="category" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="to_dept" class="form-label">Kepada Departemen:</label>
                                    <input type="text" name="to_dept" class="form-control" required>
                                </div>

                                <input type="hidden" name="ukuran_file" id="ukuran_file">

                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>

                            <div id="fileInfoedit" class="mt-3"></div>
                        </div>

                        <!-- Approve Sections Should Not Show On Create -->
                        <div class="tab-pane fade" id="approve-sechead" role="tabpanel"
                            aria-labelledby="approve-sechead-tab">
                            <!-- Optional content if needed -->
                        </div>

                        <div class="tab-pane fade" id="approve-dephead" role="tabpanel"
                            aria-labelledby="approve-dephead-tab">
                            <!-- Optional content if needed -->
                        </div>

                        <div class="tab-pane fade" id="pic-docu" role="tabpanel" aria-labelledby="pic-docu-tab">
                            <!-- Optional content if needed -->
                        </div>

                        <div class="tab-pane fade" id="folder" role="tabpanel" aria-labelledby="folder-tab">
                            <!-- Optional content if needed -->
                        </div>
                    </div>

                    <h2 class="mt-4">Overview</h2>
                    <table id="documentsTable" class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Nama User</th>
                                <th>File</th>
                                <th>Ukuran</th>
                                <th>Kategori</th>
                                <th>Folder</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ Auth::user()->name }}</td>
                                    <td><a href="{{ asset($document->file_name) }}">Download</a></td>
                                    <td>{{ $document->ukuran_file }} bytes</td>
                                    <td>{{ $document->category }}</td>
                                    <td>{{ $document->id_folder }}</td>
                                    <td>{{ $document->status }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm">Show</a>
                                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm">Kirim</a>
                                        <form action="" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#documentsTable').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#fileInput').on('change', function(event) {
                const files = event.target.files;

                // Clear previous file info
                $('#fileInfoedit').empty();

                for (let i = 0; i < files.length; i++) {
                    const fileName = files[i].name;
                    const fileSize = files[i].size; // Ukuran dalam bytes
                    const fileSizeKB = fileSize / 1024; // Konversi ke KB

                    // Update input hidden dengan ukuran file
                    $('#ukuran_file').val(fileSizeKB.toFixed(2) + ' KB'); // Format ukuran

                    let html = `
                    <div class="col-12 mb-3">
                        <div class="card-preview-file">
                            <div class="card-info-file">
                                <p>${fileName}</p>
                                <p>${fileSizeKB.toFixed(2)} KB</p>
                            </div>
                        </div>
                    </div>`;

                    // Tambahkan informasi file ke DOM
                    $('#fileInfoedit').append(html);
                }
            });
        });
    </script>
@endsection

@stop
