@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabs Menu</h5>

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tabs" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Dsahboard</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="createform-tab" data-bs-toggle="tab" data-bs-target="#createform"
                                type="button" role="tab" aria-controls="createform" aria-selected="true">Create
                                Form</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="depheadapprove-tab" data-bs-toggle="tab"
                                data-bs-target="#depheadapprove" type="button" role="tab"
                                aria-controls="depheadapprove" aria-selected="false">DepHead
                                Approved</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="firstapprove-tab" data-bs-toggle="tab"
                                data-bs-target="#firstapprove" type="button" role="tab" aria-controls="firstapprove"
                                aria-selected="false">First
                                Approved</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="secondapprove-tab" data-bs-toggle="tab"
                                data-bs-target="#secondapprove" type="button" role="tab" aria-controls="contact"
                                aria-selected="false">Security</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact"
                                aria-selected="false">Returned</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">Show
                                Lending Asset</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">
                                Data Asset</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">
                                Settings</button>
                        </li> --}}
                    </ul>
                    <div class="tab-content pt-2 mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
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
                        </div>

                        {{-- Create Form --}}
                        <div class="tab-pane fade" id="createform" role="tabpanel" aria-labelledby="createform-tab">
                            @include('Surat.create-form')

                        </div>
                        {{-- End Create Form --}}
                        {{-- Data Tables DeptHead Approve --}}
                        <div class="tab-pane fade" id="depheadapprove" role="tabpanel"
                            aria-labelledby="depheadapprove-tab">
                            <div class="table-responsive mt-3">
                                <table class="table" id="dataTableDeptHead">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center">No</th>
                                            <th class="text-center">Asset Name</th>
                                            <th class="text-center">Type/Merk/Remark</th>
                                            <th class="text-center">Police Number</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">Due Date</th>
                                            <th class="text-center">Necessary</th>
                                            <th class="text-center">Applicant</th>
                                            <th class="text-center">First Approve</th>
                                            <th class="text-center">Second Approve</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">
                                                <a href=""><i class="bi bi-eye-fill me-3"></i></a>
                                                <a href=""><i class="bi bi-pencil-square me-3"></i></a>
                                                <a href=""><i class="bi bi-trash-fill"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- End Data Tables DeptHead Approve --}}

                        {{-- Data Tables First Approve --}}
                        <div class="tab-pane fade" id="firstapprove" role="tabpanel" aria-labelledby="firstapprove-tab">
                            <div class="table-responsive mt-3">
                                <table class="table" id="dataTableFirst">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center">No</th>
                                            <th class="text-center">Asset Name</th>
                                            <th class="text-center">Type/Merk/Remark</th>
                                            <th class="text-center">Police Number</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">Due Date</th>
                                            <th class="text-center">Necessary</th>
                                            <th class="text-center">Applicant</th>
                                            <th class="text-center">First Approve</th>
                                            <th class="text-center">Second Approve</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">
                                                <a href=""><i class="bi bi-eye-fill me-3"></i></a>
                                                <a href=""><i class="bi bi-pencil-square me-3"></i></a>
                                                <a href=""><i class="bi bi-trash-fill"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- End Data Tables First Approve --}}

                        {{-- Data Tables Second Approve --}}
                        <div class="tab-pane fade" id="secondapprove" role="tabpanel"
                            aria-labelledby="secondapprove-tab">
                            <div class="table-responsive mt-3">
                                <table class="table" id="dataTableSecond">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center">No</th>
                                            <th class="text-center">Asset Name</th>
                                            <th class="text-center">Type/Merk/Remark</th>
                                            <th class="text-center">Police Number</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">Due Date</th>
                                            <th class="text-center">Necessary</th>
                                            <th class="text-center">Applicant</th>
                                            <th class="text-center">First Approve</th>
                                            <th class="text-center">Second Approve</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">
                                                <a href=""><i class="bi bi-eye-fill me-3"></i></a>
                                                <a href=""><i class="bi bi-pencil-square me-3"></i></a>
                                                <a href=""><i class="bi bi-trash-fill"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- End Data Tables Second Approve --}}

                    </div><!-- End Default Tabs -->

                </div>
            </div>


            {{-- <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>List Form</span>
                            <button type="button" class="btn btn-success" data-name="add">ADD FORM</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center">No</th>
                                        <th class="text-center">Asset Name</th>
                                        <th class="text-center">Type/Merk/Remark</th>
                                        <th class="text-center">Police Number</th>
                                        <th class="text-center">QTY</th>
                                        <th class="text-center">Due Date</th>
                                        <th class="text-center">Necessary</th>
                                        <th class="text-center">Applicant</th>
                                        <th class="text-center">First Approve</th>
                                        <th class="text-center">Second Approve</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">
                                            <a href=""><i class="bi bi-eye-fill me-3"></i></a>
                                            <a href=""><i class="bi bi-pencil-square me-3"></i></a>
                                            <a href=""><i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </section>

    {{-- JS Datatable --}}
    <script>
        $(document).ready(function() {
            $('#dataTableDeptHead').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

    <script>
        $(document).ready(function() {
            $('#dataTableFirst').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dataTableSecond').DataTable();
        });
    </script>
    {{-- End JS Datatable --}}

@stop
