<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ThreadComment;
use Illuminate\Support\Facades\DB;
use App\ChrisKonnertz\BBCode\BBCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;



class ThreadCommentResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $reaction = DB::table('reactions')
            ->join('thread_comments', 'reactions.thread_comment_id', '=', 'thread_comments.id')
            ->join(
                'thread_comments_threads',
                'thread_comments.id',
                '=',
                'thread_comments_threads.thread_comment_id'
            )
            ->join('threads', 'thread_comments_threads.thread_id', '=', 'threads.id')
            ->where('threads.user_id', $this->user_id)->count();
        
        $user = User::find($this->user_id);
        $comment = ThreadComment::find($this->id);
        $thread = $comment->threads->first();
        $threadCount = $comment->threads->count();
        $age = now()->diffInYears(Carbon::parse($comment->user->birthday));
        
        
        
        $owner = Auth::user()->id ?? 0;
        $owner = ($this->user_id === $owner && $comment->id != $thread->threadComments->first()->id) ? true : false ;
        
        $bbcode = new BBCode();
        $content = $bbcode->render($this->content);
        


        return [
            'id' => $this->id,
            'user' => $user->only(['id', 'name']),
            'avatar' => $user->profile->avatar,
            'location' => $user->profile->location,
            'threadNameId' =>  $thread->title . '-' . $thread->id,
            'content' => $content,
            'reaction' => $reaction,
            'threadCount' => $threadCount,
            'age' => $age,
            'birthday' => $user->profile->birthday,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'owner' => $owner,
        ];
    }
}
