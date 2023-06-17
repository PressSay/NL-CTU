<?php

namespace App\Models;

use App\Models\User;
use App\Models\Emoji;
use App\Models\ThreadComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function emoji() : BelongsTo
    {
        return $this->belongsTo(Emoji::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function threadComment() : BelongsTo
    {
        return $this->belongsTo(ThreadComment::class);
    }
}
