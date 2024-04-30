<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use App\Http\Requests\StoreJobPositionRequest;
use App\Http\Requests\UpdateJobPositionRequest;
use App\Models\CareerTransitionHistory;
use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use mikehaertl\pdftk\Pdf;

class JobPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobPositions = JobPosition::query()
            ->where(function ($query) use ($request) {
                if ($request->get('search') != NULL)
                    $query->where('name', 'LIKE', '%' . $request->get('search') . '%');
            })
            ->paginate(10);

        return view('pages.master-data.job-position.index', [
            'jobPositions' => $jobPositions
        ]);
    }

    public function careerTransitionSite()
    {
        $users = User::paginate(10);

        return view('pages.management.career-transition.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.job-position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobPositionRequest $request)
    {
        $data = $request->validated();

        $data['is_need_candidate'] = 'N';
        $request->get('is_need_candidate') != NULL && $data['is_need_candidate'] = 'Y';

        $jobPosition = JobPosition::make($data);
        $jobPosition->saveOrFail();

        return redirect()->route('job-position.index')->with(['success' => 'Created job position successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosition $jobPosition)
    {
        return view('pages.master-data.job-position.show', [
            'jobPosition' => $jobPosition
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPosition $jobPosition)
    {
        return view('pages.master-data.job-position.edit', [
            'jobPosition' => $jobPosition
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobPositionRequest $request, JobPosition $jobPosition)
    {
        $data = $request->validated();

        $data['is_need_candidate'] = 'N';
        $request->get('is_need_candidate') != NULL && $data['is_need_candidate'] = 'Y';

        $jobPosition->fill($data);
        $jobPosition->saveOrFail();

        return redirect()->route('job-position.index')->with(['success' => 'Updated job position successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosition $jobPosition)
    {
        $jobPosition->delete();

        return redirect()->route('job-position.index')->with(['success' => 'Deleted job position successfully']);        
    }

    public function promoteEmployee(Request $request, User $user)
    {
        $newJobPosition = JobPosition::where('id', $user->job_position?->parent_id)->first();

        if ($newJobPosition === NULL) {
            return redirect()->back()->with(['warning' => 'This employee has been on highest job position']);
        }

        try {
            DB::beginTransaction();

            $pdf = new Pdf(public_path() . '/templates/job_promotion.pdf');
            $jobPromotionCode = str_replace(" ", "", strtoupper($user->employeeFullName()));
            $jobPromotionPath = public_path() . '/system/documents/promotion/' . $jobPromotionCode . Carbon::parse(now())->format('His') . '/';
            $jobPromotionLetterFileName = $jobPromotionPath . '/promotion-letter.pdf';

            if (!File::exists($jobPromotionPath)) {
                File::makeDirectory($jobPromotionPath, 0755, true);
            }

            $pdf->fillForm([
                'letter_number' => $request->get('letter_number') ? $request->get('letter_number') : '',
                'emp_name' => $user->employeeFullName(),
                'identity_number' => $user->biodatum?->identity_number,
                'job_position' => $user->job_position?->name,
                'job_division' => $user->job_position?->department,
                'job_position_to' => $user->job_position?->parent_position?->name,
                'job_division_to' => $user->job_position?->parent_position?->department,
                'first_salary' => $user->employee_payroll?->salary,
                'new_salary' => $request->get('new_salary') ? $request->get('new_salary') : ''
            ])->flatten()->saveAs($jobPromotionLetterFileName);

            if ($request->get('new_salary') != null) {
                $user->employee_payroll->fill([
                    'salary' => $request->get('new_salary')
                ]);
                $user->employee_payroll->saveOrFail();
            }

            $careerTransitionHistory = CareerTransitionHistory::make([
                'user_id' => $user->id,
                'job_position_from_id' => $user->job_position_id,
                'job_position_to_id' => $user->job_position?->parent_position?->id,
                'letter_path' => $jobPromotionLetterFileName
            ]);
            $careerTransitionHistory->saveOrFail();

            $user->update([
                'job_position_id' => $newJobPosition->id
            ]);

            DB::commit();
            
            return redirect()->back()->with(['success' => 'Successfully promote the employee']);
            
        } catch (Error $e) {
                
        }
    }
}
