<?php

namespace App\Http\Controllers;

use App\Models\post;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = post::latest()->where('author_id', Auth::user()->id);
        //pengkondisian
        //jika ada request yang namanya keyw ord 
        if (request('keyword')){
            // kita lanjutkan pencarianya
            $posts->where('title', 'like', '%' . request('keyword') . '%' );
        }
            // lalu pagenate
            // withQueryString(): fungsi ini bertujuan suapaya dia akan tetap membawa query yang di kirimkan
            // misalnya searching nama suatu blok maka yang muncul akan berdasarkan nama itu saja
        return view('Dashboard.index', ['posts' => $posts->paginate(5)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        // $request->validate([
        //     'title' => 'required|unique:posts|min:10|max:255',
        //     'category_id' => 'required',
        //     'body' => 'required'
        // ]);

        // validator
        Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:10|max:255',
            'category_id' => 'required',
            'body' => 'required|min:50'
        ], [
            'title.required' => ':attribute harus di isi!',
            'category_id.required' => 'pilih salah satu category!',
            'body.required' => ':attribute harus di isi!',
            'body.min' => ':atribute harus :min karakter atau lebih' 

        ])->validate();

        post::create([
            'title' => $request->title,
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title), 
            'body' => $request->body        
        ]);
        return redirect('/dashboard')->with(['success' => 'your post has ben upload!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return view('dashboard.show' , ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        //validation
        $request->validate([
            'title' => 'required|min:10|max:255|unique:posts,title' .$post->id,
            'category_id' => 'required',
            'body' => 'required'
        ]);

        // update post
        $post->update([
            'title' => $request->title,
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title), 
            'body' => $request->body
        ]);

        // redierect
        return redirect('/dashboard')->with(['success' => 'your post has ben update!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
        return redirect('/dashboard')->with(['success' => 'your post has ben removed!']);
    }
}
