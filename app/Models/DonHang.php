<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonHang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'HinhThucThanhToan',
        'TrangThai',
        'TongTien',
        'NgayLap',
        'GhiChu',
        'PhiShip',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function sanPham(): BelongsToMany
    {
        return $this->belongsToMany(SanPham::class, 'san_pham_cu_thes');
    }
}
