<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Paiment;
use Illuminate\Http\Request;

class PaimentController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Paiment $paiment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paiment $paiment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Paiment $paiment)
    {
        $paiment->update(['is_payed'=>'payed']);
        return back()->with('valide','Paiment Stored Seccessfuly !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paiment $paiment)
    {
        //
    }
}
