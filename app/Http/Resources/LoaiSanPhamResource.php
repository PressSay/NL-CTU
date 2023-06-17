<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoaiSanPhamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'maSo' => $this->id,
            'TenLoaiSanPham' => $this->TenLoaiSanPham,
            'Show' => $this->Show,
        ];
    }
}
