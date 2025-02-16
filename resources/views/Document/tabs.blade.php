@extends('main')

@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="card">
                <div class="card-body">

                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="entry-tab" data-bs-toggle="tab" href="#entry" role="tab"
                                aria-controls="entry" aria-selected="true">Entri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="approve-sechead-tab" data-bs-toggle="tab" href="#approve-sechead"
                                role="tab" aria-controls="approve-sechead" aria-selected="false">Approve Sechead</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="approve-dephead-tab" data-bs-toggle="tab" href="#approve-dephead"
                                role="tab" aria-controls="approve-dephead" aria-selected="false">Approve Dephead</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pic-docu-tab" data-bs-toggle="tab" href="#pic-docu" role="tab"
                                aria-controls="pic-docu" aria-selected="false">PIC Docu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="folder-tab" data-bs-toggle="tab" href="#folder" role="tab"
                                aria-controls="folder" aria-selected="false">Show Folder</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Entri Tab -->
                        <div class="tab-pane fade show active" id="entry" role="tabpanel" aria-labelledby="entry-tab">
                            @include('Document.create')
                        </div>

                        <!-- Approve Sechead Tab -->
                        <div class="tab-pane fade" id="approve-sechead" role="tabpanel"
                            aria-labelledby="approve-sechead-tab">
                            @include('Document.approve_sechead')
                        </div>

                        <!-- Approve Dephead Tab -->
                        <div class="tab-pane fade" id="approve-dephead" role="tabpanel"
                            aria-labelledby="approve-dephead-tab">
                            @include('Document.approve_dephead')
                        </div>

                        <!-- PIC Docu Tab -->
                        <div class="tab-pane fade" id="pic-docu" role="tabpanel" aria-labelledby="pic-docu-tab">
                            @include('Document.pic_docu')
                        </div>

                        <!-- Show Folder Tab -->
                        <div class="tab-pane fade" id="folder" role="tabpanel" aria-labelledby="folder-tab">
                            @include('Document.folder')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Script untuk tab (jika perlu)
        // Anda bisa menambahkan kode JavaScript khusus di sini jika dibutuhkan
    </script>
@endsection
