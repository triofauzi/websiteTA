@extends('layouts.master')

@section('title')
    Retirement Request Create
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Retirement Request Create',
        'li_1' => 'Retirement Request',
        'li_1_route' => 'retirement-request.index'
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('components.error-dumper')
                    <form action="{{ route('retirement-request.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="letter_path" class="form-label">Letter Path</label>
                                <input type="file" id="letter_path" name="letter_path" value="{{ old("letter_path") }}" class="form-control">
                            </div>

                            <div class="col-12 form-group mt-3">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Submit</button>
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