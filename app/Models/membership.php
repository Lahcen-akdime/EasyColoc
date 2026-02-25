<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class membership extends Model
{
    public $table = 'membership';
    public $fillable = ['type','user_id','colocation_id','joined_at','left_at'];
}
