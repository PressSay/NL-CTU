<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'avatar',
        'signature',
        'gender',
        'location',
        'birthday',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function donHang(): HasMany
    {
        return $this->hasMany(DonHang::class);
    }

    public function danhGia(): HasMany
    {
        return $this->hasMany(DanhGia::class);
    }

    public function gioHang(): HasMany
    {
        return $this->hasMany(GioHang::class);
    }
    
    public function sanPham(): HasMany
    {
        return $this->hasMany(SanPham::class);
    }
}