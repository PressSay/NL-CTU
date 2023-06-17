<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonHangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $nguoiMua = $this->profile->user->name;

        return [
            'maSo' => $this->id,
            'hinhThucThanhToan' => $this->HinhThucThanhToan,
            'trangThai' => $this->TrangThai,
            'tongTien' => $this->TongTien,
            'ngayLap' => $this->NgayLap,
            'ghiChu' => $this->GhiChu,
            'phiShip' => $this->PhiShip,
            'nguoiMua' => $nguoiMua,
        ];
    }
}
