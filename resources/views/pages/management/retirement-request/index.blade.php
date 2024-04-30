@extends('layouts.master')

@section('title')
    Retirement Requests
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Retirement Requests',
        'li_1' => 'Management',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between gap-1">
                        <a href="{{ route('retirement-request.create') }}" class="btn btn-success">Create</a>

                        <form method="get">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search ...">
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
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Request Date</th>
                                    <th>Retirement Letter</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($retirementRequests as $retirementRequest)
                                    <tr>
                                        <td>{{ $retirementRequest->user?->employeeFullName() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($retirementRequest->created_at)->format('d, M Y') }}</td>
                                        <td>
                                            <a href="{{ strtolower($retirementRequest->status) == 'request' ? '#' : route('retirement-request.download', $retirementRequest) }}">
                                                <div class="d-flex gap-1 align-items-center">
                                                    <i class="ri-download-2-fill"></i>
                                                    <span>download</span>
                                                </div>
                                            </a>
                                        </td>
                                        <td><span
                                            class="badge bg-{{ strtolower($retirementRequest->status) == 'request' ? 'warning' : 'success' }}-subtle text-{{ strtolower($retirementRequest->status) == 'request' ? 'warning' : 'success' }} text-uppercase">{{ $retirementRequest->status }}</span></td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                {{-- retirement approval modal --}}
                                                @if (strtolower($retirementRequest->status) == 'request')
                                                <a data-bs-toggle="modal" data-bs-target="#retirementApprovalModal"
                                                    class="btn btn-sm btn-success"><i class="ri-checkbox-line"></i></a>
                                                @endif
                                                {{-- retirement approval modal --}}
                                                {{-- <a href="{{ route('retirement-request.edit', $retirementRequest) }}"
                                                    class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a> --}}
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $retirementRequest->id }}"
                                                    class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $retirementRequests->withQueryString()->links() }}

                    @foreach ($retirementRequests as $retirementRequest)
                        @include('components.delete-modal', [
                            'record' => $retirementRequest,
                            'deleteRoute' => 'retirement-request.destroy',
                        ])
                        @include('pages.management.retirement-request.components.retirement-request-approval-modal')
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
