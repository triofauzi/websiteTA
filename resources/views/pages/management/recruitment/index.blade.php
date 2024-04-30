@extends('layouts.master')

@section('title')
    Job Applications
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Job Applications',
        'li_1' => 'Management',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div></div>

                        <form method="get">
                            <div class="d-flex gap-1">
                                <select name="job_filter" id="job_filter" onchange="this.form.submit()" data-choices
                                    class="form-select">
                                    <option value="">Select Job Position</option>
                                    @foreach (\App\Models\JobPosition::orderBy('name', 'asc')->get() as $job)
                                        <option value="{{ $job->id }}" {!! request()->get('job_filter') == $job->id ? 'selected' : '' !!}>{{ $job->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <select name="status_filter" id="status_filter" onchange="this.form.submit()" data-choices
                                    class="form-select">
                                    <option value="">Select Status Filter</option>
                                    <option value="submitted" {!! request()->get('status_filter') == 'submitted' ? 'selected' : '' !!}>Submitted</option>
                                    <option value="rejected" {!! request()->get('status_filter') == 'rejected' ? 'selected' : '' !!}>Rejected</option>
                                    <option value="approved" {!! request()->get('status_filter') == 'approved' ? 'selected' : '' !!}>Approved</option>
                                    <option value="joined" {!! request()->get('status_filter') == 'joined' ? 'selected' : '' !!}>Joined</option>
                                </select>

                                <input type="text" id="search" name="search" class="form-control"
                                    placeholder="Search ...">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
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
                        <table class="table table-nowrap">
                            <thead>
                                <th>Recruiter</th>
                                <th>Job Position</th>
                                <th>Email</th>
                                <th>Domicile</th>
                                <th>Curriculum Vitae</th>
                                <th>Submited Date</th>
                                <th>Current Status</th>
                                <th>Recruitment Letter</th>
                                <th>Created Date</th>
                                <th>Updated Date</th>
                                <th>Actions</th>
                            </thead>

                            <tbody>
                                @foreach ($jobApplications as $jobApplication)
                                    <tr>
                                        <td>
                                            {{ $jobApplication->full_name }}
                                            {{ $jobApplication->phone_number }}
                                        </td>
                                        <td>{{ $jobApplication->job_position?->department . ' - ' . $jobApplication->job_position?->name }}
                                        </td>
                                        <td><a href="mailto:{{ $jobApplication->email }}"
                                                target="_blank">{{ $jobApplication->email }}</a></td>
                                        <td>{{ $jobApplication->residence_address }}</td>
                                        <td>
                                            <a href="{{ route('job-application.download-cv', $jobApplication) }}">
                                                <div class="d-flex gap-1 align-items-center">
                                                    <i class="ri-download-2-fill"></i>
                                                    <span>download</span>
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($jobApplication->created_at)->format('D, d M Y') }}
                                        </td>
                                        <td>{{ Str::title($jobApplication->application_status) }}</td>
                                        <td>
                                            @if (strtoupper($jobApplication->application_status) == 'APPROVED')
                                                <a href="#">
                                                    <div class="d-flex gap-1 align-items-center">
                                                        <i class="ri-download-2-fill"></i>
                                                        <span>download</span>
                                                    </div>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($jobApplication->created_at)->format('D, d M Y H:i:s') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($jobApplication->updated_at)->format('D, d M Y H:i:s') }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('job-application.edit', $jobApplication) }}"
                                                    class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a>
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $jobApplication->id }}"
                                                    class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a>
                                                @if (Str::upper($jobApplication->application_status) === 'APPROVED')
                                                    <a href="{{ route('job-application.register-employee', $jobApplication) }}"
                                                        class="btn btn-sm btn-success"><i class="ri-checkbox-line"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $jobApplications->withQueryString()->links() }}

                    @foreach ($jobApplications as $jobApplication)
                        @include('components.delete-modal', [
                            'record' => $jobApplication,
                            'deleteRoute' => 'job-application.destroy',
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
