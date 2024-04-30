<?php

namespace App\Http\Controllers;

use App\Models\careerTransitionHistory;
use App\Http\Requests\StorecareerTransitionHistoryRequest;
use App\Http\Requests\UpdatecareerTransitionHistoryRequest;
use Illuminate\Http\Request;

class CareerTransitionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $careerTransitionHistories = careerTransitionHistory::query()
            ->join('users', 'users.id', '=', 'career_transition_histories.user_id')
            ->join('biodata', 'biodata.user_id', '=', 'users.id')
            ->where(function ($query) use ($request) {
                $query->whereRaw("CONCAT(biodata.first_name, ' ', biodata.middle_name, ' ', biodata.last_name) LIKE ?", ['%' . $request->get('search') . '%']);
            })
            ->paginate(10);

        return view('pages.career.transition.index', [
            'careerTranstionHistories' => $careerTransitionHistories
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
    public function store(StorecareerTransitionHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(careerTransitionHistory $careerTransitionHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(careerTransitionHistory $careerTransitionHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecareerTransitionHistoryRequest $request, careerTransitionHistory $careerTransitionHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(careerTransitionHistory $careerTransitionHistory)
    {
        //
    }

    public function downloadLetter(careerTransitionHistory $careerTransitionHistory)
    {
        return response()->download($careerTransitionHistory->letter_path);
    }
}
