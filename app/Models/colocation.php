<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Colocation extends Model
{
    protected $fillable = ['name','state' ,'owner_id'];
    public function user():BelongsToMany
    {
        return $this->belongsToMany(User::class,'membership')->withPivot('type');
    }
    public function categorie():HasMany{
        return $this->hasMany(Categorie::class);
    }
    public function depences():HasManyThrough{
        return $this->hasManyThrough(Depence::class,Categorie::class);
    }
    
}
