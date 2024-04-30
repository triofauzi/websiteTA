@extends('layouts.master')

@section('title')
    Payslip Generator
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Payslip Generator',
        'li_1' => 'Report',
    ])

    <div class="row">
        <div class="col-12">
            @include('components.alert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pay-slip.generate') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="emp_join_date" class="form-label">Employee Join Date</label>
                                <input type="date" id="emp_join_date" name="emp_join_date" class="form-control" required>
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="emp_name" class="form-label">Employee Name</label>
                                <input type="text" id="emp_name" name="emp_name" class="form-control" placeholder="Employee Name" required>
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" id="department" name="department" class="form-control" placeholder="Department" required>
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" id="designation" name="designation" class="form-control" placeholder="Designation" required>
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="amount_salary" class="form-label">Salary</label>
                                <input type="text" id="amount_salary" name="amount_salary" class="form-control" placeholder="Salary" required>
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="amount_total_earnings" class="form-label">Amount Total Earning</label>
                                <input type="text" id="amount_total_earnings" name="amount_total_earnings" class="form-control" placeholder="Amount Total Earning" required>
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="amount_net_pay" class="form-label">Net Pay</label>
                                <input type="text" id="amount_net_pay" name="amount_net_pay" class="form-control" placeholder="Net Pay" required>
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="payroll_period" class="form-label">Payroll Period</label>
                                <select name="payroll_period" id="payroll_period" class="form-select">
                                    <option value="">Select Payroll Period</option>
                                    @foreach (\App\Models\PayrollPeriod::orderBy('pay_date', 'asc')->get() as $payrollPeriod)
                                        <option value="{{ $payrollPeriod->period_code }}">{{ $payrollPeriod->period_code }}</option>
                                    @endforeach
                                </select>
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