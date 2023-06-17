<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Prefix;
use App\Models\Thread;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CategoryResource;

/**
 * Summary of CategoryController
 */
class CategoryController extends Controller
{
    

    private function checkUrl($category, $addtionCheck = false)
    {
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

        if (!$category || $category->title !== $categoryName || $addtionCheck) {
            abort(404);
        }

        return $category;
    }

    public function forum()
    {
        $categories = Category::all();
        $users = User::All();
        $threads = Thread::All();
        $posts = Post::All()->take(5);


        $daysAgo = 7; // Number of days to query for
        $date = now()->subDays($daysAgo);
        $countNewUsers = User::whereDate('created_at', '>=', $date)->count();

        return view(
            'forum',
            [
                'categories' => $categories,
                'users' => $users,
                'threads' => $threads,
                'posts' => $posts,
                'countNewUsers' => $countNewUsers,
            ]
        );
    }

    public function get()
    {
        $categories = Category::all()->where('parent_id', 0);
        return CategoryResource::collection($categories);
    }


    public function categoryForSubcategory()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $categories = Category::all()->where('parent_id', 0);

        return view(
            'post.subcategory.category-for-subcategory',
            ['categories' => $categories]
        );
    }

    public function subCategoriesEdit($category)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $category = $this->checkUrl($category);

        if ($category->parent_id != 0) {
            abort(404);
        }

        $prefixes = Prefix::all();

        return view('post.subcategory.subcategories-for-edit', ['category' => $category, 'prefixes' => $prefixes]);
    }

    /**
     * Summary of createSub
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createSub($category)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $category = $this->checkUrl($category);

        if ($category->parent_id != 0) {
            abort(404);
        }
        $prefixes = Prefix::all();
        return view('post.subcategory.subcategory', ['category' => $category, 'prefixes' => $prefixes]);
    }

    public function create()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $prefixes = Prefix::all();
        return view('post.category', ['prefixes' => $prefixes]);
    }


    public function edit($category)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $category = $this->checkUrl($category);
        $prefixes = Prefix::all();
        return view('post.edit-category', ['category' => $category, 'prefixes' => $prefixes]);
    }

    public function destroy($category)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $category = $this->checkUrl($category);


        if ($category->children->count() != 0) {
            $categoryLength = $category->children->count();
            for ($i = 0; $i < $categoryLength; $i++) {
                $threadLength = $category->children[$i]->threads->count();
                for ($j = 0; $j < $threadLength; $j++) {
                    $threadCommentLength = $category->children[$i]->threads[$j]->threadComments->count();
                    for ($k = 0; $k < $threadCommentLength; $k++) {
                        $imageTmps = $category->children[$i]->threads[$j]->threadComments[$k]->imageTmps;
                        $threadCommentId = $category->children[$i]->threads[$j]->threadComments[$k]->id;


                        foreach ($imageTmps as $imageTmp) {
                            unlink(storage_path('app/' . $imageTmp->path));
                            $imageTmp->delete();
                        }

                        DB::table('thread_comments_threads')
                            ->where('thread_comment_id', '=', $threadCommentId)
                            ->delete();

                        $category->children[$i]->threads[$j]->threadComments[$k]->delete();
                    }
                    $category->children[$i]->threads[$j]->delete();
                }
                $category->children[$i]->delete();
            }
        } else {
            $threadLength = $category->threads->count();
            for ($j = 0; $j < $threadLength; $j++) {
                $threadCommentLength = $category->threads[$j]->threadComments->count();
                for ($k = 0; $k < $threadCommentLength; $k++) {
                    $imageTmps = $category->threads[$j]->threadComments[$k]->imageTmps;
                    $threadCommentId = $category->threads[$j]->threadComments[$k]->id;

                    foreach ($imageTmps as $imageTmp) {
                        unlink(storage_path('app/' . $imageTmp->path));
                        $imageTmp->delete();
                    }

                    DB::table('thread_comments_threads')
                        ->where('thread_comment_id', '=', $threadCommentId)
                        ->delete();

                    $category->threads[$j]->threadComments[$k]->delete();
                }
                $category->threads[$j]->delete();
            }
        }

        $category->delete();

        return back()->withInput();
    }

    public function store(Request $request)
    {
        $prefixR = $request->prefix;
        $title = $request->title;
        $comment = $request->comment;
        $parentCategoryId = $request->categoryId;
        $user = Auth::user();

        $category = Category::create([
            'title' => $title,
            'description' => $comment,
            'user_id' => $user->id,
            'parent_id' => $parentCategoryId,
        ]);

        $prefix = Prefix::where('content', $prefixR)->get()->first();

        DB::table('category_prefix')->insert([
            'category_id' => $category->id,
            'prefix_id' => $prefix->id,
        ]);

        return response()->json(
            [
                'prefix' => $prefixR,
                'title' => $title,
                'comment' => $comment,
                'user' => $user->id
            ]
        );
    }

    public function update(Request $request)
    {
        $prefixR = $request->prefix;
        $title = $request->title;
        $comment = $request->comment;
        $categoryId = $request->categoryId;
        $user = Auth::user();

        $category = Category::find($categoryId);

        if (!$category || !Gate::allows('admin')) {
            abort(404);
        }

        $category->fill([
            'title' => $title,
            'description' => $comment,
            'user_id' => $user->id,
        ]);

        $category->prefix->first()->fill([
            'content' => $prefixR,
        ]);

        $category->prefix->first()->save();
        $category->save();

        return response()->json(
            [
                'prefix' => $prefixR,
                'title' => $title,
                'comment' => $comment,
                'user' => $user->id
            ]
        );
    }
}
