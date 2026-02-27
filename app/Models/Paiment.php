<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiment extends Model
{
    public $fillable = ['from_user_id','to_user_id','depence_id','amount'];

}
