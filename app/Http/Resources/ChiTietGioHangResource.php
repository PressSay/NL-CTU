<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChiTietGioHangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'maSoChiTietGioHang' => $this->gioHang->id,
            'sanPham' => SanPhamResource::make($this->sanPham),
            'soLuong' => $this->SoLuong,
        ];
    }
}
