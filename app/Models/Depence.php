<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Depence extends Model
{
    public $fillable = ['title','price','categorie_id','user_id'];
    public function categorie():BelongsTo{
        return $this->belongsTo(Categorie::class);
    }
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function paiments() : HasMany {
        return $this->hasMany(Paiment::class);
    }
    
}
