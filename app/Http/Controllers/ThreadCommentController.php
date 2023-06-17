<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Http\Request;
use App\Models\ThreadComment;
use App\Events\ThreadCommentEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ThreadCommentNof;
use App\Http\Resources\ThreadCommentResource;

class ThreadCommentController extends Controller
{

    public function threadCommentRecent()
    {
        $lastUpdate = date_sub(now(), date_interval_create_from_date_string('1 day'));
        $threadComments = ThreadComment::where('updated_at', '>=', $lastUpdate)
            ->where('updated_at', '<=', now())
            ->orderBy('updated_at', 'desc')
            ->get();

        return ThreadCommentResource::collection($threadComments);
    }

    public function recent()
    {
        return view('recent');
    }

    public function channel(Request $request)
    {
        $threadCommentId = $request->threadCommentId;

        $threadComment = ThreadComment::find($threadCommentId);

        if (!$threadComment) {
            abort(404);
        }

        ThreadCommentEvent::dispatch($threadComment);

        return null;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $threadId = $request->threadId;
        $prefixRequest = $request->prefix;
        $user = Auth::user();
        $userIds = $request->userIds;

        $threadComment = ThreadComment::create([
            'user_id' => $user->id,
            'content' => htmlspecialchars($request->comment),
        ]);

        $imagePaths = $request->imagePath;

        foreach ($imagePaths as $imageName) {
            $imageName = 'public/images/' . $imageName;

            DB::table('image_tmps')
                ->where('path', '=', $imageName)
                ->update(['thread_comment_id' => $threadComment->id]);
        }

        DB::table('thread_comments_threads')->insert([
            'thread_id' => $threadId,
            'thread_comment_id' => $threadComment->id
        ]);

        $follows = DB::table('follow_threads')
            ->where('thread_id', '=', $threadId)
            ->whereNotIn('user_id', $userIds)
            ->get();

        foreach ($follows as $follow) {
            $user = User::find($follow->user_id);

            $type = $user->profile->notiEmail && $user->profile->notiFollow ? 3 : 
                ($user->profile->notiEmail ? 2 :
                    ($user->profile->notiFollow ? 1 : 0));

            if ($type == 0) {
                continue;
            }

            $user->notify(new ThreadCommentNof($threadComment, $type));
        }

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => htmlspecialchars($request->comment),
            'threadCommentId' => $threadComment->id,
            'userIds' => $userIds,
        ], 200);
    }

    public function destroy(Request $request)
    {
        $threadCommentId = $request->threadCommentId;
        $threadComment = ThreadComment::find($threadCommentId);

        if (!$threadComment) {
            abort(404);
        }

        DB::table('thread_comments_threads')->where('thread_comment_id', '=', $threadCommentId)->delete();

        $imageTmps = $threadComment->imageTmps;

        foreach ($imageTmps as $imageTmp) {
            unlink(storage_path('app/' . $imageTmp->path));
            $imageTmp->delete();
        }

        $threadComment->delete();

        DB::table('thread_comments')->where('id', '=', $threadCommentId)->delete();


        return response()->json([
            'message' => 'Comment deleted successfully',
        ], 200);
    }

    public function index(String $threadNameId)
    {
        $thread = $this->checkUrl($threadNameId);

        $thread = $thread ? $thread : abort(404);
        $userId = Auth::user()->id ?? 0;


        $follow = DB::table('follow_threads')
            ->where('user_id', $userId)
            ->where('thread_id', $thread->id)
            ->first();

        $isFollow = $follow ? true : false;

        return view('thread-comments', ['thread' => $thread, 'isFollow' => $isFollow]);
    }

    public function follow($threadNameId)
    {
        $thread = $this->checkUrl($threadNameId);
        $user = Auth::user() ? Auth::user() : abort(404);

        $followThread = DB::table('follow_threads')
            ->where('user_id', '=', $user->id)
            ->where('thread_id', '=', $thread->id)
            ->first();

        if (!$followThread) {
            DB::table('follow_threads')->insert([
                'user_id' => $user->id,
                'thread_id' => $thread->id,
            ]);

            return response()->json([
                'message' => 'follow successfully',
            ], 200);
        }

        DB::table('follow_threads')
            ->where('user_id', '=', $user->id)
            ->where('thread_id', '=', $thread->id)
            ->delete();

        return response()->json([
            'message' => 'unfollow successfully',
        ], 200);
    }

    public function get($threadNameId)
    {
        $thread = $this->checkUrl($threadNameId);

        return ThreadCommentResource::collection($thread->threadComments);
    }

    private function checkUrl($threadNameId)
    {
        $threadName = explode('-', $threadNameId)[0];
        $threadName = str_replace('_', ' ', $threadName);
        $threadId = explode('-', $threadNameId)[1];

        $thread = Thread::find($threadId);

        if (!$thread || $thread->title !== $threadName) {
            abort(404);
        }

        return $thread;
    }
}
