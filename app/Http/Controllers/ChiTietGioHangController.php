<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GioHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\ChiTietGioHang;
use Illuminate\Support\Facades\Auth;

class ChiTietGioHangController extends Controller
{
    public function update($giohang, Request $request)
    {
        $valNumber = 'required|integer';

        $validated = $request->validate([
            'gio_hang_id' => $valNumber,
            'san_pham_id' => $valNumber,
            'SoLuong' => 'required|integer',
        ]);

        $gioHang = GioHang::findorFail($giohang);

        $chiTietGioHang = ChiTietGioHang::where('gio_hang_id', $validated['gio_hang_id'])
            ->where('san_pham_id', $validated['san_pham_id'])
            ->first();

        $user = Auth::user();
        // $user = User::find(1); // for test

        if (!$user || $gioHang->profile->user->id !== $user->id) {
            return response()->json([
                'message' => 'you are not authorized to do this'
            ], 401);
        }


        

        $sanpham = SanPham::findorFail($validated['san_pham_id']);

        if ($validated['SoLuong'] > $sanpham->SoLuong) {
            return response()->json([
                'message' => 'so luong ton khong du'
            ], 400);
        }

        if ($validated['SoLuong'] == 0 ) {
            $chiTietGioHang->delete();
            return response()->json([
                'message' => 'chi tiet gio hang deleted successfully',
            ], 200);
        }

        $chiTietGioHang->gio_hang_id = $validated['gio_hang_id'];
        $chiTietGioHang->san_pham_id = $validated['san_pham_id'];
        $chiTietGioHang->SoLuong = $validated['SoLuong'];

        $chiTietGioHang->save();

        return response()->json([
            'message' => 'chi tiet gio hang updated successfully',
            'data' => $chiTietGioHang->only(['gio_hang_id', 'san_pham_id', 'SoLuong']),
        ], 200);
    }
}
