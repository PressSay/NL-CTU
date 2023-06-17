<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GioHang;
use App\Models\Profile;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\ChiTietGioHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use App\Http\Resources\GioHangResource;

class GioHangController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $user = User::find(1); // for test
        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }


        $profile = $user->profile;
        $gioHangs = $profile->gioHang;

        return GioHangResource::collection($gioHangs);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // $user = User::find(1); // for test

        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }

        $profile = $user->profile;

        $gioHang = $profile->gioHang()->create([
            'profile_id' => $profile->id,
        ]);

        return new GioHangResource($gioHang);
    }


    //them vao gio hang
    public function update($giohang, Request $request)
    {
        $gioHang = GioHang::findorFail($giohang);
        // $user = User::find(1); //for test
        $user = Auth::user();

        $validated = $request->validate([
            'san_pham_id' => 'required|integer',
            'SoLuong' => 'required|integer',
        ]);

        $sanPham =  SanPham::findorFail($validated['san_pham_id']);
        $sanPhamExist = $gioHang->chiTietGioHang->where('san_pham_id', $validated['san_pham_id'])->all() != [];
        $isNguoiBan = $sanPham->profile->user_id === $user->id;

        if ($isNguoiBan || $sanPhamExist ||
             $sanPham->SoLuong <= 0 || !$user ||
             $gioHang->profile->user_id !== $user->id || $validated['SoLuong'] > $sanPham->SoLuong) {
            $message = "";

            if ($sanPhamExist) {
                $message = "san pham da co trong gio hang, chinh sua so luong trong gio hang";
            } elseif ($sanPham->SoLuong <= 0) {
                $message = "san pham da het hang";
            } elseif (!$user) {
                $message = "you are not logged in";
            } elseif ($gioHang->profile->user_id !== $user->id) {
                $message = "you are not authorized to do this";
            } elseif ($isNguoiBan) {
                $message = "khong the mua san pham cua ban than";
            } elseif ($validated['SoLuong'] > $sanPham->SoLuong) {
                $message = "so luong mua lon hon so luong san pham con lai";
            }

            return response()->json([
                'message' => $message
            ], 401);
        }

        

        $chiTietGioHang = ChiTietGioHang::create([
            'san_pham_id' => $validated['san_pham_id'],
            'gio_hang_id' => $gioHang->id,
            'SoLuong' => $validated['SoLuong'],
        ]);

        return GioHangResource::make($chiTietGioHang->gioHang);
    }

    public function destroy($giohang)
    {
        $gioHang = GioHang::findorFail($giohang);
        $user = Auth::user();
        // $user = User::find(1); //for test

        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }

        if ($gioHang->profile->user_id !== $user->id) {
            return response()->json([
                'message' => 'you are not authorized to do this'
            ], 401);
        }

        for ($i = 0; $i < count($gioHang->chiTietGioHang); $i++) {
            $gioHang->chiTietGioHang[$i]->delete();
        }

        $gioHang->delete();

        return response()->json([
            'message' => 'delete successfully'
        ], 200);
    }
}
