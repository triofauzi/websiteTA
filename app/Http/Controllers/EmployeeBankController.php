<?php

namespace App\Http\Controllers;

use App\Models\EmployeeBank;
use App\Http\Requests\StoreEmployeeBankRequest;
use App\Http\Requests\UpdateEmployeeBankRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeBanks = EmployeeBank::where('user_id', Auth::user()->id)
            ->paginate(10);

        return view('pages.employee.employee-bank.index', [
            'employeeBanks' => $employeeBanks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.employee.employee-bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeBankRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = $request->get('user_id') ? $request->get('user_id') : Auth::user()->id;
        $employeeBank = EmployeeBank::make($data);
        $employeeBank->saveOrFail();

        return redirect()->route('employee-bank.index')->with(['success' => 'Employee bank successfully created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeBank $employeeBank)
    {
        return view('pages.employee.employee-bank.show', [
            'employeeBank' => $employeeBank
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeBank $employeeBank)
    {
        return view('pages.employee.employee-bank.edit', [
            'employeeBank' => $employeeBank
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeBankRequest $request, EmployeeBank $employeeBank)
    {
        $data = $request->validated();

        $employeeBank->fill($data);
        $employeeBank->saveOrFail();

        return redirect()->route('employee-bank.index')->with(['success' => 'Successfully update employee bank']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeBank $employeeBank)
    {
        $employeeBank->delete();

        return redirect()->route('employee-bank.index')->with(['success' => 'Successfully deleted employee bank']);
    }
}
