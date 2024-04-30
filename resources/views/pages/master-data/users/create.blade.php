@extends('layouts.master')

@section('title')
    User Create
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'User Create',
        'li_1' => 'Users',
        'li_1_route' => 'users.index'
    ])

    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-12 col-xl-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3 mt-xl-0 col-12 col-xl-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                            placeholder="Email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 mt-3">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
