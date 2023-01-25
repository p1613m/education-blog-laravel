<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $postDate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'required|string',
            'image' => 'required|file|mimes:png,jpg',
        ]);
        $postDate['image_path'] = $request->file('image')->store('public');

        Auth::user()->posts()->create($postDate);

        return redirect()->route('home');
    }

    public function delete(Post $post)
    {
        if($post->hasAccess()) {
            $post->delete();
        }

        return redirect()->route('home');
    }
}
