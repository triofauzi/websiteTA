@extends('layouts.master')

@section('title')
    Retirement Letter Generator
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Retirement Letter Generator',
        'li_1' => 'Report',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('retirement-request.generate') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="letter_number" class="form-label">Letter Number</label>
                                <input type="text" id="letter_number" name="letter_number" class="form-control" placeholder="Letter Number" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="letter_subject" class="form-label">Letter Subject</label>
                                <input type="text" id="letter_subject" name="letter_subject" class="form-control" placeholder="Letter Subject" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="employee_name" class="form-label">Employee Name</label>
                                <input type="text" id="employee_name" name="employee_name" class="form-control" placeholder="Employee Name" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="identity_number" class="form-label">Identity Number</label>
                                <input type="text" id="identity_number" name="identity_number" class="form-control" placeholder="Identity Number" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="job_department" class="form-label">Department</label>
                                <input type="text" id="job_department" name="job_department" class="form-control" placeholder="Department" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="job_grade" class="form-label">Job Grade</label>
                                <input type="text" id="job_grade" name="job_grade" class="form-control" placeholder="Job Grade" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="employee_join_date" class="form-label">Employee Join Date</label>
                                <input type="date" id="employee_join_date" name="employee_join_date" class="form-control" placeholder="Employee Join Date" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="letter_location" class="form-label">Letter Location</label>
                                <input type="text" id="letter_location" name="letter_location" class="form-control" placeholder="Letter Location" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Generate</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection