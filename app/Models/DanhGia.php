<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DanhGia extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'NoiDung',
        'Star',
        'profile_id',
        'san_pham_id',
        'NgayDanhGia',
        'isDeleted'
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class);
    }
}
