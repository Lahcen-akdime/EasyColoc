<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class colocation extends Model
{
    protected $fillable = ['name','state' ,'owner_id'];
    public function user():BelongsToMany
    {
        return $this->belongsToMany(User::class,'membership');
    }
    public function categorie():HasMany{
        return $this->hasMany(Categorie::class);
    }
}
