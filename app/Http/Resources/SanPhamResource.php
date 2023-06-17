<?php

namespace App\Http\Resources;

use App\Models\DanhGia;
use App\Models\HinhAnh;
use App\Models\KhuyenMai;
use Illuminate\Http\Request;
use App\Http\Resources\BinhLuanResource;
use App\Http\Resources\ThongSoSanPhamResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SanPhamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $star = DanhGia::where('san_pham_id', $this->id)->avg('Star');
        $khuyenMais = $this->khuyenMai()->get();
        $imgTmps = $this->imageTmps()->get();
        $thongSoSanPhams = $this->thongSoSanPham()->get();
        $danhGias = $this->danhGia()->where('isDeleted', false)->get();
        $nguoiBan = $this->profile->user->name;
        $maSoNguoiBan = $this->profile->user->id;

        return [
            'id' => $this->id,
            'tenSanPham' => $this->TenSanPham,
            'soLuong' => $this->SoLuong,
            'moTa' => $this->MoTa,
            'show' => $this->Show,
            'giaTri' => $this->GiaTri,
            'star' => $star,
            'khuyenMais' => KhuyenMaiResource::collection($khuyenMais),
            'imgTmps' => ImageTmpResource::collection($imgTmps),
            'thongSoSanPhams' => ThongSoSanPhamResource::collection($thongSoSanPhams),
            'danhGias' => DanhGiaResource::collection($danhGias),
            'nguoiBan' => $nguoiBan,
            'maSoNguoiBan' => $maSoNguoiBan,
            'loaiSanPham' => $this->loaiSanPham->TenLoaiSanPham,
        ];
    }
}
