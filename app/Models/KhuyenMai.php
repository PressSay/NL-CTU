<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KhuyenMai extends Model
{
    use HasFactory;

    protected $fillable = [
        'TenKhuyenMai',
        'GiamGia',
        'NgayBatDau',
        'NgayKetThuc',
        'san_pham_id',
        'isDeleted'
    ];

    public $timestamps = false;

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class);
    }
}
