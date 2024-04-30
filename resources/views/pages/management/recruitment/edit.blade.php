@extends('layouts.master')

@section('title')
    Job Application Edit
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Job Application Edit',
        'li_1' => 'Job Application',
        'li_1_route' => 'job-application.index'
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('job-application.update', $jobApplication) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="form-group mt-12">
                                <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" id="full_name" value="{{ $jobApplication->full_name }}"
                                    class="form-control" placeholder="First Name">
                                @error('full_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
        
                            <div class="form-group mt-3 col-12 col-md-6">
                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select name="gender" id="gender" data-choices class="form-select">
                                    <option value="">Select Gender</option>
                                    <option value="laki-laki" {!! $jobApplication->gender == 'laki-laki' ? 'selected' : '' !!}>Laki-laki</option>
                                    <option value="perempuan" {!! $jobApplication->gender == 'perempuan' ? 'selected' : '' !!}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
        
                            <div class="form-group mt-3 col-12 col-md-6">
                                <label for="phone_number" class="form-label">Phone Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="phone_number" id="phone_number" value="{{ $jobApplication->phone_number }}"
                                    class="form-control" placeholder="Phone Number">
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
        
                            <div class="form-group mt-3 col-12 col-xl-6">
                                <label for="place_of_birth" class="form-label">Birth Place <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="place_of_birth" id="place_of_birth"
                                    value="{{ $jobApplication->place_of_birth }}" class="form-control" placeholder="Birth Place">
                                @error('place_of_birth')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
        
                            <div class="form-group mt-3 col-12 col-xl-6">
                                <label for="date_of_birth" class="form-label">Birth Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ \Carbon\Carbon::parse($jobApplication->date_of_birth)->format('Y-m-d') }}"
                                    class="form-control" placeholder="Birth Date">
                                @error('date_of_birth')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
        
                            <div class="form-group mt-3 col-12">
                                <label for="email" class="form-label">Personal Email<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="email" id="email" value="{{ $jobApplication->email }}"
                                    class="form-control" placeholder="Personal Email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
        
                            <div class="form-group mt-3 col-12">
                                <label for="residence_address" class="form-label">Residence Address <span
                                        class="text-danger">*</span></label>
                                <textarea type="text" name="residence_address" id="residence_address" class="form-control" cols="30"
                                    rows="4" placeholder="Residence Address">{{ $jobApplication->residence_address }}</textarea>
                                @error('residence_address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
        
                            <div class="form-group col-12 mt-3">
                                <label for="job_position_id" class="form-label">Job Position</label>
                                <select name="job_position_id" id="job_position_id" data-choices class="form-select">
                                    <option value="">Select Job to Apply</option>
                                    @foreach (\App\Models\JobPosition::orderBy('name', 'asc')->get() as $position)
                                        <option value="{{ $position->id }}" {!! $jobApplication->job_position_id == $position->id ? 'selected' : '' !!}>{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
        
                            <div class="form-group col-12 mt-3">
                                <label for="curriculum_vitae" class="form-label">Curriculum Vitae (CV)</label>
                                <input type="file" name="curriculum_vitae" id="curriculum_vitae" class="form-control">
                                @error('curriculum_vitae')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="application_status" class="form-label">Status</label>
                                <select name="application_status" id="application_status" data-choices class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="submitted" {!! $jobApplication->application_status == 'submitted' ? 'selected' : '' !!}>Submitted</option>
                                    <option value="rejected" {!! $jobApplication->application_status == 'rejected' ? 'selected' : '' !!}>Rejected</option>
                                    <option value="approved" {!! $jobApplication->application_status == 'approved' ? 'selected' : '' !!}>Approved</option>
                                </select>
                            </div>
        
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success">Submit</button>
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