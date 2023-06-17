<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietGioHang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'san_pham_id',
        'gio_hang_id',
        'SoLuong',
    ];

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class);
    }

    public function gioHang(): BelongsTo
    {
        return $this->belongsTo(GioHang::class);
    }
}
