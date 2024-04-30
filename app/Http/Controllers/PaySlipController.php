<?php

namespace App\Http\Controllers;

use App\Models\PaySlip;
use App\Http\Requests\StorePaySlipRequest;
use App\Http\Requests\UpdatePaySlipRequest;
use App\Models\PayrollPeriod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use mikehaertl\pdftk\Pdf;

class PaySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paySlips = PaySlip::query()
            ->where(function ($query) use ($request) {
                if ($request->get('period_filter') != NULL)
                    $query->where('payroll_period_id', $request->get('period_filter'));
            })
            ->where('user_id', Auth::user()->id)
            ->paginate(10);

        return view('pages.payroll.payslip.index', [
            'paySlips' => $paySlips
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
    public function store(StorePaySlipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaySlip $paySlip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaySlip $paySlip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaySlipRequest $request, PaySlip $paySlip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaySlip $paySlip)
    {
        $paySlip->delete();

        return redirect()->route('pay-slip.index')->with(['success' => 'Successfully deleted pay slip']);
    }

    public function generateMyPaySlip()
    {
        $pdf = new Pdf(public_path() . '/templates/payslip.pdf');

        $pdf->fillForm([
            'emp_join_date' => Carbon::parse(Auth::user()->created_at)->format('D d M Y'),
            'emp_name' => Auth::user()->biodatum->first_name . ' ' . Auth::user()->biodatum->middle_name . ' ' . Auth::user()->biodatum->last_name,
            'department' => Auth::user()->job_position?->department,
            'designation' => Auth::user()->job_position?->name,
        ])->flatten()->saveAs(public_path() . '/documents/payslips/payslip' . Auth::user()->id . '.pdf');

        return response()->download(public_path() . '/documents/payslips/payslip' . Auth::user()->id . '.pdf');
    }

    public function downloadPayslip(PaySlip $paySlip)
    {
        return response()->download($paySlip->pay_slip_path);
    }

    public function generatorPage()
    {
        return view('pages.report.payslip.index');
    }

    public function generatePaySlip(Request $request)
    {
        // entities requirement
        $payrollPeriod = PayrollPeriod::where('period_code', $request->get('payroll_period'))->first();

        $paySlipCode = strtoupper(Carbon::parse($payrollPeriod->pay_date)->format('MY'));
        $paySlipsPath = public_path() . '/system/documents/payslips/gen/' . $paySlipCode;
        
        if (!File::exists($paySlipsPath)) {
            File::makeDirectory($paySlipsPath, 0755, true);
        }

        $pdf = new Pdf(public_path() . '/templates/payslip.pdf');
        $paySlipFileName = $paySlipsPath . '/payslip_gen_' . strtolower(str_replace(" ", "", $request->get('emp_name'))) . '.pdf';

        $pdf->fillForm([
            'amount_salary' => $request->get('amount_salary'),
            'emp_name' => $request->get('emp_name'),
            'amount_total_earnings' => $request->get('amount_total_earnings'),
            'emp_join_date' => $request->get('emp_join_date'),
            'amount_net_pay' => $request->get('amount_net_pay'),
            'designation' => $request->get('designation'),
            'department' => $request->get('department'),
            'pay_period' => $request->get('payroll_period')
        ])->flatten()->saveAs($paySlipFileName);
        
        Session::flash('success', 'Successfully payment process');
        
        return Response::download($paySlipFileName, 'pay_slip.pdf');
    }

    public function downloadGeneratedPaySlip(string $fileDestination)
    {
        dd($fileDestination);
        return response()->download($fileDestination);
    }
}
