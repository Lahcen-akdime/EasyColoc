<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller ;
use App\Http\Services\Validator;
use App\Models\colocation;
use App\Models\membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

use function Laravel\Prompts\error;

class ColocationController extends Controller
{
    public function index(){
        $username = Auth::user()->name;
        $colocations = Auth::user()->colocation;
        
        return view('client/home',compact('colocations','username'));
    }
    public function create(){
        return view('client/create_colocation');
    }
    public function store(Request $request){
        Validator::checkCreatePossibility(Auth::user());
        if(!Validator::ValidateName($request)){
             return back()->with('error','You already exist in a colocation active') ;
        };
            try {
                DB::beginTransaction();
                $colocation = colocation::create([
                    'name' => $request->name ,
                    'owner_id' => Auth::user()->id ,
                ]);
                membership::create([
                    'user_id' => Auth::user()->id ,
                    'colocation_id' => $colocation->id ,
                ]);
                DB::commit();
                return to_route('colocation.show',$colocation->id);
            } catch (PDOException $e) {
                DB::rollBack();
                return $e->getMessage();
            }
    }
    public function show(colocation $colocation){
        $username = Auth::user()->name;
        $authuser = Auth::user();
        $totalePrice = $colocation->depences()->sum('price');
        $totaleExpences = count($colocation->depences) ;
        $sumMembers = count($colocation->user);
        return view('client/show_colocation',compact('colocation','authuser','totalePrice','totaleExpences','sumMembers'));
    }
    public function destroy(){}
    public function edit(){}
    public function update(Request $request , colocation $colocation){
        $colocation->updateOrFail([
            'state' => 'inactive'
        ]);
        return to_route('home');
    }
}