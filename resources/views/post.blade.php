@php
/** @var App\Models\Post $post */
@endphp

@extends('template')

@section('content')
    <h1>{{ $post->title }}</h1>
    <img src="{{ $post->image_url }}" alt="" style="width: 400px">
    <p>
        <a href="#" class="author">
            @if($post->user->avatar_url)
                <img src="{{ $post->user->avatar_url }}" alt="">
            @endif
            {{ $post->user->name }}
        </a>
        <br>
        <b>{{ $post->created_at }}</b>
    </p>
    <p>{{ $post->description }}</p>
    <p>{{ $post->content }}</p>
    @if($post->hasAccess())
        <a href="{{ route('delete', $post) }}">Delete</a> |
        <a href="{{ route('edit', $post) }}">Edit</a>
    @endif
@endsection
