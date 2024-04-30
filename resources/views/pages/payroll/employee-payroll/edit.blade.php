@extends('layouts.master')

@section('title')
    Employee Payroll Data Edit
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Employee Payroll Data Edit',
        'li_1' => 'Employee Payroll Data',
        'li_1_route' => 'employee-payroll.index'
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('employee-payroll.update', $employeePayroll) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{ $employeePayroll->user_id }}">
                            </div>

                            <div class="form-group col-12">
                                <label for="salary" class="form-label">Salary <span class="text-danger">*</span></label>
                                <input type="text" id="salary" name="salary" class="form-control" value="{{ $employeePayroll->salary }}" placeholder="Salary">
                                @error('salary')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="employee_bank_id" class="form-label">Bank Payment Method</label>
                                <select name="employee_bank_id" id="employee_bank_id" class="form-select">
                                    <option value="">Select Employee Bank</option>
                                    @foreach (\App\Models\EmployeeBank::where('user_id', $employeePayroll->user_id)->get() as $empBank)
                                        <option value="{{ $empBank->id }}" {{ $empBank->id == $employeePayroll->employee_bank_id ? 'selected' : '' }}>{{ $empBank->bank_name . ' - ' . $empBank->account_number }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-end gap-1">
                                    <button type="submit" class="btn btn-success">Submit</button>
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