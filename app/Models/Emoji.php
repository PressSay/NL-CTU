<?php

namespace App\Models;

use App\Models\Reaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emoji extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function reaction() : HasMany
    {
        return $this->hasMany(Reaction::class);
    }
}
