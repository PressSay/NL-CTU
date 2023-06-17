<?php

namespace App\Http\Controllers;

use App\Models\ImageTmp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageTmpController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);

        $imageUrl = $request->image->store('public/images');

        $imgTmp = ImageTmp::create([
            'user_id' => Auth::user()->id,
            'path' => $imageUrl
        ]);

        $dayAgo = date('Y-m-d H:i:s', strtotime('-1 day'));
        $images = DB::table('image_tmps')
            ->where('thread_comment_id', '=', null)
            ->where('san_pham_id', '=', null)
            ->where('created_at', '<', $dayAgo)
            ->get();

        if (!$images->isEmpty()) {
            foreach ($images as $image) {
                unlink(storage_path('app/' . $image->path));
            }
            DB::table('image_tmps')
            ->where('thread_comment_id', '=', null)
            ->where('san_pham_id', '=', null)
            ->where('created_at', '<', $dayAgo)
            ->delete();
        }

        return response()->json([
            'data' => [
                'link' => Storage::url($imageUrl),
                'type' => Storage::mimeType($imageUrl),
                'idImageTmp' => $imgTmp->id
            ],
            'message' => 'Image uploaded successfully',
            'success' => true,
            'status' => 200
        ], 200);
    }
}
