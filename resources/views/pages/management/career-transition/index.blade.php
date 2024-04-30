@extends('layouts.master')

@section('title')
    Career Transition
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Career Transition',
        'li_1' => 'Management',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>

                        </div>

                        <form action="">
                            <select name="department_filter" id="department_filter" class="form-select" onchange="this.form.submit()">
                                <option value="">Select Department</option>
                                @foreach (\App\Models\JobPosition::select('department')->groupBy('department')->get() as $job)
                                    <option value="{{ $job->department }}" {!! $job->department == request()->get('department_filter') ? 'selected' : '' !!}>{{ $job->department }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('components.alert')
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap table-borderless">
                            <thead>
                                <td>Employee Name</td>
                                <td>Current Position</td>
                                <td>Current Department</td>
                                <td>Action</td>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->biodatum?->first_name . ' ' . $user->biodatum?->middle_name . ' ' . $user->biodatum?->last_name }}</td>
                                        <td>{{ $user->job_position?->name }}</td>
                                        <td>{{ $user->job_position?->department }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $user->id }}" class="btn btn-sm btn-secondary"><i class="ri-file-upload-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $users->withQueryString()->links() }}

                    @foreach ($users as $user)
                        @include('pages.management.career-transition.components.confirmation-modal')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection