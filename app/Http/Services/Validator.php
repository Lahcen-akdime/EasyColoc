<?php
namespace App\Http\Services ;

use App\Models\membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class Validator {
    public static function ValidateColocationName(Request $request){
        $request->validate([
        "name" => 'required|string|between:3,25'
        ]);
    }
    public static function checkCreatePossibility($user){
    $isActive = $user->colocation()->where('colocations.state','=','active')->exists();
    if($isActive){ return false; }
    // if(membership::where('user_id',Auth::user()->id)->where('state','active')->get()){
    //     return error('You already exist in a colocation active') ;
    // };
    }
}