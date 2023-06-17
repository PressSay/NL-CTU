<?php

use App\Models\User;
use App\Models\Thread;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Events\ChatGeneralEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageTmpController;
use App\Http\Controllers\ThreadCommentController;
use App\Http\Controllers\ChiTietGioHangController;
use App\Http\Controllers\LoaiSanPhamController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profileAvatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile/threads/{userName}/{id}', 'threads');
    Route::get('/profile/intro/{userName}/{id}', 'intro');
});

Route::post('/get-users', function (Request $request) {
    $user = User::find($request->userId);
    $isOnline = $user->isOnline() ? 'online' : 'offline';
    return response()->json(['isOnline' => $isOnline]);
});

Route::post('/chat-request', function (Request $request) {
    $user = Auth::user();
    $message = htmlspecialchars($request->message);

    $date = Date::now()->toArray()['formatted'];

    ChatGeneralEvent::dispatch($user, $message, $date);
    return null;
});

Route::get('/api/notifications', function () {
    return Auth::user()->unreadNotifications;
});

Route::post('/api/notifications/read', function (Request $request) {
    $threadId = $request->threadId;
    $thread = Thread::findorfail($threadId);
    $user = User::find(Auth::id());

    $data = [
        'thread' => $thread->only(['title', 'id']),
        'user' => $user->only(['name']),
    ];

    $user = Auth::user();
    $user->unreadNotifications->where('data', $data)->markAsRead();

    $url = '/threads/' . str_replace(' ', '_', $thread->title) . '-' . $thread->id;
    
    $url = url($url);

    return response()->json(['url' => $url]);
});

// '/post-request' under that have channel
Route::post(
    '/post-request',
    [PostController::class, 'store']
)->middleware(['auth', 'verified']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(ThreadController::class)->group(function () {
        Route::get('/post/category-for-thread', 'categoryForThread');
        Route::get('/post/{category}/create-thread', 'create');
        Route::get('/post/edit-thread/{thread}', 'edit');
        Route::post('/post/store-thread', 'store');
        Route::post('/post/update-thread', 'update');
        Route::post('/post/delete-thread', 'destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/post/category-for-subcategory', 'categoryForSubcategory');
        Route::get('/post/category-for-subcategory/{category}', 'subCategoriesEdit');
        Route::get('/post/subcategory/{category}', 'createSub');
        Route::get('/post/category', 'create');
        Route::get('/post/edit-category/{category}', 'edit');
        Route::post('/post/store-caterory', 'store');
        Route::post('/post/update-category', 'update');
        Route::delete('/post/delete-category/{category}', 'destroy');
    });

    Route::controller(ThreadCommentController::class)->group(function () {
        Route::post('/post/store-comment', 'store'); // need put broastcast
        // need put broastcast, edit will display on thread-comments.blade.php
        Route::post('/post/update-comment', 'update'); // uncomplete, overtime
        Route::post('/post/delete-comment', 'destroy'); // uncomplete
    });

    Route::post('/post/upload-image', [ImageTmpController::class, 'store']);
});


Route::controller(ThreadController::class)->group(function () {
    Route::get('/api/thread/user/{name}/{id}', 'user');
    Route::get('/api/categories/{categoryNameId}', 'get');
    Route::get('/categories/{categoryNameId}', 'index');
    Route::get('/api/thread/new', 'threadNew');
    Route::get('/thread/new', 'new');
    
    Route::post('/api/categories/{categoryNameId}/search', 'search');
});

Route::controller(ThreadCommentController::class)->group(function () {
    Route::get('/api/threads/{threadNameId}', 'get');
    Route::get('/threads/{threadNameId}', 'index');
    Route::get('/api/threads/{threadNameId}/follow', 'follow');
    Route::post('/api/channel', 'channel');
    Route::get('/api/threadComment/recent', 'threadCommentRecent');
    Route::get('/threadComment/recent', 'recent');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/api/forum', 'get');
    Route::get('/forum', 'forum');
});

// de co san pham thi phai co loai san pham
Route::resource('sanpham', SanPhamController::class);

Route::controller(LoaiSanPhamController::class)->group(function () {
    Route::get('/loaisanpham', 'index');
    Route::get('/loaisanpham/create', 'create');
    Route::post('/loaisanpham', 'store');
    Route::put('/loaisanpham/{loaisanpham}', 'update');
    Route::delete('/loaisanpham/{loaisanpham}', 'destroy');
});

// de co gio hang thi phai co san pham
Route::controller(GioHangController::class)->group(function () {
    Route::get('/giohang', 'index');
    Route::post('/giohang', 'store');
    Route::put('/giohang/{giohang}', 'update');
    Route::delete('/giohang/{giohang}', 'destroy');
});

Route::put('/chitietgiohang/{chitietgiohang}', [ChiTietGioHangController::class, 'update']);

// de co danh gia thi don hang phai co trang thai da giao hang
Route::controller(DanhGiaController::class)->group(function () {
    Route::post('/danhgia', 'store');
    Route::put('/danhgia/{danhgia}', 'update');
    Route::delete('/danhgia/{danhgia}', 'destroy');
});


// cap nhat so luong san pham khi mua hang trong gio hang
// de co don hang thi can xac nhan mua trong gio hang
Route::controller(DonHangController::class)->group(function () {
    Route::get('/donhang', 'index');
    Route::get('/donhang/seller', 'indexSeller');
    // dung de xem, chinh sua
    Route::get('/donhang/admin', 'indexAdmin');
    Route::post('/donhang', 'store');
    Route::put('/donhang/{donhang}', 'update');
    Route::delete('/donhang/{donhang}', 'destroy');
});


Route::get('shop/productNS', function () {
    return view('shop.productNS.index');
});

Route::get('shop/productNS/{id}', function ($id) {
    SanPham::findorfail($id);
    return view('shop.productNS.show', ['id' => $id]);
});

Route::get('shop/upload/productNS', function () {
    return view('shop.upload.productNS');
});

Route::get('shop/upload/category', function () {
    return view('shop.upload.category');
});

Route::get('shop/cart', function () {
    return view('shop.cart');
});

Route::get('shop/orders', function () {
    return view('shop.orders.index');
});

Route::get('shop/orders/update', function () {
    return view('shop.orders.update'); 
});



require __DIR__.'/auth.php';
