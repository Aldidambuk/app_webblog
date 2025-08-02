<?php

use App\Models\post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostDashboardController;

Route::get('/', function () {
    return view('Home', ['title' => 'Home Page']);
});

Route::get('/posts', function () {
    // fungsi untuk search, category, author, dan pagination untuk pindah halaman post 
    // dan withQueryString untuk tetap berada di halaman atau rute kita masuk atau klik(misal di category web programing)
    $posts = post::latest()->Filter(request(['search','category','author']))->paginate(5)->withQueryString();
    return view('posts', ['title' => 'Blog', 'posts' => $posts]);
});
route::get('/posts/{post:slug}', function(post $post){
            return view('post',['title' => 'single post', 'post' => $post]);
});


Route::get('/About', function () {
    return view('About', ['title' => 'About']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'contact']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [PostDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('/dashboard', [PostDashboardController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard/create', [PostDashboardController::class, 'create'])->middleware(['auth', 'verified']);

// Route::delete('/dashboard/{:post:slug}', [PostDashboardController::class, 'destroy'])->middleware(['auth', 'verified']);

// Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show'])->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function(){
Route::get('/dashboard', [PostDashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard', [PostDashboardController::class, 'store']);
Route::get('/dashboard/create', [PostDashboardController::class, 'create']);
Route::delete('/dashboard/{post:slug}', [PostDashboardController::class, 'destroy']);
Route::get('/dashboard/{post:slug}/edit', [PostDashboardController::class, 'edit']);
Route::patch('/dashboard/{post:slug}', [PostDashboardController::class, 'Update']);
Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload', [ProfileController::class, 'upload']);
});

require __DIR__.'/auth.php';
