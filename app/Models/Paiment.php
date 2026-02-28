<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Paiment extends Model
{
    public $fillable = ['from_user_id','to_user_id','depence_id','amount','is_payed'];
    public function fromuser() : BelongsTo {
        return $this->belongsTo(User::class,'from_user_id');
    }
     public function touser() : BelongsTo {
        return $this->belongsTo(User::class,'to_user_id');
    }
}
