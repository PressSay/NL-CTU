<?php

namespace App\Models;

use App\Models\Reaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ThreadComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
    ];

    public function reaction() : HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    public function threads() : BelongsToMany
    {
        return $this->belongsToMany(Thread::class, 'thread_comments_threads');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function imageTmps() : HasMany
    {
        return $this->hasMany(ImageTmp::class);
    }
}
