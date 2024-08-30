<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoryUnitRequest;
use App\Http\Requests\UpdateHistoryUnitRequest;
use App\Models\HistoryUnit;

class HistoryUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreHistoryUnitRequest $request)
    {
        $validated = $request->validate([
            'd' => 'nullable|string',
        ]);

        $newHistoryUnit = HistoryUnit::create($validated);

        return $newHistoryUnit;
    }

    /**
     * Display the specified resource.
     */
    public function show(HistoryUnit $historyUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoryUnit $historyUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistoryUnitRequest $request, HistoryUnit $historyUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryUnit $historyUnit)
    {
        //
    }
}
