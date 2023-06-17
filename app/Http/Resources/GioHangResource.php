<?php

namespace App\Http\Resources;

use App\Models\ChiTietGioHang;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GioHangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'maSoGioHang' => $this->id,
            'chiTietGioHang' => ChiTietGioHangResource::collection($this->chiTietGioHang),
        ];
    }
}
