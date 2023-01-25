<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->orderBy('created_at', 'DESC')->get();

        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post) {
        return view('post', [
            'post' => $post,
        ]);
    }

    public function createForm()
    {
        return view('create');
    }

    public function create(Request $request)
    {
        $postData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'required|string',
            'image' => 'required|file|mimes:png,jpg',
        ]);
        $postData['image_path'] = $request->file('image')->store('public');

        Auth::user()->posts()->create($postData);

        return redirect()->route('home');
    }

    public function delete(Post $post)
    {
        if($post->hasAccess()) {
            Storage::delete($post->image_path);
            $post->delete();
        }

        return redirect()->route('home');
    }

    public function editForm(Post $post)
    {
        if(!$post->hasAccess()) {
            return redirect()->route('home');
        }

        return view('edit', [
            'post' => $post,
        ]);
    }

    public function edit(Post $post, Request $request)
    {
        if(!$post->hasAccess()) {
            return redirect()->route('home');
        }
        $postData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'required|string',
            'image' => 'nullable|file|mimes:png,jpg',
        ]);
        if($request->file('image')) {
            Storage::delete($post->image_path);
            $postData['image_path'] = $request->file('image')->store('public');
        }

        $post->update($postData);

        return redirect()->route('post', $post);
    }
}
