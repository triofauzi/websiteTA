@extends('layouts.master')

@section('title')
    Leave Request
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Leave Request Edit',
        'li_1' => 'Leave Request',
        'li_1_route' => 'leave-request.index'
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('leave-request.update', $leaveRequest) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="leave_date_from" class="form-label">Leave Date From</label>
                                <input type="date" id="leave_date_from" name="leave_date_from" value="{{ \Carbon\Carbon::parse($leaveRequest->leave_date_from)->format('Y-m-d') }}" class="form-control">
                                @error('leave_date_from')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="leave_date_to" class="form-label">Leave Date To</label>
                                <input type="date" id="leave_date_to" name="leave_date_to" value="{{ \Carbon\Carbon::parse($leaveRequest->leave_date_to)->format('Y-m-d') }}" class="form-control">
                                @error('leave_date_to')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="reason" class="form-label">Reason</label>
                                <input type="text" id="reason" name="reason" class="form-control" value="{{ $leaveRequest->reason }}" placeholder="Reason">
                                @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" placeholder="description">{{ $leaveRequest->description }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="attachment" class="form-label">Attachment</label>
                                <input type="file" id="attachment" name="attachment" class="form-control" placeholder="Attachment">
                                @error('attachment')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-end">
                                    <a href="javascript:void(0);"
                                        class="btn btn-link shadow-none link-success fw-medium"
                                        data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                        Close</a>
                                    <button type="submit" class="btn btn-primary ">Process</button>
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