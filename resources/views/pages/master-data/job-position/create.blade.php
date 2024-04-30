@extends('layouts.master')

@section('title')
    Job Position Create
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Job Position Create',
        'li_1' => 'Job Position',
        'li_1_route' => 'job-position.index'
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('job-position.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name" class="form-label">Job Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Job Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="parent_id" class="form-label">Parent Position</label>
                                <select name="parent_id" id="parent_id" data-choices class="form-select">
                                    <option value="">Select Parent Position</option>
                                    @foreach (\App\Models\JobPosition::orderBy('name', 'asc')->get() as $job)
                                        <option value="{{ $job->id }}">{{ $job->name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" id="department" name="department" value="{{ old('department') }}" class="form-control" placeholder="Department">
                                @error('department')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="salary_range" class="form-label">Salary Range</label>
                                <input type="text" id="salary_range" name="salary_range" value="{{ old('salary_range') }}" class="form-control" placeholder="Salary Range">
                                <small class="text-muted">Example : "1000 - 5000" or "IDR 5000 - 10000"</small>
                                @error('salary_range')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="job_type" class="form-label">Job Type</label>
                                <select name="job_type" id="job_type" data-choices class="form-select">
                                    <option value="">Select Job Type</option>
                                    <option value="Contract" {!! old('job_type') == 'Contract' ? 'selected' : '' !!}>Contract</option>
                                    <option value="Permanent" {!! old('job_type') == 'Permanent' ? 'selected' : '' !!}>Permanent</option>
                                    <option value="Parttime" {!! old('job_type') == 'Parttime' ? 'selected' : '' !!}>Part-time</option>
                                </select>
                                @error('job_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-group col-12 mt-3">
                                <label for="job_place" class="form-label">Job Place</label>
                                <input type="text" id="job_place" name="job_place" value="{{ old('job_place') }}" class="form-control" placeholder="Job Place">
                                @error('job_place')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="expected_experience" class="form-label">Expected Experience</label>
                                <input type="text" id="expected_experience" name="expected_experience" value="{{ old('expected_experience') }}" class="form-control" placeholder="Expected Experience">
                                <small class="text-muted">Example : "0 - 2 Years" or "4 - 6 Years"</small>
                                @error('expected_experience')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <!-- Custom Checkboxes Color -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_need_candidate" name="is_need_candidate" {!! old('is_need_candidate') == 'Y' ? 'checked' : '' !!}>
                                    <label class="form-check-label" for="is_need_candidate">
                                        Set As Need Candidate
                                    </label>
                                </div>
                                @error('is_need_candidate')
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
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection