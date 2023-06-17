<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageTmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'user_id',
        'thread_comment_id',
        'san_pham_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function threadComment() : BelongsTo
    {
        return $this->belongsTo(ThreadComment::class);
    }

    public function sanPham() : BelongsTo
    {
        return $this->belongsTo(SanPham::class);
    }
}
