<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thread;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{

    public function intro($userName, $id)
    {   
        if (!is_numeric($id)) {
            abort(404);
        }

        $user = User::find($id);


        if (!$user || str_replace(' ', '_', $user->name) !== $userName) {
            abort(404);
        }

        $countReaction = DB::table('reactions')
            ->join('thread_comments', 'reactions.thread_comment_id', '=', 'thread_comments.id')
            ->join(
                'thread_comments_threads',
                'thread_comments.id',
                '=',
                'thread_comments_threads.thread_comment_id'
            )
            ->join('threads', 'thread_comments_threads.thread_id', '=', 'threads.id')
            ->where('threads.user_id', $id)
            ->count();

        return view('profile.intro', ['user' => $user, 'countReaction' => $countReaction]);
    }

    public function threads($userName, $id)
    {
        $user = User::find($id);


        if (!$user || str_replace(' ', '_', $user->name) !== $userName) {
            abort(404);
        }

        $threads = Thread::all()->where('user_id', $id);
        $countReaction = DB::table('reactions')
            ->join('thread_comments', 'reactions.thread_comment_id', '=', 'thread_comments.id')
            ->join(
                'thread_comments_threads',
                'thread_comments.id',
                '=',
                'thread_comments_threads.thread_comment_id'
            )
            ->join('threads', 'thread_comments_threads.thread_id', '=', 'threads.id')
            ->where('threads.user_id', $id)
            ->count();

        return view('profile.thread', ['threads' => $threads, 'user' => $user, 'countReaction' => $countReaction]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $validatedUser = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:256',
                ],
            ]
        );

        $validatedProfile = $request->validate(
            [
                'signature' => [
                    'min:8',
                    'max:255',
                ],
                'tel' => [
                    'min_digits:10',
                    'max_digits:10',
                ],
            ]
        );

        $request->user()->profile->gender = $request->gender;
        $request->user()->profile->birthday = $request->birthday;
        $request->user()->profile->notiEmail = $request->notiEmail;
        $request->user()->profile->notiFollow = $request->notiFollow;
        $request->user()->profile->location = $request->location;
        

        $request->user()->fill($validatedUser);
        $request->user()->profile->fill($validatedProfile);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->profile->save();
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateAvatar(Request $request)
    {
        $validatedProfile = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if (File::exists(storage_path('app/public/' . $request->user()->profile->avatar)))
                unlink(storage_path('app/public/' . $request->user()->profile->avatar));
            $validatedProfile['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $request->user()->profile->avatar = $validatedProfile['avatar'];
        $request->user()->profile->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();


        $user->profile->delete();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
