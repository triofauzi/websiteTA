@extends('layouts.master')

@section('title')
    Employee Payroll Data
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Employee Payroll Data',
        'li_1' => 'Payroll',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <form action="">
                            <input type="text" class="form-control" placeholder="Search ...">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('components.alert')
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Salary</th>
                                    <th>Employee Payment Bank</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->biodatum?->first_name . ' ' . $user->biodatum?->middle_name . ' ' . $user->biodatum?->last_name }}</td>
                                        <td>{{ 'Rp ' . number_format($user->employee_payroll?->salary, 2, ',', '.') }}</td>
                                        <td>{{ $user->employee_payroll?->employee_bank?->bank_name . ' - ' . $user->employee_payroll?->employee_bank?->account_number }}</td>
                                        <td>
                                            <a href="{{ route('employee-payroll.edit', ['employeePayroll' => $user->employee_payroll]) }}" class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->employee_payroll?->id }}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection