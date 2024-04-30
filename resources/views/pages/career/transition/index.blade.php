@extends('layouts.master')

@section('title')
    Career Transition
@endsection

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Transition',
        'li_1' => 'Career',
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <form method="get">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search ...">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Letter</th>
                                    <th>Promotion Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($careerTranstionHistories as $careerTransitionHistory)
                                    <tr>
                                        <td>{{ $careerTransitionHistory->user?->employeeFullName() }}</td>
                                        <td>{{ $careerTransitionHistory->job_position_from?->department . ' - ' . $careerTransitionHistory->job_position_from?->name }}</td>
                                        <td>{{ $careerTransitionHistory->job_position_to?->department . ' - ' . $careerTransitionHistory->job_position_to?->name }}</td>
                                        <td><a href="{{ route('career-transition-history.download-letter', $careerTransitionHistory) }}">download</a></td>
                                        <td>{{ \Carbon\Carbon::parse($careerTransitionHistory->created_at)->format('D, m Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $careerTranstionHistories->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection