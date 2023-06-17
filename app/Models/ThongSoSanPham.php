<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ThongSoSanPham extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'TenThongSo',
        'ChiTiet',
    ];

    public function ChiTietThongSo(): HasMany
    {
        return $this->hasMany(ChiTietThongSo::class);
    }

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class);
    }
}
