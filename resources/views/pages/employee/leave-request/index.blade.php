@extends('layouts.master')

@section('title')
    Leave Requests
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Leave Requests',
        'li_1' => 'Employee',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a data-bs-toggle="modal" data-bs-target="#createLeaveRequestModal" class="btn btn-success">Create</a>
                            @include('pages.employee.leave-request.components.create-modal')
                            <a data-bs-toggle="modal" data-bs-target="#generateLeaveLetterModal" class="btn btn-success">Leave Letter</a>
                            @include('pages.employee.leave-request.components.leave-letter-generator-modal')
                        </div>

                        <div>
                            <form method="get">
                                <input type="text" id="search" name="search" class="form-control"
                                    placeholder="Search ...">
                            </form>
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
                    <div class="table-responsive">
                        <table class="table table-nowrap table-borderless">
                            <thead>
                                <tr>
                                    <th>Emlpoyee</th>
                                    <th>Request Date</th>
                                    <th>Leave Date</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($leaveRequests as $leaveRequest)
                                    <tr>
                                        <td>{{ $leaveRequest->user?->employeeFullName() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leaveRequest->created_at)->format('d, M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leaveRequest->leave_date_from)->format('d, M Y') . ' - ' . \Carbon\Carbon::parse($leaveRequest->leave_date_to)->format('d, M Y') }}</td>
                                        <td>{{ $leaveRequest->reason }}</td>
                                        <td><span
                                                class="badge bg-{{ strtolower($leaveRequest->status) == 'request' ? 'warning' : 'success' }}-subtle text-{{ strtolower($leaveRequest->status) == 'request' ? 'warning' : 'success' }} text-uppercase">{{ $leaveRequest->status }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                @if (Auth::user()->hasNoParentJobPosition())
                                                    <form action="{{ route('leave-request.approve', $leaveRequest) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="btn btn-sm btn-success"><i
                                                                class="ri-checkbox-line"></i></button>
                                                    </form>
                                                @endif
                                                @if (strtolower($leaveRequest->status) == 'request')
                                                    <a href="{{ route('leave-request.edit', $leaveRequest) }}"
                                                        class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $leaveRequest->id }}"
                                                        class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $leaveRequests->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
