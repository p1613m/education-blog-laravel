<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $userId = request()->get('user_id');
        $searchString = request()->get('query');
        $orderDirection = request()->get('order', 'DESC');
        $posts = Post::query()->orderBy('created_at', $orderDirection);

        if($userId) {
            $posts->where('user_id', $userId);
        }

        if($searchString) {
            $posts->where('title', 'LIKE', "%$searchString%");
        }

        return view('home', [
            'posts' => $posts->paginate(5),
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

    public function create(PostCreateRequest $request)
    {
        $postData = $request->validated();
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

    public function edit(Post $post, PostUpdateRequest $request)
    {
        if(!$post->hasAccess()) {
            return redirect()->route('home');
        }
        $postData = $request->validated();
        if($request->file('image')) {
            Storage::delete($post->image_path);
            $postData['image_path'] = $request->file('image')->store('public');
        }

        $post->update($postData);

        return redirect()->route('post', $post);
    }
}
