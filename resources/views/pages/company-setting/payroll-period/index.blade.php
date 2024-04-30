@extends('layouts.master')

@section('title')
    Payroll Period
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Payroll Period',
        'li_1' => 'Company Setting',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('payroll-period.create') }}" class="btn btn-success">Create</a>
                        </div>

                        <form method="get">
                            <div class="d-flex gap-1">
                                <input type="text" id="search" name="search" class="form-control" value="{{ request()->get('search') }}" placeholder="Search ...">
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
                                <tr>
                                    <th>Period Code</th>
                                    <th>Paydate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($payrollPeriods as $payrollPeriod)
                                    <tr>
                                        <td>{{ $payrollPeriod->period_code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($payrollPeriod->pay_date)->format('D, d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('payroll-period.edit', $payrollPeriod) }}" class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $payrollPeriod->id }}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $payrollPeriods->withQueryString()->links() }}

                    @foreach ($payrollPeriods as $payrollPeriod)
                        @include('components.delete-modal', [
                            'record' => $payrollPeriod,
                            'deleteRoute' => 'payroll-period.destroy'
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