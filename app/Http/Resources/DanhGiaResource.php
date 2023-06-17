<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DanhGiaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'star' => $this->Star,
            'noiDung' => $this->NoiDung,
            'ngayDanhGia' => $this->NgayDanhGia,
            'khanhHang' => $this->profile->user->name,
        ];
    }
}
