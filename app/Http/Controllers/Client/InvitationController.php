<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\Validator;
use App\Mail\SendEmail;
use App\Models\invitation;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
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
        $colocation = json_decode($request->colocation);
        Validator::validateEmail($request);
        $token = Str::random(15);
        $invitation = invitation::create([
        'email' => $request->email ,
        'token' => $token ,
        'colocation_id' => $colocation->id ,
        ]);
        Mail::to($invitation->email)
        ->send(new SendEmail($token,$colocation->name));
        return back()->with('valide', 'Invitation sent successfully to '.$invitation->email);
    }

    /**
     * Display the specified resource.
     */
    public function show(invitation $invitation)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function accept($token)
    {
        $user = Auth::user();
    $invitation = Invitation::where('token', $token)
                            ->where('state', 'pending')
                            ->first();
    if(!$invitation){
        return back()->with('error', 'Invalid or expired invitation.');
    }
    if ($user->colocation()->where('colocations.state','=','active')->exists()) {
        return back()->with('error', 'You already have an active colocation.');
    }
    Membership::create([
                    'user_id' => $user->id ,
                    'colocation_id' => $invitation->colocation_id ,
                    'type'=> 'member'
    ]);
    $invitation->update(['state'=>'accepted']);
    return to_route('colocation.show',$invitation->colocation_id)
    ->with('valide', 'You joined the colocation successfully!');
    }
}
