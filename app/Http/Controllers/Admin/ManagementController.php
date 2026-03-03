<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use App\Models\Depence;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index() {
        $colocationsActive = Colocation::where('state','=','active')->count('*');
        $users = User::with('colocation')->where('role','=','client')->get();
        $colocationNB = Depence::count('*');
        $usersBannie = User::where('is_banned','=',true)->count('*');
        return view('admin/dashboard',compact('users','colocationsActive','colocationNB','usersBannie'));
    }
    public function update($userid){
        User::find($userid)->update(['is_banned'=>true]);
        return to_route('dashboard');
    }
    public function store(Request $request){
        User::find($request->userid)->update(['is_banned'=>false]);
        return to_route('dashboard');
    }
    public function join(Request $request){
        $link = $request->link ;
        return redirect('/invitation/accept/'.$link);
    }
}