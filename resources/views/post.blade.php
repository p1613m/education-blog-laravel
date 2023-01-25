@extends('template')

@section('content')
    <h1>{{ $post->title }}</h1>
    <img src="{{ $post->image_url }}" alt="" style="width: 400px">
    <p>
        <a href="#" class="author">
            {{ $post->user->name }}
        </a>
        <br>
        <b>{{ $post->created_at }}</b>
    </p>
    <p>{{ $post->description }}</p>
    <p>{{ $post->content }}</p>
@endsection
