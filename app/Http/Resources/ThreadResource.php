<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Prefix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\PrefixResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $commentCount = DB::table('thread_comments_threads')
        ->join('thread_comments', 'thread_comments.id', '=', 'thread_comment_id')
        ->join('threads', 'threads.id', '=', 'thread_comments_threads.thread_id')
        ->where('thread_id', '=', $this->id)
        ->get()
        ->count();
        

        $owner = Auth::user()->id ?? 0;
        $owner = $this->user_id === $owner || Gate::allows('admin');

        return [
            'id' => $this->id,
            'user' => UserResource::collection(User::where('id', '=', $this->user_id)->get()),
            'prefix' => PrefixResource::collection(Prefix::where('id', '=', $this->prefix_id)->get()),
            'title' => $this->title,
            'sticky' => $this->sticky,
            'commentCount' => $commentCount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'owner' => $owner,
        ];
    }
}
