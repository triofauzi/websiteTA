@extends('layouts.master')

@section('title')
    Employee Bank Create
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Employee Bank Create',
        'li_1' => 'Employee Bank',
        'li_1_route' => 'employee-bank.index',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('employee-bank.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="Account Name" class="form-label">Account Name</label>
                                <input type="text" id="account_name" name="account_name" class="form-control"
                                    value="{{ old('account_name') }}" placeholder="Account Name">
                                @error('account_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" id="account_number" name="account_number" class="form-control"
                                    value="{{ old('account_number') }}" placeholder="Account Number">
                                @error('account_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="currency" class="form-label">Currency</label>
                                <input type="text" id="currency" name="currency" class="form-control"
                                    value="{{ old('currency') }}" placeholder="Currency">
                                @error('currency')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" id="bank_name" name="bank_name" class="form-control"
                                    value="{{ old('bank_name') }}" placeholder="Bank Name">
                                @error('bank_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-12 mt-3">
                                <label for="bank_branch" class="form-label">Bank Branch</label>
                                <input type="text" id="bank_branch" name="bank_branch" class="form-control"
                                    value="{{ old('bank_branch') }}" placeholder="Bank Branch">
                                @error('bank_branch')
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
