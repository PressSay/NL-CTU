<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SanPham;
use App\Models\KhuyenMai;
use App\Models\LoaiSanPham;
use Illuminate\Http\Request;
use App\Models\ThongSoSanPham;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Validated;
use App\Http\Resources\SanPhamResource;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class SanPhamController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'swoof' => 'required|integer',
            'product_cat' => 'required|string',
            'profile_id' => 'integer',
        ]);
        $loaiSanPhamId = $validated['swoof'];
        $tenLoai = $validated['product_cat'];

        $loaiSanPham = LoaiSanPham::where('id', $loaiSanPhamId)
            ->where('TenLoaiSanPham', $tenLoai)
            ->get();

        if (!$loaiSanPham) {
            return response()->json([
                'message' => 'Loại sản phẩm không tồn tại',
            ], 404);
        }

        $sanphams = SanPham::where('loai_san_pham_id', $loaiSanPhamId);
        $sanphams = $sanphams->where('isDeleted', false);

        if ($validated['profile_id'] != 0) {
            $sanphams = $sanphams->where('profile_id', Auth::user()->profile->id);
        }

        $sanphams = $sanphams->get();

        return SanPhamResource::collection($sanphams);
    }


    // nguoi dung se dang ban san pham va luu tai day
    public function store(Request $request)
    {
        $validated = $request->validate([
            'TenSanPham' => 'required|string',
            'SoLuong' => 'required|integer',
            'MoTa' => 'required|string',
            'Show' => 'required|boolean',
            'GiaTri' => 'required|integer',
            'loai_san_pham_id' => 'required|integer',
            // 'TenKhuyenMai' => 'string',
            // 'NgayBatDau' => 'date',
            // 'NgayKetThuc' => 'date',
            // 'GiamGia' => 'integer',
            // 'TenThongSo' => 'string',
            // 'ChiTietThongSo' => 'string',
            'HinhAnhs' => 'required',
        ]);

        $user = Auth::user();
        // $user = User::find(1); // test

        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }

        $profile = $user->profile;

        $sanPham = SanPham::create([
            'TenSanPham' => $validated['TenSanPham'],
            'SoLuong' => $validated['SoLuong'],
            'MoTa' => $validated['MoTa'],
            'Show' => 1,
            'GiaTri' => $validated['GiaTri'],
            'profile_id' => $profile->id,
            'loai_san_pham_id' => $validated['loai_san_pham_id'],
        ]);

        $sanPham->thongSoSanPham()->create([
            'TenThongSo' => $validated['TenThongSo'] ?? "",
            'ChiTiet' => $validated['ChiTietThongSo'] ?? "",
        ]);

        $imagePaths = $validated['HinhAnhs'];
        // $imagePaths = explode(',', $validated['HinhAnhs']); // test

        foreach ($imagePaths as $imageName) {
            $imageName = 'public/images/' . $imageName;

            DB::table('image_tmps')
                ->where('path', '=', $imageName)
                ->update(['san_pham_id' => $sanPham->id]);
        }


        KhuyenMai::create([
            'TenKhuyenMai' => $validated['TenKhuyenMai'] ?? "",
            'NgayBatDau' => $validated['NgayBatDau'] ?? now(),
            'NgayKetThuc' => $validated['NgayKetThuc'] ?? now(),
            'GiamGia' => $validated['GiamGia'] ?? 0,
            'san_pham_id' => $sanPham->id,
        ]);



        return response()->json([
            'message' => 'Tạo sản phẩm thành công',
        ], 201);
    }


    // nguoi dung vao trang tao san pham
    public function create()
    {
        // view
    }

    public function show($sanpham)
    {
        $sanPham = SanPham::find($sanpham);
        if ($sanPham->all() == []) {
            return response()->json([
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }
        return SanPhamResource::make($sanPham);
    }

    // nguoi dung se cap nhat trong database san pham ban tai day
    public function update($sanpham, Request $request)
    {
        $validated = $request->validate([
            'TenSanPham' => 'required|string',
            'SoLuong' => 'required|integer',
            'MoTa' => 'required|string',
            'Show' => 'required|boolean',
            'GiaTri' => 'required|integer',
            'loai_san_pham_id' => 'required|integer',
            // 'TenKhuyenMai' => 'string',
            // 'NgayBatDau' => 'date',
            // 'NgayKetThuc' => 'date',
            // 'GiamGia' => 'integer',
            // 'TenThongSo' => 'string',
            // 'ChiTietThongSo' => 'string',
            'HinhAnhs' => 'required',
            'san_pham_id' => 'required|integer',
        ]);

        $user = Auth::user();
        // $user = User::find(1); // test

        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }

        $profile = $user->profile;
        $sanPham = SanPham::find($sanpham);
        if ($sanPham->profile_id != $profile->id) {
            return response()->json([
                'message' => 'Bạn không có quyền chỉnh sửa sản phẩm này'
            ], 401);
        }

        if (!$sanPham) {
            return response()->json([
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }

        $sanPham->update([
            'TenSanPham' => $validated['TenSanPham'],
            'SoLuong' => $validated['SoLuong'],
            'MoTa' => $validated['MoTa'],
            'Show' => $validated['Show'],
            'GiaTri' => $validated['GiaTri'],
            'profile_id' => $profile->id,
            'loai_san_pham_id' => $validated['loai_san_pham_id'],
        ]);


        $sanPham->thongSoSanPham()->update([
            'TenThongSo' => $validated['TenThongSo'] ?? "",
            'ChiTiet' => $validated['ChiTietThongSo'] ?? "",
        ]);

        $sanPham->khuyenMai()->update([
            'TenKhuyenMai' => $validated['TenKhuyenMai'] ?? "",
            'NgayBatDau' => $validated['NgayBatDau'] ?? now(),
            'NgayKetThuc' => $validated['NgayKetThuc'] ?? now(),
            'GiamGia' => $validated['GiamGia'] ?? 0,
        ]);

        $imagePaths = $validated['HinhAnhs'];
        // $imagePaths = explode(',', $validated['HinhAnhs']); // test

        if ($imagePaths != []) {
            DB::table('image_tmps')
                ->where('san_pham_id', '=', $sanPham->id)
                ->update(['san_pham_id' => null]);
            foreach ($imagePaths as $imageName) {
                $imageName = 'public/images/' . $imageName;

                DB::table('image_tmps')
                    ->where('path', '=', $imageName)
                    ->update(['san_pham_id' => $sanPham->id]);
            }
        }


        // KhuyenMai::create([
        //     'TenKhuyenMai' => $validated['TenKhuyenMai'],
        //     'NgayBatDau' => $validated['NgayBatDau'],
        //     'NgayKetThuc' => $validated['NgayKetThuc'],
        //     'GiamGia' => $validated['GiamGia'],
        //     'san_pham_id' => $sanPham->id,
        // ]);

        return response()->json([
            'message' => 'Cập nhật sản phẩm thành công',
        ], 200);
    }

    public function destroy($sanpham)
    {
        $user = Auth::user();
        // $user = User::find(1); // test
        $sanPham = SanPham::find($sanpham);

        if (!$sanPham) {
            return response()->json([
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }

        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }

        $profile = $user->profile;

        if ($sanPham->profile_id != $profile->id) {
            return response()->json([
                'message' => 'you are not authorized to delete this product'
            ], 403);
        }

        // if (!Gate::allows('isAdmin')) {

        //     $sanPham->isDeleted = true;
        //     $sanPham->save();

        // } else {

        DB::table('image_tmps')
            ->where('san_pham_id', '=', $sanPham->id)
            ->update(['san_pham_id' => null]);
        $sanPham->thongSoSanPham()->delete();
        $sanPham->khuyenMai()->delete();
        $sanPham->delete();

        // }

        return response()->json([
            'message' => 'Xóa sản phẩm thành công'
        ], 200);
    }


    // nguoi dung vao trang sua san pham
    public function edit($sanpham)
    {
        // view
    }
}
