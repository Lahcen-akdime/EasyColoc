<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller ;
use App\Http\Services\Validator;
use App\Models\colocation;
use App\Models\membership;
use App\Models\Membership as ModelsMembership;
use App\Models\Paiment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

use function Laravel\Prompts\error;

class ColocationController extends Controller
{
    public function index(){
        $user = Auth::user();
        $colocations = Auth::user()->colocation ;
        
        return view('client/home',compact('colocations','user'));
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
        $amounts = Paiment::where('is_payed','=','payed')
                             ->where('from_user_id','=',$authuser->id)
                             ->sum('amount');
        $credit = Paiment::where('is_payed','=','unpayed')
                             ->where('from_user_id','=',$authuser->id)
                             ->sum('amount');
        $totalePrice = $colocation->depences()->sum('price');
        $totaleExpences = count($colocation->depences) ;
        $sumMembers = count($colocation->user);
        return view('client/show_colocation',compact('colocation','authuser','totalePrice',
                                                    'totaleExpences','sumMembers','amounts','credit'));
    }
    public function extract(Request $request){
        try {
        DB::beginTransaction();
        membership::where('user_id','=',$request->user_id)
                                ->where('colocation_id','=',json_decode($request->colocation)->id)
                                ->update(['left_at'=>now()]);
        Paiment::where('is_payed','=','unpayed')
                         ->where('from_user_id','=',$request->user_id)
                         ->update(['from_user_id'=>Auth::user()->id]);
        DB::commit();
        return to_route('colocation.show',json_decode($request->colocation)->id);
        } 
        catch (PDOException $e) {
                DB::rollBack();
                return $e->getMessage();
        }
    }
    public function update(colocation $colocation){
        $colocation->updateOrFail([
            'state' => 'inactive'
            ]);
            return to_route('home');
            }
    public function leave(Colocation $colocation){
        try {
        DB::beginTransaction();
        $membership = membership::where('user_id','=',Auth::user()->id)
                  ->where('colocation_id','=',$colocation->id)
                  ->update(['left_at'=>now()]);
        $user = Auth::user() ;
        $credit = Paiment::where('is_payed','=','unpayed')
                             ->where('from_user_id','=',$user->id)
                             ->count('*');
        $evaluation = $user->evaluation ;
        $user->update(['evaluation'=>$evaluation-$credit]);
        DB::commit();
        if($credit>1){
            return to_route('colocation.index')->with('error','You leave with a credit in colocation ⚠️');
        }
        else{
            return to_route('colocation.index')->with('valide','You leave the colocation cleanly ✅');
        }
            } catch (PDOException $e) {
                DB::rollBack();
                return $e->getMessage();
            }
    }
            public function edit(){}
}