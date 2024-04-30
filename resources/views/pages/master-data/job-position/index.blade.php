@extends('layouts.master')

@section('title')
    Job Position
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Job Position',
        'li_1' => 'Master Data',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('job-position.create') }}" class="btn btn-success">Create</a>
                        </div>

                        <form method="get">
                            <div class="d-flex gap-1">
                                <input type="text" id="search" name="search" value="{{ old('search') }}"
                                    class="form-control" placeholder="Search ...">
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
                                <tr>
                                    <th>Job Name</th>
                                    <th>Parent Position</th>
                                    <th>Department</th>
                                    <th>Salary Range</th>
                                    <th>Description</th>
                                    <th>Job Type</th>
                                    <th>Job Place</th>
                                    <th>Experience Requirement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jobPositions as $jobPosition)
                                    <tr>
                                        <td>{{ $jobPosition->name }}</td>
                                        <td>{{ $jobPosition->parent_position?->department . ' - ' . $jobPosition->parent_position?->name }}</td>
                                        <td>{{ $jobPosition->department }}</td>
                                        <td>{{ $jobPosition->salary_range }}</td>
                                        <td>{{ $jobPosition->description }}</td>
                                        <td>{{ $jobPosition->job_type }}</td>
                                        <td>{{ $jobPosition->job_place }}</td>
                                        <td>{{ $jobPosition->expected_experience }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('job-position.edit', $jobPosition) }}"
                                                    class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a>
                                                <a data-bs-toggle data-bs-target="deleteModal{{ $jobPosition->id }}" class="btn btn-sm btn-danger"><i
                                                        class="ri-delete-bin-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $jobPositions->withQueryString()->links() }}

                    @foreach ($jobPositions as $jobPosition)
                        @include('components.delete-modal', [
                            'record' => $jobPosition,
                            'deleteRoute' => 'job-position.destroy'
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
