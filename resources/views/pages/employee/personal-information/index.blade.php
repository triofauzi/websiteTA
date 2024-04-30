@extends('layouts.master')

@section('title')
    Personal Information
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Personal Information',
        'li_1' => 'Employee',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between gap-1">
                        <div></div>
                        <div>
                            @if (count(Auth::user()->retirement_requests) != 0)
                                @if (strtolower(Auth::user()->retirement_requests[0]?->status) == 'approved')
                                <a href="{{ route('retirement-request.download', Auth::user()->retirement_requests[0]) }}" class="btn btn-primary">Download Retirement Letter</a>
                                @endif
                            @endif
                            <a data-bs-toggle="modal" data-bs-target="#retirementRequestModal"
                                class="btn @if (count(Auth::user()->retirement_requests) == 0) btn-danger @else btn-soft-dark @endif">Retirement Request</a>
                            @include('pages.employee.personal-information.components.retirement-request-modal')
                        </div>
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
                    <form action="{{ route('personal-information.update', $biodata) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="identity_number" class="form-label">Identity Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="identity_number" id="identity_number"
                                    value="{{ $biodata->identity_number }}" class="form-control"
                                    placeholder="Identity Number (NIK)" required>
                                @error('identity_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12 col-xl-3">
                                <label for="salutation" class="form-label">Salutation <span
                                        class="text-danger">*</span></label>
                                <select name="salutation" id="salutation" data-choices class="form-select" required>
                                    <option value="">Select Salutation</option>
                                    <option value="bapak" {!! $biodata->salutation == 'bapak' ? 'selected' : '' !!}>Bapak</option>
                                    <option value="ibu" {!! $biodata->salutation == 'ibu' ? 'selected' : '' !!}>Ibu</option>
                                </select>
                                @error('salutation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12 col-xl-3">
                                <label for="first_name" class="form-label">First Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" value="{{ $biodata->first_name }}"
                                    class="form-control" placeholder="First Name" required>
                                @error('first_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12 col-xl-3">
                                <label for="middle_name" class="form-label">Middle Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="middle_name" id="middle_name"
                                    value="{{ $biodata->middle_name }}" class="form-control" placeholder="Middle Name"
                                    required>
                                @error('middle_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12 col-xl-3">
                                <label for="last_name" class="form-label">Last Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" value="{{ $biodata->last_name }}"
                                    class="form-control" placeholder="Last Name" required>
                                @error('last_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12 col-md-6">
                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select name="gender" id="gender" data-choices class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="laki-laki" {!! $biodata->gender == 'laki-laki' ? 'selected' : '' !!}>Laki-laki</option>
                                    <option value="perempuan" {!! $biodata->gender == 'perempuan' ? 'selected' : '' !!}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12 col-md-6">
                                <label for="phone_number" class="form-label">Phone Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="phone_number" id="phone_number"
                                    value="{{ $biodata->phone_number }}" class="form-control" placeholder="Phone Number"
                                    required>
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12 col-xl-6">
                                <label for="place_of_birth" class="form-label">Birth Place <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="place_of_birth" id="place_of_birth"
                                    value="{{ $biodata->place_of_birth }}" class="form-control" placeholder="Birth Place"
                                    required>
                                @error('place_of_birth')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12 col-xl-6">
                                <label for="date_of_birth" class="form-label">Birth Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ \Carbon\Carbon::parse($biodata->date_of_birth)->format('Y-m-d') }}"
                                    class="form-control" placeholder="Birth Date" required>
                                <small class="text-muted">Format : mm / dd / yyyy</small>
                                @error('date_of_birth')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12">
                                <label for="personal_email" class="form-label">Personal Email <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="personal_email" id="personal_email"
                                    value="{{ $biodata->personal_email }}" class="form-control"
                                    placeholder="Personal Email" required>
                                @error('personal_email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3 col-12">
                                <label for="address" class="form-label">Address <span
                                        class="text-danger">*</span></label>
                                <textarea type="text" name="address" id="address" class="form-control" cols="30" rows="4"
                                    placeholder="Address" required>{{ $biodata->address }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
