@extends('layouts.master')

@section('title')
    Users
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Users',
        'li_1' => 'Master Data',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('users.create') }}" class="btn btn-success">Create</a>
                        </div>
                        
                        <form method="get">
                            <div class="d-flex gap-1">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Search">
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
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_date)->format('D, d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->updated_date)->format('D, d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-secondary"><i class="ri-edit-line"></i></a>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $users->withQueryString()->links() }}

                    @foreach ($users as $user)
                        @include('components.delete-modal', [
                            'record' => $user,
                            'deleteRoute' => 'users.destroy'
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