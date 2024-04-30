<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayroll;
use App\Http\Requests\StoreEmployeePayrollRequest;
use App\Http\Requests\UpdateEmployeePayrollRequest;
use App\Models\User;

class EmployeePayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();

        return view('pages.payroll.employee-payroll.index',[ 
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.payroll.employee-payroll.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeePayrollRequest $request)
    {
        $data = $request->validated();

        $employeePayroll = EmployeePayroll::make($data);
        $employeePayroll->saveOrFail();

        return redirect()->route('employee-payroll.index')->with(['success' => 'Successfully created employee payroll data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeePayroll $employeePayroll)
    {
        return view('pages.payroll.employee-payroll.show', [
            'employeePayroll' => $employeePayroll
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeePayroll $employeePayroll)
    {
        return view('pages.payroll.employee-payroll.edit', [
            'employeePayroll' => $employeePayroll
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeePayrollRequest $request, EmployeePayroll $employeePayroll)
    {
        $data = $request->validated();

        $employeePayroll->fill($data);
        $employeePayroll->saveOrFail();

        return redirect()->route('employee-payroll.index')->with(['success' => 'Successfully updated employee payroll data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeePayroll $employeePayroll)
    {
        $employeePayroll->delete();

        return redirect()->route('employee-payroll.index')->with(['success' => 'Successfully deleted employee payroll data']);
    }
}
