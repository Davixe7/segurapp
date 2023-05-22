<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = auth()->user()->residence->posts()->latest()->get();
        return Inertia::render('Posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CreatePost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|min:8',
            'description' => 'required|min:8',
        ]);

        $post = Post::create($request->except(['id']));
        $posts = auth()->user()->residence->posts()->latest()->get();
        return Inertia::render('Posts', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return Inertia::render('CreatePost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required|min:8',
            'description' => 'required|min:8',
        ]);

        $post->update($request->except(['id']));
        $posts = auth()->user()->residence->posts()->latest()->get();
        return Inertia::render('Posts', compact('posts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $posts = auth()->user()->residence->posts()->latest()->get();
        return Inertia::render('Posts', compact('posts'));
    }
}
