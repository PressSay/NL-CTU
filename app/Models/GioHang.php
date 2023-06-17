<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GioHang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function chiTietGioHang(): HasMany
    {
        return $this->hasMany(ChiTietGioHang::class);
    }
}
