<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KhuyenMaiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tenKhuyenMai' => $this->TenKhuyenMai,
            'ngayBatDau' => $this->NgayBatDau,
            'ngayKetThuc' => $this->NgayKetThuc,
            'phanTramGiamGia' => $this->GiamGia,
        ];
    }
}
