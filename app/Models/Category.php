<?php

namespace App\Models;

use App\Models\Prefix;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'parent_id',
        'title',
        'description',
        'user_id'
    ];

    public function threads() : HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function prefix() : BelongsToMany
    {
        return $this->belongsToMany(Prefix::class, 'category_prefix');
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
