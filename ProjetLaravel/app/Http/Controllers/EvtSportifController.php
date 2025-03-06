<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvtSportifRequest;
use App\Http\Requests\UpdateEvtSportifRequest;
use App\Models\EvtSportif;

class EvtSportifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EvtSportif::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvtSportifRequest $request)
    {
        $information = $request->validated();

        $Evt = EvtSportif::create($information);

        return $Evt;

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $evtSportif = EvtSportif::find($id);
        return $evtSportif;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvtSportifRequest $request, int $id)
    {
        $information = $request->validated();

        $evtSportif = EvtSportif::find($id);

        $evtSportif->update($information);

        return $evtSportif;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $evtSportif = EvtSportif::find($id);
        $evtSportif->delete();

        return $evtSportif;
    }
}
