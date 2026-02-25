<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class colocation extends Model
{
    protected $fillable = ['name','state' ,'owner_id'];
    public function user():BelongsToMany
    {
        return $this->belongsToMany(User::class,'membership');
    }
}
