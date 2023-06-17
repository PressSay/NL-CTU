<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prefix;
use App\Models\Thread;
use App\Models\Category;
use App\Models\ImageTmp;
use Illuminate\Http\Request;
use App\Models\ThreadComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Http\Resources\ThreadResource;
use function PHPUnit\Framework\isEmpty;

/**
 * Summary of ThreadController
 */
class ThreadController extends Controller
{
    public function threadNew()
    {
        $lastUpdate = date_sub(now(), date_interval_create_from_date_string('1 day'));
        $thread = Thread::where('updated_at', '>=', $lastUpdate)
            ->where('updated_at', '<=', now())
            ->orderBy('updated_at', 'desc')
            ->get();

        return ThreadResource::collection($thread);
    }

    public function new()
    {
        return view('new');
    }

    public function search($categoryNameId)
    {
        $validated = request()->validate([
            'prefix' => 'nullable',
            'lastUpdated' => 'nullable',
            'writedBy' => 'nullable',
        ]);

        $prefixSearch = ($validated['prefix'] == 'All') ? null : $validated['prefix'];
        $lastUpdatedSearch = ($validated['lastUpdated'] == 'Any time') ? null : $validated['lastUpdated'];
        $writedBySearch = $validated['writedBy'];


        $category = $this->checkUrl($categoryNameId, null);
        $threads = Thread::where('category_id', $category->id);

        if ($prefixSearch) {
            $prefix = Prefix::where('content', $prefixSearch)->first();

            if ($prefix) {
                $threads = $threads->where('prefix_id', $prefix->id);
            }
        }

        if ($writedBySearch) {
            $user = User::where('name', $writedBySearch)->first();
            if ($user) {
                $threads = $threads->where('user_id', $user->id);
            }
        }

        if ($lastUpdatedSearch) {
            $lastUpdate = date_sub(now(), date_interval_create_from_date_string($lastUpdatedSearch));
            $threads = $threads
                ->where('updated_at', '>=', $lastUpdate)
                ->where('updated_at', '<=', now());
        }

        $threads = $threads->get();

        return ThreadResource::collection($threads);
    }

    public function user($name, $id)
    {
        if (!is_numeric($id)) {
            abort(404);
        }

        $user = User::find($id);

        if (!$user || $user->name !== $name) {
            abort(404);
        }

        $threads = Thread::where('user_id', $user->id)->get();
        return ThreadResource::collection($threads);
    }

    public function categoryForThread()
    {
        $categories = Category::all();
        return view('post.thread.category-for-thread', ['categories' => $categories]);
    }

    public function create($category)
    {
        $category = $this->checkUrl($category, null);
        $prefixes = Prefix::all();
        return view('post.thread.create-thread', ['category' => $category, 'prefixes' => $prefixes]);
    }


    public function edit($thread)
    {
        $thread = $this->checkUrl(null, $thread);
        $prefixes = Prefix::all();
        return view('post.thread.edit-thread', ['thread' => $thread, 'prefixes' => $prefixes]);
    }


    public function get($categoryNameId)
    {
        $category = $this->checkUrl($categoryNameId, null);

        $threads = Thread::where('category_id', $category->id)->get();

        return ThreadResource::collection($threads);
    }

    public function index(String $categoryNameId)
    {
        $category = $this->checkUrl($categoryNameId, null);
        $preifx = Prefix::all();
        return view('threads', ['category' => $category, 'prefixes' => $preifx]);
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            'prefix' => 'required',
            'title' => 'required|max:255',
            'comment' => 'required|max:1000',
        ]);

        $prefix = $validate['prefix'];
        $title = $validate['title'];
        $comment = htmlspecialchars($validate['comment']);
        $databaseNotification = $request->follow;
        $emailNotification = $request->email;
        $categoryId = $request->categoryId;
        $user = Auth::user();

        $prefixId = Prefix::where('content', $prefix)->first()->id;

        if (!is_numeric($categoryId)) {
            abort(404);
        }

        $threadComment = ThreadComment::create([
            'content' => $comment,
            'user_id' => $user->id,
            'category_id' => $categoryId
        ]);

        $imagePaths = $request->imagePath;

        foreach ($imagePaths as $imageName) {
            $imageName = 'public/images/' . $imageName;

            DB::table('image_tmps')
                ->where('path', '=', $imageName)
                ->update(['thread_comment_id' => $threadComment->id]);
        }



        $thread = Thread::create([
            'title' => $title,
            'user_id' => $user->id,
            'category_id' => $categoryId,
        ]);

        $thread->prefix_id = $prefixId;
        $thread->save();



        DB::table('thread_comments_threads')->insert([
            'thread_id' => $thread->id,
            'thread_comment_id' => $threadComment->id
        ]);


        if ($emailNotification) {
            $user->profile->notiEmail = 1;
        } else {
            $user->profile->notiEmail = 0;
        }

        if ($databaseNotification) {
            $user->profile->notiFollow = 1;
        } else {
            $user->profile->notiFollow = 0;
        }

        $user->profile->save();

        return response()->json(
            [
                'prefix' => $prefixId,
                'title' => $title,
                'comment' => $comment,
                'follow' => $databaseNotification,
                'email' => $emailNotification,
                'user' => $user->id
            ]
        );
    }


    public function update(Request $request)
    {

        $validate = $request->validate([
            'prefix' => 'required',
            'title' => 'required|max:255',
            'comment' => 'required|max:1000',
        ]);

        $prefix = $validate['prefix'];
        $title = $validate['title'];
        $comment = htmlspecialchars($validate['comment']);
        $databaseNotification = $request->follow;
        $emailNotification = $request->email;
        $threadId = $request->threadId;
        $prefixId = Prefix::where('content', $prefix)->first()->id;

        if (!is_numeric($threadId)) {
            abort(404);
        }

        $thread = Thread::find($threadId);
        $user = $thread->user;

        if (!$thread /* || $thread->user_id !== Auth::user()->id && !Gate::allows('admin') */) {
            abort(404);
        }

        $thread->fill([
            'title' => $title,
        ]);

        $threadComment = $thread->threadComments->first();

        $imagePaths = $request->imagePath;
        $imageTmps = $threadComment->imageTmps;

        if (!$imageTmps->isEmpty()) {
            $imageNotPathCurrentCondition = array();

            foreach ($imagePaths as $imagePath) {
                //need check path ImageName belong to database for sercurity
                $imageName = 'public/images/' . $imagePath; //need check path ImageName belong to database for sercurity
                $imageNotPathCurrentCondition[] = $imageName;
            }
            $imageNotPathCurrents = $imageTmps->whereNotIn('path', $imageNotPathCurrentCondition);

            foreach ($imageNotPathCurrents as $image) {
                unlink(storage_path('app/' . $image->path));
                $image->delete();
            }

            foreach ($imagePaths as $imagePath) {
                $imageName = 'public/images/' . $imagePath;
                foreach ($imageTmps as $image) {
                    if ($image->path != $imageName) {
                        DB::table('image_tmps')
                            ->where('path', '=', $imageName)
                            ->update(['thread_comment_id' => $threadComment->id]);
                    }
                }
            }
        } else {
            foreach ($imagePaths as $imagePath) {
                $imageName = 'public/images/' . $imagePath;
                DB::table('image_tmps')
                    ->where('path', '=', $imageName)
                    ->update(['thread_comment_id' => $threadComment->id]);
            }
        }


        $threadComment->fill([
            'content' => $comment
        ]);

        
        
        $threadComment->save();
        
        $thread->prefix_id = $prefixId;
        $thread->save();


        if (!$emailNotification) {
            $user->profile->notiEmail = 1;
        } else {
            $user->profile->notiEmail = 0;
        }

        if (!$databaseNotification) {
            $user->profile->notiFollow = 1;
        } else {
            $user->profile->notiFollow = 0;
        }

        return response()->json(
            [
                'prefix' => $prefix,
                'title' => $title,
                'comment' => $comment,
                'follow' => $databaseNotification,
                'email' => $emailNotification,
                // 'user' => $thread->user_id
                'threadId' => $threadId
            ]
        );
    }

    public function destroy(Request $request)
    {

        if (!is_numeric($request->threadId)) {
            abort(404);
        }

        $thread = Thread::find($request->threadId);

        if (!$thread && $thread->user_id !== Auth::user()->id && !Gate::allows('admin')) {
            abort(404);
        }

        foreach ($thread->threadComments as $threadComment) {

            $imageTmps = $threadComment->imageTmps;

            foreach ($imageTmps as $imageTmp) {
                unlink(storage_path('app/' . $imageTmp->path));
                $imageTmp->delete();
            }

            DB::table('thread_comments_threads')->where('thread_comment_id', '=', $threadComment->id)->delete();
            $threadComment->delete();
        }

        $thread->delete();

        return response()->json(
            [
                'message' => 'Thread deleted'
            ]
        );
    }

    private function checkUrl($category, $thread)
    {
        if ($category != null) {
            $category = explode('-', $category);

            if (count($category) !== 2) {
                abort(404);
            }

            $categoryName = $category[0];
            $categoryName = str_replace('_', ' ', $categoryName);
            $categoryId = $category[1];

            if (!is_numeric($categoryId)) {
                abort(404);
            }

            $category = Category::find($categoryId);

            if (!$category || $category->title !== $categoryName || $category->parent_id == 0) {
                abort(404);
            }

            return $category;
        }

        if ($thread != null) {
            $thread = explode('-', $thread);

            if (count($thread) !== 2) {
                abort(404);
            }

            $threadName = $thread[0];
            $threadName = str_replace('_', ' ', $threadName);
            $threadId = $thread[1];

            if (!is_numeric($threadId)) {
                abort(404);
            }

            $thread = Thread::find($threadId);

            if (
                !$thread || $thread->title !== $threadName
                // || $thread->user_id !== Auth::user()->id && !Gate::allows('admin')
            ) {
                abort(404);
            }

            return $thread;
        }

        return null;
    }
}
