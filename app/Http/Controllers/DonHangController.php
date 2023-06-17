<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\DonHangResource;
use App\Http\Resources\GioHangResource;

class DonHangController extends Controller
{

    public function indexAdmin()
    {
        if (Gate::denies('admin')) {
            return response()->json([
                'message' => 'you are not authorized to do this'
            ], 401);
        }

        $donHangs = DonHang::all();

        return DonHangResource::collection($donHangs);
    }

    public function indexSeller()
    {
        $user = Auth::user();
        // $user = User::find(1); // for test
        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }

        $profile = $user->profile;

        $sanPhams = $profile->sanPham;

        $donHangIds = DB::table('san_pham_cu_thes')
            ->whereIn('san_pham_id', $sanPhams->pluck('id'))
            ->get()->pluck('don_hang_id');

        $donHangs = DonHang::whereIn('id', $donHangIds)->get();

        return DonHangResource::collection($donHangs);
    }

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

        $donHangs = $profile->donHang->where('isDeleted', '=', '0');

        return DonHangResource::collection($donHangs);
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

        $validated = $request->validate([
            'HinhThucThanhToan' => 'required|string',
            // 'GhiChu' => 'required|string',
            // 'PhiShip' => 'required|integer',
            'gio_hang_id' => 'required|integer',
        ]);

        $validated['GhiChu'] = $request['GhiChu'] ?? '';

        $tongTien = 0;
        $gioHang = $user->profile->gioHang->find($validated['gio_hang_id']);
        $profile = $user->profile;
        $chiTietGioHangs = $gioHang->chiTietGioHang;
        $lengthChiTietGioHangs = count($chiTietGioHangs);
        if ($lengthChiTietGioHangs == 0) {
            return response()->json([
                'message' => 'gio hang rong'
            ], 400);
        }

        for ($i = 0; $i < $lengthChiTietGioHangs; $i++) {
            $sanPham = $chiTietGioHangs[$i]->sanPham;
            $tongTien += $chiTietGioHangs[$i]->SoLuong * $sanPham->GiaTri;
            if ($sanPham->SoLuong < $chiTietGioHangs[$i]->SoLuong) {
                return response()->json([
                    'message' => 'san pham ' . $sanPham->TenSanPham . ' khong du so luong'
                ], 400);
            }
        }

        if (!$gioHang) {
            return response()->json([
                'message' => 'gio hang not found'
            ], 404);
        }

        // if ($validated['GhiChu'] == null) {
        //     $validated['GhiChu'] = '';
        // }

        $donHang = DonHang::create([
            'HinhThucThanhToan' => $validated['HinhThucThanhToan'],
            'TrangThai' => 'Chưa xác nhận',
            'NgayLap' => now(),
            'GhiChu' => $validated['GhiChu'],
            'PhiShip' => 30,
            'profile_id' => $profile->id,
            'TongTien' => 0
        ]);

        for ($i = 0; $i < $lengthChiTietGioHangs; $i++) {
            $sanPham = $chiTietGioHangs[$i]->sanPham;
            $donHang->sanPham()->attach($sanPham->id);
            $sanPham->SoLuong -= $chiTietGioHangs[$i]->SoLuong;
            $sanPham->save();
        }

        $tongTien += 30;

        $donHang->TongTien = $tongTien;
        $donHang->save();

        return response()->json([
            'message' => 'success',
            'donHang' => $donHang
        ], 200);
    }

    public function update($donhang, Request $request)
    {
        if (!Gate::allows('admin')) {
            $donHang = DonHang::find($donhang);
        } else {

            $user = Auth::user();
            // $user = User::find(1); // for test
            if (!$user) {
                return response()->json([
                    'message' => 'you are not logged in'
                ], 401);
            }

            $profile = $user->profile;

            $sanPhams = $profile->sanPham;

            $donHangIds = DB::table('san_pham_cu_thes')
                ->whereIn('san_pham_id', $sanPhams->pluck('id'))
                ->get()->pluck('don_hang_id');

            $donHangs = DonHang::whereIn('id', $donHangIds)->get();


            $validated = $request->validate([
                'TrangThai' => 'required|string',
            ]);

            $donHang = $donHangs->find($donhang);
        }

        if (!$donHang) {
            return response()->json([
                'message' => 'don hang not found'
            ], 404);
        }


        $donHang->TrangThai = $validated['TrangThai'];
        $donHang->save();

        return response()->json([
            'message' => 'success',
            'donHang' => $donHang
        ], 200);
    }

    public function destroy($donhang)
    {
        if (!Gate::allows('admin')) {
            $user = Auth::user();
            $donHang = $user->profile->donHang->find($donhang);
            // $donHang = DonHang::find($donhang); // for tetst
            if (!$donHang) {
                return response()->json([
                    'message' => 'don hang not found'
                ], 404);
            }

            $donHang->isDeleted = true;
            $donHang->save();
        } else {

            $donHang = DonHang::find($donhang);

            if (!$donHang) {
                return response()->json([
                    'message' => 'don hang not found'
                ], 404);
            }

            $donHang->delete();
        }

        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
