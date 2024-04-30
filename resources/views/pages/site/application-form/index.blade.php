@extends('layouts.master-without-nav')

@section('title')
    Application
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
        <!-- Begin page -->
        <div class="layout-wrapper landing">
            @include('pages.site.application-form.components.navbar')
            @include('pages.site.application-form.components.hero')
            {{-- @include('pages.site.application-form.components.process')
            @include('pages.site.application-form.components.features')
            @include('pages.site.application-form.components.services') --}}
            @include('pages.site.application-form.components.form')
            @include('pages.site.application-form.components.footer')

            <!--start back-to-top-->
            <button onclick="topFunction()" class="btn btn-info btn-icon landing-back-top" id="back-to-top">
                <i class="ri-arrow-up-line"></i>
            </button>
            <!--end back-to-top-->

        </div>
        <!-- end layout wrapper -->
    @endsection
    @section('script')
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ URL::asset('build/js/pages/job-lading.init.js') }}"></script>
    @endsection
