@extends('layouts.master')

@section('title')
    Pay Slips
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Pay Slips',
        'li_1' => 'Payroll',
    ])

    <div class="row">
        <div class="col-12">
            <div class="swiper cryptoSlider">
                <div class="swiper-wrapper">
                    @foreach (\App\Models\EmployeeBank::where('user_id', Auth::user()->id)->get() as $empBank)
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-end">
                                        <div class="dropdown">
                                            <a class="text-reset" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-18"><i
                                                        class="mdi mdi-dots-horizontal"></i></span>
                                            </a>
                                            {{-- <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Details</a>
                                                <a class="dropdown-item" href="#">Remove Watchlist</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        {{-- <img src="{{ URL::asset('build/images/svg/crypto-icons/btc.svg') }}"
                                            class="bg-light rounded-circle p-1 avatar-xs img-fluid shadowarket Stat"
                                            alt=""> --}}
                                        <h6 class="ms-2 mb-0 fs-14">{{ $empBank->bank_name }}</h6>
                                    </div>
                                    <div class="row align-items-end g-0">
                                        <div class="col-6">
                                            <h5 class="mb-1 mt-4">{{ $empBank->account_number }}</h5>
                                            <p class="text-success fs-13 fw-medium mb-0">{{ $empBank->bank_branch }}<span
                                                    class="text-muted ms-2 fs-10">{{ $empBank->currency }}</span></p>
                                        </div><!-- end col -->
                                        <div class="col-6">
                                            {{-- <div class="apex-charts crypto-widget"
                                                data-colors='["--vz-success" , "--vz-transparent"]'
                                                id="bitcoin_sparkline_charts" dir="ltr"></div> --}}
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end -->
                    @endforeach
                </div><!-- end swiper wrapper -->
            </div><!-- end swiper -->
        </div>

        <div class="col-12">
            @include('components.alert')
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex gap-1">
                            @if (Auth::user()->hasNoParentJobPosition())
                                {{-- payment process modal --}}
                                <a data-bs-toggle="modal" data-bs-target="#paymentProcessModal"
                                    class="btn btn-success">Payment Process</a>
                                @include('pages.payroll.payslip.components.payment-process')
                                
                                {{-- employee payroll modal --}}
                                {{-- <a data-bs-toggle="modal" data-bs-target="#employeePayrollModal"
                                    class="btn btn-success">Employee Payroll Data</a>
                                @include('pages.payroll.payslip.components.employee-payroll-modal') --}}
                            @endif
                        </div>

                        <form method="get">
                            <select name="period_filter" id="period_filter" class="form-select" onchange="this.form.submit()">
                                <option value="">Select Period</option>
                                @foreach (\App\Models\PayrollPeriod::all() as $payPeriod)
                                    <option value="{{ $payPeriod->id }}" {!! $payPeriod->id == request()->get('period_filter') ? 'selected' : '' !!}>{{ $payPeriod->period_code }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Period Code</th>
                                    <th>Pay Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($paySlips as $paySlip)
                                    <tr>
                                        <td>{{ $paySlip->user?->biodatum?->first_name . ' ' . $paySlip->user?->biodatum?->middle_name . ' ' . $paySlip->user?->biodatum?->last_name }}</td>
                                        <td>{{ $paySlip->payroll_period?->period_code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($paySlip->payroll_period?->pay_date)->format('D d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('pay-slip.download', $paySlip) }}"
                                                class="btn btn-sm btn-soft-secondary"><i class="ri-file-list-line"></i></a>
                                            {{-- <a href="{{ route('pay-slip.edit', $paySlip) }}"
                                                class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $paySlip->id }}"
                                                class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @foreach ($paySlips as $paySlip)
                        @include('components.delete-modal', [
                            'record' => $paySlip,
                            'deleteRoute' => 'pay-slip.destroy',
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>


    <script src="{{ URL::asset('build/js/pages/crypto-wallet.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
