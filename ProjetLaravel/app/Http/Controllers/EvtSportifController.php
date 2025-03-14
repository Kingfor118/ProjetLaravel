<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvtSportifRequest;
use App\Http\Requests\UpdateEvtSportifRequest;
use App\Models\EvtSportif;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class EvtSportifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EvtSportif::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('location')) {
            $query->where('location', $request->location);
        }

        if ($request->has('date')) {
            $query->where('date', $request->date);
        }

        $Evt = $query->paginate(5); 

        return $Evt;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvtSportifRequest $request)
    {
        $information = $request->validated();

        $information['slug'] = Str::slug($information['category']);

        $Evt = EvtSportif::create($information);

        return $Evt;

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evtSportif = EvtSportif::findOrFail($id);
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
