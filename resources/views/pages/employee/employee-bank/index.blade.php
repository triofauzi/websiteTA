@extends('layouts.master')

@section('title')
    Employee Bank
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Employee Bank',
        'li_1' => 'Employee',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('employee-bank.create') }}" class="btn btn-success">Create</a>
                        </div>

                        <form method="get">
                            <div class="d-flex gap-1">
                                <input type="text" id="search" name="search" class="form-control" placeholder="Search ...">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                                <th>Bank Name</th>
                                <th>Bank Branch</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach ($employeeBanks as $employeeBank)
                                    <tr>
                                        <td>{{ $employeeBank->bank_name }}</td>    
                                        <td>{{ $employeeBank->bank_branch }}</td>    
                                        <td>{{ $employeeBank->account_number }}</td>    
                                        <td>{{ $employeeBank->account_name }}</td>   
                                        <td>@if ($employeeBank->id == $employeeBank->user?->employee_payroll?->employee_bank_id) <span class="badge bg-secondary-success text-success badge-border">In Use</span> @else <span class="badge bg-secondary-subtle text-secondary badge-border">-</span> @endif</td>   
                                        <td>
                                            <a href="{{ route('employee-bank.edit', $employeeBank) }}" class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $employeeBank->id }}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a>
                                        </td> 
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $employeeBanks->withQueryString()->links() }}

                    @foreach ($employeeBanks as $employeeBank)
                        @include('components.delete-modal', [
                            'record' => $employeeBank,
                            'deleteRoute' => 'employee-bank.destroy'
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection