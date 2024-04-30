@extends('layouts.master')

@section('title')
    Payroll Period Edit
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Payroll Period Edit',
        'li_1' => 'Payroll Period',
        'li_1_route' => 'payroll-period.index',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('payroll-period.update', $payrollPeriod) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="period_code" class="form-label">Period Period</label>
                                <input type="text" id="period_code" name="period_code"
                                    value="{{ $payrollPeriod->period_code }}" class="form-control" placeholder="Payroll Code">
                                @error('period_code')
                                    <small class="text-danger">{{ $messsage }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="pay_date" class="form-label">Pay Date</label>
                                <input type="date" id="pay_date" name="pay_date" value="{{ \Carbon\Carbon::parse($payrollPeriod->pay_date)->format('Y-m-d') }}"
                                    class="form-control" placeholder="Pay Date">
                                @error('pay_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                    placeholder="Description">{{ $payrollPeriod->description }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success">Submit</button>
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
