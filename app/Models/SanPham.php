<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SanPham extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'TenSanPham',
        'SoLuong',
        'MoTa',
        'Show',
        'GiaTri',
        'profile_id',
        'loai_san_pham_id',
        'isDeleted'
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function thongSoSanPham(): HasMany
    {
        return $this->hasMany(ThongSoSanPham::class);
    }

    public function donHang(): BelongsToMany
    {
        return $this->belongsToMany(DonHang::class, 'san_pham_cu_thes');
    }

    public function chiTietGioHang(): HasMany
    {
        return $this->hasMany(ChiTietGioHang::class);
    }

    public function imageTmps() : HasMany
    {
        return $this->hasMany(ImageTmp::class);
    }

    public function danhGia(): HasMany
    {
        return $this->hasMany(DanhGia::class);
    }

    public function khuyenMai(): HasMany
    {
        return $this->hasMany(KhuyenMai::class);
    }

    public function loaiSanPham(): BelongsTo
    {
        return $this->belongsTo(LoaiSanPham::class);
    }

    
}
