<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public $fillable = ['email','token','colocation_id','state'];
}
