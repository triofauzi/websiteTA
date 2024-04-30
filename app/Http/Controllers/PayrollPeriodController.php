<?php

namespace App\Http\Controllers;

use App\Models\PayrollPeriod;
use App\Http\Requests\StorePayrollPeriodRequest;
use App\Http\Requests\UpdatePayrollPeriodRequest;
use App\Models\PaySlip;
use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use mikehaertl\pdftk\Pdf;

class PayrollPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payrollPeriods = PayrollPeriod::query()
            ->where(function ($query) use ($request) {
                if ($request->get('search') != NULL) {
                    $query->where('period_code', 'LIKE', '%' . $request->get('search') . '%');
                }
            })
            ->orderBy('pay_date', 'asc')
            ->paginate(10);

        return view('pages.company-setting.payroll-period.index', [
            'payrollPeriods' => $payrollPeriods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.company-setting.payroll-period.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayrollPeriodRequest $request)
    {
        $data = $request->validated();

        $payrollPeriod = PayrollPeriod::make($data);
        $payrollPeriod->saveOrFail();

        return redirect()->route('payroll-period.index')->with(['success' => 'Created payroll period successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(PayrollPeriod $payrollPeriod)
    {
        return view('pages.company-setting.payroll-period.show', [
            'payrollPeriod' => $payrollPeriod
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayrollPeriod $payrollPeriod)
    {
        return view('pages.company-setting.payroll-period.edit', [
            'payrollPeriod' => $payrollPeriod
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayrollPeriodRequest $request, PayrollPeriod $payrollPeriod)
    {
        $data = $request->validated();

        $payrollPeriod = PayrollPeriod::make($data);
        $payrollPeriod->saveOrFail();

        return redirect()->route('payroll-period.index')->with(['success' => 'Updated payroll period successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayrollPeriod $payrollPeriod)
    {
        $payrollPeriod->delete();

        return redirect()->route('payroll-period.index')->with(['success' => 'Deleted payroll period successfully']);
    }

    public function paymentProcess(Request $request)
    {
        $periodId = $request->get('period');
        $payrollPeriod = PayrollPeriod::where('id', $periodId)->first();
        $paySlipCode = strtoupper(Carbon::parse($payrollPeriod->pay_date)->format('MY'));
        
        try {
            DB::beginTransaction();

            $paySlipsPath = public_path() . '/system/documents/payslips/' . $paySlipCode;

            // check if directory exists for saving pay slips
            if (!File::exists($paySlipsPath)) {
                File::makeDirectory($paySlipsPath, 0755, true);
            }

            $usersWithJobPosition = User::whereNotNull('job_position_id')
                ->orderBy('name', 'asc')
                ->get();
        
            foreach ($usersWithJobPosition as $user) {
                $pdf = new Pdf(public_path() . '/templates/payslip.pdf');
                $paySlipFileName = $paySlipsPath . '/payslip_' . $user->id . $user->email . '_' . $paySlipCode . '.pdf';

                $pdf->fillForm([
                    'amount_salary' => $user->employee_payroll?->salary,
                    'emp_name' => $user->biodatum?->first_name . ' ' . $user->biodatum?->middle_name . ' ' . $user->biodatum?->last_name,
                    'amount_total_earnings' => $user->employee_payroll?->salary,
                    'emp_join_date' => Carbon::parse($user->created_date)->locale('id')->format('d M Y'),
                    'amount_net_pay' => $user->employee_payroll?->salary,
                    'designation' => $user->job_position?->name,
                    'department' => $user->job_position?->department,
                    'pay_period' => $payrollPeriod->period_code
                ])->flatten()->saveAs($paySlipFileName);

                if (PaySlip::where('user_id', $user->id)->where('payroll_period_id', $payrollPeriod->id)->first()) {
                    DB::rollBack();
                    return redirect()->back()->with(['warning' => 'This period has been processed']);
                }

                PaySlip::create([
                    'user_id' => $user->id,
                    'payroll_period_id' => $payrollPeriod->id,
                    'pay_slip_path' => $paySlipFileName
                ]);
            }

            DB::commit();
            return redirect()->back()->with(['success' => 'Successfully payment process']);
        } catch (Error $e) {
            DB::rollBack();
            return redirect()->back()->with(['warning' => $e->getMessage()]);
        }
    }
}
