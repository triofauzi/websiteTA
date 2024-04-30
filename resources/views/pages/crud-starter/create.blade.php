@extends('layouts.master')

@section('title')
    Starter
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Create',
        'li_1' => 'Parent Menu',
    ])
    
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection