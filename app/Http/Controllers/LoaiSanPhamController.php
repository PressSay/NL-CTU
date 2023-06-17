<?php

namespace App\Http\Controllers;

use App\Models\LoaiSanPham;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\SanPhamController;
use App\Http\Resources\LoaiSanPhamResource;

class LoaiSanPhamController extends Controller
{
    public function index()
    {
        $loaisanphams = LoaiSanPham::all();
        return LoaiSanPhamResource::collection($loaisanphams);
    }

    public function store(Request $request)
    {
        // if (!Gate::allows('isAdmin')) {
        //     return response()->json([
        //         'message' => 'you are not admin'
        //     ], 403);
        // }
        
        $validated = $request->validate([
            'TenLoaiSanPham' => 'required',
            'Show' => 'required',
        ]);

        $loaisanpham = LoaiSanPham::create($validated);
        return new LoaiSanPhamResource($loaisanpham);
    }

    public function update(Request $request, $loaisanpham)
    {
        // if (!Gate::allows('isAdmin')) {
        //     return response()->json([
        //         'message' => 'you are not admin'
        //     ], 403);
        // }
        $validated = $request->validate([
            'TenLoaiSanPham' => 'required',
            'Show' => 'required',
        ]);

        $loaisanpham = LoaiSanPham::findOrFail($loaisanpham);
        $loaisanpham->update($validated);
        return new LoaiSanPhamResource($loaisanpham);
    }

    public function destroy($loaisanpham)
    {
        // if (!Gate::allows('isAdmin')) {
        //     return response()->json([
        //         'message' => 'you are not admin'
        //     ], 403);
        // }
        $loaisanpham = LoaiSanPham::findOrFail($loaisanpham);

        foreach ($loaisanpham->sanPham as $sanpham) {
            DB::table('image_tmps')
                ->where('san_pham_id', '=', $sanpham->id)
                ->update(['san_pham_id' => null]);
            $sanpham->delete();
        }
        
        $loaisanpham->delete();
        return response()->json([
            'message' => 'delete success'
        ], 200);
    }
}
