<?php

namespace App\Http\Controllers;

use App\Models\RetirementRequest;
use App\Http\Requests\StoreRetirementRequestRequest;
use App\Http\Requests\UpdateRetirementRequestRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use mikehaertl\pdftk\Pdf;

class RetirementRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $retirementRequests = RetirementRequest::orderBy('created_at', 'desc')->paginate(10);

        return view('pages.management.retirement-request.index',[
            'retirementRequests' => $retirementRequests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.management.retirement-request.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRetirementRequestRequest $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
        ];

        if ($request->hasFile('letter_path')) {
            $data['letter_path'] = $request->file('letter_path')->store(RetirementRequest::LETTER_PATH, 'public');
        }
        
        $retirementRequest = RetirementRequest::make($data);
        $retirementRequest->saveOrFail();

        return redirect()->back()->with(['success' => 'Successfully created retirement request']);
    }

    /**
     * Display the specified resource.
     */
    public function show(RetirementRequest $retirementRequest)
    {
        return view('pages.management.retirement-request.show', [
            'retirementRequest' => $retirementRequest
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RetirementRequest $retirementRequest)
    {
        return view('pages.management.retirement-request.edit', [
            'retirementRequest' => $retirementRequest
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRetirementRequestRequest $request, RetirementRequest $retirementRequest)
    {
        $data = $request->validated();

        $retirementRequest->fill($data);
        $retirementRequest->saveOrFail();

        return redirect()->route('retirement-request.index')->with(['success' => 'Successfully updated retirement request']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RetirementRequest $retirementRequest)
    {
        $retirementRequest->delete();

        return redirect()->route('retirement-request.index')->with(['success' => 'Successfully deleted retirement request']);
    }

    public function approveRetirementRequest(Request $request, RetirementRequest $retirementRequest)
    {
        $pdf = new Pdf(public_path() . '/templates/retirement_decision_letter.pdf');
        $retirementLetterCode = str_replace(" ", "", strtoupper($retirementRequest->user?->employeeFullName()));
        $retirementLetterPath = public_path() . '/system/documents/retirements/' . $retirementLetterCode . Carbon::parse(now())->format('His');
        $retirementLetterFileName = $retirementLetterPath . '/retirement-letter.pdf';

        if (!File::exists($retirementLetterPath)) {
            File::makeDirectory($retirementLetterPath, 0755, true);
        }

        $pdf->fillForm([
            'letter_number' => '',
            'letter_subject' => 'Surat Keterangan Pensiun',
            'employee_name' => $retirementRequest->user?->employeeFullName(),
            'identity_number' => $retirementRequest->user?->biodatum?->identity_number,
            'job_department' => $retirementRequest->user?->job_position?->department,
            'job_grade' => $retirementRequest->user?->job_position?->name,
            'employee_join_date' => Carbon::parse($retirementRequest->user?->created_at)->format('d, M Y'),
            'letter_location' => $request->get('letter_location') ? $request->get('letter_location') : '',
            'letter_date' => $request->get('letter_date') ? Carbon::parse($request->get('letter_date'))->format('d, M Y') : Carbon::parse(now())->format('d, M Y')
        ])->flatten()->saveAs($retirementLetterFileName);

        $retirementRequest->fill([
            'status' => 'approved',
            'letter_path' => $retirementLetterFileName,
        ]);
        $retirementRequest->saveOrFail();

        return redirect()->route('retirement-request.index')->with(['success' => 'Successfully approved retirement request']);
    }

    public function downloadRetirementRequestLetter(RetirementRequest $retirementRequest)
    {
        return response()->download($retirementRequest->letter_path);
    }

    public function retirementRequestPage()
    {
        return view('pages.report.retirement.index');
    }

    public function generateRetirementLetterPage(Request $request)
    {
        $pdf = new Pdf(public_path() . '/templates/retirement_decision_letter.pdf');
        $retirementLetterCode = str_replace(" ", "", strtoupper($request->get('employee_name')));
        $retirementLetterPath = public_path() . '/system/documents/retirements/gen/' . $retirementLetterCode . Carbon::parse(now())->format('His');
        $retirementLetterFileName = $retirementLetterPath . '/retirement-letter.pdf';

        if (!File::exists($retirementLetterPath)) {
            File::makeDirectory($retirementLetterPath, 0755, true);
        }

        $pdf->fillForm([
            'letter_number' => $request->get('letter_number'),
            'letter_subject' => $request->get('letter_subject'),
            'employee_name' => $request->get('employee_name'),
            'identity_number' => $request->get('identity_number'),
            'job_department' => $request->get('job_department'),
            'job_grade' => $request->get('job_grade'),
            'employee_join_date' => Carbon::parse($request->get('employee_join_date'))->format('d, M Y'),
            'letter_location' => $request->get('letter_location') ? $request->get('letter_location') : '',
            'letter_date' => $request->get('letter_date') ? Carbon::parse($request->get('letter_date'))->format('d, M Y') : Carbon::parse(now())->format('d, M Y')
        ])->flatten()->saveAs($retirementLetterFileName);

        return Response::download($retirementLetterFileName, 'retirement-letter.pdf');
    }
}
