<?php

namespace App\Http\Controllers;

use App\Models\Substation;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Illuminate\Support\Facades\Validator;

class SubstationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('substation.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Show the form for creating a new substation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('substation.create'));
    }

    /**
     * Store a newly created substation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'functional_location' => 'required|string|max:255|unique:substations',
            'status' => 'required|in:active,inactive,maintenance,backup',
            'voltage' => 'required|numeric|min:0',
            'design' => 'required|in:gis,ais,hybrid,outdoor,indoor',
            'operational_area' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the substation
        $substation = Substation::create([
            'name' => $request->name,
            'functional_location' => $request->functional_location,
            'status' => $request->status,
            'voltage' => $request->voltage,
            'design' => $request->design,
            'operational_area' => $request->operational_area,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
        ]);

        return redirect()->route('substation.index')
            ->with('success', 'Substation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Substation $substation)
    {
        return Livewire::mount('show-substation', ['substation' => $substation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Substation $substation)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Substation $substation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Substation $substation)
    {
        //
    }
}
