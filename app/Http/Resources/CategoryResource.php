<?php

namespace App\Http\Resources;

use App\Models\Prefix;
use App\Models\Thread;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ThreadResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Summary of CategoryResource
 */
class CategoryResource extends JsonResource
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
        ->where('category_id', '=', $this->id)
        ->count();

        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'description' => $this->description,
            'subcategories' => CategoryResource::collection(Category::where('parent_id', '=', $this->id)->get()),
            'thread' => ThreadResource::collection(Thread::where('category_id', '=', 2)->get())->first(),
            'prefix' => $this->prefixResourceFunc($this->id),
            'threadCount' => Thread::where('category_id', '=', $this->id)->count(),
            'commentCount' => $commentCount,            
        ];
    }

    /**
     * Summary of prefixResourceFunc
     * @param mixed $id
     * @return array<\Illuminate\Http\Resources\Json\AnonymousResourceCollection>
     */
    private function prefixResourceFunc($id)
    {
        $categoryPrefix = DB::table('category_prefix')->where('category_id', '=', $id)->get();
        $prefixR = [];
        foreach ($categoryPrefix->toArray() as $prefix) {
            $prefixR[] = Prefix::where('id', '=', $prefix->prefix_id)->get();
        }
        return $prefixR;
    }

    
}
