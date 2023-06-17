<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\PostGeneralEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class PostController extends Controller
{
    public function store(Request $request) {
        $user = Auth::user();
        $content = htmlspecialchars($request->content);
        $date = Date::now()->toArray()['formatted'];
    
        Post::create([
            'user_id' => $user->id,
            'content' => $content,
            'created_at' => $date,
        ]);
    
        PostGeneralEvent::dispatch($user, $content, $date);
        return response()->json(['content' => $content]);
    }
}
