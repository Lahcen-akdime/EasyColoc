<?php
namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Http\Services\Validator;
use App\Models\depence;
use Illuminate\Http\Request;

class DepenceController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::ValidateName($request);
        Validator::ValidatePrice($request);
        depence::create([
        'title'=>$request->name ,
        'price'=>$request->price ,
        'categorie_id' => $request->categorie_id ,
        'user_id' => $request->user_id
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(depence $depence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(depence $depence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, depence $depence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(depence $depence)
    {
        //
    }
}
