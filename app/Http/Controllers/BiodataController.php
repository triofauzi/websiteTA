<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Http\Requests\StoreBiodataRequest;
use App\Http\Requests\UpdateBiodataRequest;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biodata = Biodata::where('user_id', Auth::user()->id)->first();

        return view('pages.employee.personal-information.index', [
            'biodata' => $biodata
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.employee.personal-information.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBiodataRequest $request)
    {
        $data = $request->validated();

        $biodata = Biodata::make($data);
        $biodata->saveOrFail();

        return redirect()->route('personal-information.index')->with(['success' => 'Created biodata successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Biodata $biodata)
    {
        return view('pages.employee.personal-information.show', [
            'biodata' => $biodata
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biodata $biodata)
    {
        return view('pages.employee.personal-information.edit', [
            'biodata' => $biodata
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBiodataRequest $request, Biodata $biodata)
    {
        $data = $request->validated();

        $biodata->fill($data);
        $biodata->saveOrFail();

        return redirect()->route('personal-information.index')->with(['success' => 'Updated biodata successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biodata $biodata)
    {
        $biodata->delete();

        return redirect()->route('personal-information.index')->with(['success' => 'Deleted biodata successfully']);
    }
}
