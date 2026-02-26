<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    protected $fillable = ['title','colocation_id'];

    public function colocation():BelongsTo{
    return $this->belongsTo(colocation::class);
    }
    public function depence():HasMany{
        return $this->hasMany(Depence::class);
    }
}
