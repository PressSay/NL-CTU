<?php

namespace App\Models;

use App\Models\Thread;
use App\Models\Categoryy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Prefix extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'color'
    ];

    public $timestamps = false;

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Categoryy::class, 'category_prefix');
    }

    public function threads() : BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }
}
