<?php

namespace App\Models;

use App\Models\User;
use App\Models\Prefix;
use App\Models\Categoryy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'user_id'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function prefix() : BelongsTo
    {
        return $this->belongsTo(Prefix::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function threadComments() : BelongsToMany
    {
        return $this->belongsToMany(ThreadComment::class, 'thread_comments_threads');
    }

    public function followers() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follow_threads');
    }

}
