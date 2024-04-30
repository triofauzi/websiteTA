@extends('layouts.master')

@section('title')
    Starter
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'User Show',
        'li_1' => 'Users',
        'li_1_route' => 'users.index'
    ])
    
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection