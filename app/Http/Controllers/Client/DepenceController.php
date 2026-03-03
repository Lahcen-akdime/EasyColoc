<?php
namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Http\Services\Calculator;
use App\Http\Services\Validator;
use App\Models\depence;
use App\Models\Paiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

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
        try {
                DB::beginTransaction();
        $depence = depence::create([
        'title'=>$request->name ,
        'price'=>$request->price ,
        'categorie_id' => $request->categorie_id ,
        'user_id' => $request->user_id,
        'colocation_id'=>json_decode($request->colocation)->id
        ]);
        $colocationUsers = json_decode($request->colocation)->user ;
        $amount = Calculator::calculateAmount($request->price,count($colocationUsers));
        
        foreach ($colocationUsers as $user) {
            if($user->id != $request->user_id){
                Paiment::create([
                'from_user_id'=> $user->id ,
                'to_user_id' => $request->user_id ,
                'depence_id' => $depence->id ,
                'amount' => $amount
                ]);
            }
        }
        DB::commit();
        return back();
         } catch (PDOException $e) {
                DB::rollBack();
                return $e->getMessage();
            }
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
