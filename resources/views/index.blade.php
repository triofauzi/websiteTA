@extends('layouts.master')
@section('title') @lang('translation.dashboards') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Good Morning, {{ explode(" ", Str::title(Auth::user()->name))[0] }}!</h4>
                            <p class="text-muted mb-0">Here's what's happening with you today.</p>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            @php
                                $startDate = \Carbon\Carbon::parse(Auth::user()->created_at);
                                $endDate =\Carbon\Carbon::parse(now());

                                $dateDifference = $startDate->diff($endDate);

                                $lengthOfServiceString = '';
                                if ($dateDifference->y > 0) {
                                    $lengthOfServiceString .= $dateDifference->y . ' Year' . ($dateDifference->y > 1 ? 's ' : ' ');
                                }
                                if ($dateDifference->m > 0) {
                                    $lengthOfServiceString .= $dateDifference->m . ' Month' . ($dateDifference->m > 1 ? 's ' : ' ');
                                }
                                if ($dateDifference->d > 0) {
                                    $lengthOfServiceString .= $dateDifference->d . ' Day' . ($dateDifference->d > 1 ? 's ' : ' ');
                                }
                                $lengthOfServiceString = trim($lengthOfServiceString);
                            @endphp
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">My Join Date</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> {{ $lengthOfServiceString }}
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"> {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('D, d M Y') }}
                                    </h4>
                                    <a href="{{ route('personal-information.index') }}" class="text-decoration-underline">view my information</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success rounded fs-3">
                                        <i class="ri-map-pin-time-line"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>

@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
