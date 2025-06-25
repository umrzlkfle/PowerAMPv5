<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use Illuminate\Http\Request;
use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;

class CableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cable.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cable $cable)
    {
        return view('cable.show', compact('cable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cable $cables)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cable $cables)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cable $cables)
    {
        //
    }
}
