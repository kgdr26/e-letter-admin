@extends('main')
@section('content')
    <section class="section dashboard">
        <div class="row align-items-top">

            <div class="col-lg-12">
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
            </div>

        </div>
    </section>

@stop
