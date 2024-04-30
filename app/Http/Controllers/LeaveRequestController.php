<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Http\Requests\StoreLeaveRequestRequest;
use App\Http\Requests\UpdateLeaveRequestRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use mikehaertl\pdftk\Pdf;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveRequests = LeaveRequest::query()
            ->where(function ($query) {
                if (!Auth::user()->hasNoParentJobPosition()) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->paginate(10);

        return view('pages.employee.leave-request.index', [
            'leaveRequests' => $leaveRequests 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequestRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store(LeaveRequest::ATTACHMENT_PATH, 'public');
        }

        $data['user_id'] = Auth::user()->id;

        $leaveRequest = LeaveRequest::make($data);
        $leaveRequest->saveOrFail();

        return redirect()->route('leave-request.index')->with(['success' => 'Successfully created leave request']);
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        return view('pages.employee.leave-request.edit', [
            'leaveRequest' => $leaveRequest
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveRequestRequest $request, LeaveRequest $leaveRequest)
    {
        $data = $request->validated();

        $leaveRequest->fill($data);
        $leaveRequest->saveOrFail();

        return redirect()->route('leave-request.index')->with(['success' => 'Successfully updated leave request']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return redirect()->route('leave-request.index')->with(['success' => 'Successfully deleted leave request']);
    }

    public function approveLeaveRequest(LeaveRequest $leaveRequest)
    {
        if (!Auth::user()->hasNoParentJobPosition()) {
            return redirect()->back()->with(['warning' => 'You have no previlige to do this action']);
        }

        $leaveRequest->fill([
            'status' => 'approved'
        ]);
        $leaveRequest->saveOrFail();

        return redirect()->route('leave-request.index')->with(['success' => 'Successfully approved leave request']);
    }

    public function generateLeaveLetter(Request $request, User $user)
    {
        $data = [];
        // Assuming $request holds the array you provided
        $leaveDateFrom = Carbon::parse($request['leave_date_from']);
        $leaveDateTo = Carbon::parse($request['leave_date_to']);
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $totalDays = 0;

        // Loop through each day between the two dates
        for ($date = Carbon::parse($request->get('leave_date_from')); $date->lte(Carbon::parse($request->get('leave_date_to'))); $date->addDay()) {
            // Check if the current day is not a Saturday or Sunday
            if (!$date->isSaturday() && !$date->isSunday()) {
                $totalDays++;
            }
        }

        $data['leave_subject'] = $request->get('subject');
        $data['attachment'] = $request->get('attachment');
        $data['emp_name'] = Auth::user()->employeeFullName();
        $data['job_department'] = Auth::user()->job_position?->department;
        $data['job_department'] = Auth::user()->job_position?->name;
        $data['days'] = $totalDays;
        $data['day_from'] = $days[$leaveDateFrom->dayOfWeek];
        $data['date_from'] = $leaveDateFrom->format('d M Y');
        $data['day_to'] = $days[$leaveDateTo->dayOfWeek];
        $data['date_to'] = $leaveDateTo->format('d M Y');

        $pdf = new Pdf(public_path() . '/templates/leave_letter.pdf');
        $leaveLetterPath = public_path() . '/system/documents/leave-request/gen/';
        $leaveLetterFileName = $leaveLetterPath . strtoupper(str_replace(" ", "_", $user->employeeFullName())) . '_' . Carbon::parse(now())->format('dmyhis') . '.pdf';

        if (!File::exists($leaveLetterPath)) {
            File::makeDirectory($leaveLetterPath, 0755, true);
        }
        
        $pdf->fillForm($data)->needAppearances()->saveAs($leaveLetterFileName);

        return response()->download($leaveLetterFileName);
    }
}
