<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\Biodata;
use App\Models\EmployeePayroll;
use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use mikehaertl\pdftk\Pdf;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobApplications = JobApplication::query()
            ->where(function ($query) use ($request) {
                if ($request->get('search') != NULL) {
                    $query->where('full_name', 'LIKE', '%' . $request->get('search') . '%')
                        ->orWhere('residence_address', 'LIKE', '%' . $request->get('search') . '%')
                        ->orWhere('phone_number', 'LIKE', '%' . $request->get('search') . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->get('search') . '%');
                }

                if ($request->get('status_filter') != NULL) {
                    $query->where('application_status', $request->get('status_filter'));
                }

                if ($request->get('job_filter') != NULL) {
                    $query->where('job_position_id', $request->get('job_filter'));
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.management.recruitment.index', [
            'jobApplications' => $jobApplications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.management.recruitment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobApplicationRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('curriculum_vitae')) {
            $data['curriculum_vitae'] = 'storage/' . $request->file('curriculum_vitae')->store(JobApplication::FILE_PATH, 'public');
        }

        $jobApplication = JobApplication::make($data);
        $jobApplication->saveOrFail();

        return redirect()->back()->with(['success' => 'Created job application successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        return view('pages.management.recruitment.show', [
            'jobApplication' => $jobApplication
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        return view('pages.management.recruitment.edit', [
            'jobApplication' => $jobApplication
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobApplicationRequest $request, JobApplication $jobApplication)
    {
        $data = $request->validated();

        $data['curriculum_vitae'] = $jobApplication->curriculum_vitae;
        if ($request->hasFile('curriculum_vitae')) {
            if ($jobApplication->curriculum_vitae != NULL) {
                File::delete($jobApplication->curriculum_vitae);
            }
            $data['curriculum_vitae'] = 'storage/' . $request->file('curriculum_vitae')->store(JobApplication::FILE_PATH, 'public');
        }

        $hirringLetter = '';
        if (strtoupper($data['application_status']) == 'APPROVED') {
            $hirringLetter = $this->generateHiringLetter($request, $jobApplication);
        }
        
        $data['letter_path'] = $hirringLetter;
        $jobApplication->fill($data);
        $jobApplication->saveOrFail();

        return redirect()->route('job-application.index')->with(['success' => 'Updated job application successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();

        return redirect()->route('job-application.index')->with(['success' => 'Deleted job application successfully']);
    }

    public function downloadCV(JobApplication $jobApplication)
    {
        return response()->download($jobApplication->curriculum_vitae, strtolower(str_replace(" ", "", $jobApplication->job_position?->name)) . '-' . \Carbon\Carbon::parse($jobApplication->created_at)->format('ymds') . '-' . strtolower(explode(" ", $jobApplication->full_name)[0]) . '.' . explode(".", $jobApplication->curriculum_vitae)[1]);
    }

    public function registerEmployee(JobApplication $jobApplication)
    {
        try {
            DB::beginTransaction();

            /**
             *  1. create users data for new employee authorization  
             **/ 
            // user name
            $user['name'] = $jobApplication->full_name;
            
            // user email
            $this->generateNewEmail($jobApplication->full_name);
            
            // user password
            // $password = strtolower(str_replace(" ", "", $jobApplication->full_name) . Carbon::parse(now())->format('dmy'));
            $password = 'abcd1234';
            $user['password'] = Hash::make($password); 

            // user job position
            $user['job_position_id'] = $jobApplication->job_position_id;

            // user verified
            $arrayName = explode(" ", $user['name']);
            $email = '';
            if (count($arrayName) > 1) {
                $email = $arrayName[0] . '.' . $arrayName[count($arrayName) - 1];
                $email = strtolower($email) . '@gmail.com';
            } else {
                $email = strtolower($arrayName[0]) . '@gmail.com';
            }
            $user['email'] = $email; 
            $user['email_verified_at'] = now();

            // create blank biodata before add user
            $user = User::make($user);
            $user->saveOrFail();
            
            // 2. create biodata for new employee
            $biodata = Biodata::make([
                'user_id' => $user->id
            ]);
            $biodata->saveOrFail();

            $employeePayroll = EmployeePayroll::make([
                'user_id' => $user->id
            ]);
            $employeePayroll->saveOrFail();

            // update new employee referenced biodata instance
            $user->fill([
                'biodata_id' => $biodata->id,
                'employee_payroll_id' => $employeePayroll->id
            ]);
            $user->saveOrFail();

            /**
             * 4. update application status
             */
            $jobApplication->fill([
                'application_status' => 'joined'
            ]);
            $jobApplication->saveOrFail();

            DB::commit();

            return redirect()->route('job-application.index')->with(['success' => 'New employee added successfully']);
        } catch (Error $e) {
            DB::rollBack();
            return redirect()->back()->with(['warning' => $e->getMessage()]);
        }
    }

    public function generateNewEmail(string $full_name): string
    {
        $email = '';
        $nameArray = explode(" ", $full_name);
        $nameWordCount = count($nameArray);

        if ($nameWordCount === 1) {
            $email = strtolower($full_name) . '@gmail.com';
        } else {
            $email = strtolower($nameArray[0] . '.' . $nameArray[count($nameArray) - 1]) . '@gmail.com';
        }

        return $email;
    }

    public function generateHiringLetter(Request $request, JobApplication $jobApplication)
    {
        $pdf = new Pdf(public_path() . '/templates/hired_letter.pdf');
        $hiringLetterPath = public_path() . '/system/documents/hiring-letter/' . str_replace(" ", "", strtoupper($jobApplication->job_position?->department)) . '/';
        $hiringLetterFileName = $hiringLetterPath . str_replace(" ", "_", strtolower($jobApplication->full_name)) . Carbon::parse(now())->format('His') . '.pdf';

        if (!File::exists($hiringLetterPath)) {
            File::makeDirectory($hiringLetterPath, 0755, true);
        }

        $pdf->fillForm([
            'letter_number' => $request->get('letter_number') ? $request->get('letter_number') : '',
            'recruiter_name' => Auth::user()->employeeFullName(),
            'recruiter_address' => Auth::user()->biodatum?->address,
            'recruiter_job_position' => Auth::user()->job_position?->department . ' - ' . Auth::user()->job_position?->name,
            'employee_name' => $jobApplication->full_name,
            'employee_address' => $jobApplication?->residence_address,
            'employee_birth' => $jobApplication?->place_of_birth . ', ' . Carbon::parse($jobApplication->date_of_birth)->format('D m y'),
            'employee_gender' => $jobApplication?->gender,
            'employee_religion' => $jobApplication?->religion,
            'employee_identity_number' => $jobApplication->identity_number,
            'employee_phone_number' => $jobApplication->phone_number,
            'employee_job_position' => $jobApplication->job_position?->department . ' - ' . $jobApplication->job_position?->name
        ])->flatten()->saveAs($hiringLetterFileName);

        return $hiringLetterFileName;
    }
}
