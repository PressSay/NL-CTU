<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DanhGia;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\DanhGiaResource;

class DanhGiaController extends Controller
{   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NoiDung' => 'required',
            'Star' => 'required|integer|min:0|max:10',
            'san_pham_id' => 'required',
        ]);

        $user = Auth::user();
        // $user = User::find(1); // test
        $profile = $user->profile;
        $donHangs = DB::table('san_pham_cu_thes')
            ->where('san_pham_id', $validated['san_pham_id'])
            ->where('rated', false)
            ->join('don_hangs', 'san_pham_cu_thes.don_hang_id', '=', 'don_hangs.id')
            ->where('don_hangs.profile_id', $profile->id)
            ->where('don_hangs.isDeleted', false)
            ->where('don_hangs.TrangThai', 'Đã giao hàng')
            ->get();

        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }

        if ($donHangs->count() == 0) {
            return response()->json([
                'message' => "you can't rate while you haven't bought this product yet"
            ], 404);
        }

        $donHangs->each(function ($donHang) use ($validated) {
            DB::table('san_pham_cu_thes')
                ->where('don_hang_id', $donHang->don_hang_id)
                ->where('san_pham_id', $validated['san_pham_id'])
                ->update(['rated' => true]);
        });

        $danhGia = DanhGia::create([
            'NoiDung' => $validated['NoiDung'],
            'Star' => $validated['Star'],
            'san_pham_id' => $validated['san_pham_id'],
            'NgayDanhGia' => now(),
            'profile_id' => $user->profile->id,
        ]);

        return DanhGiaResource::make($danhGia);
    }

    public function update($danhgia, Request $request)
    {
        if (!Gate::allows('admin')) {
            return response()->json([
                'message' => 'you are not admin'
            ], 403);
        }

        $validated = $request->validate([
            'NoiDung' => 'required',
            'Star' => 'required|integer|min:1|max:5',
        ]);
        

        $user = Auth::user();
        $danhGia = $user->profile->danhGia()->find($danhgia);

        if (!$danhGia) {
            return response()->json([
                'message' => 'danh gia not found'
            ], 404);
        }

        $danhGia->update([
            'NoiDung' => $validated['NoiDung'],
            'Star' => $validated['Star'],
        ]);

        return DanhGiaResource::make($danhGia);
    }

    public function destroy($danhgia)
    {
        $user = Auth::user();
        // $user = User::find(1); // test

        if (!$user) {
            return response()->json([
                'message' => 'you are not logged in'
            ], 401);
        }

        $danhGia = $user->profile->danhGia()->find($danhgia);

        if (!$danhGia) {
            return response()->json([
                'message' => 'danh gia not found'
            ], 404);
        }

        if (!Gate::allows('isAdmin')) {
            $danhGia->isDeleted = true;
            $danhGia->save();

        } else {
            $danhGia->delete();
        }

        return response()->json([
            'message' => 'delete danh gia successfully'
        ], 200);
    }
}
