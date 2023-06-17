<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoaiSanPham extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'TenLoaiSanPham',
        'Show',
    ];

    public function sanPham(): HasMany
    {
        return $this->hasMany(SanPham::class);
    }
}
