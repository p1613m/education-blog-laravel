@extends('template')

@section('content')
    @foreach($posts as $post)
        <article>
            <img src="{{ $post->image_url }}" alt="" style="width: 300px">
            <h2>{{ $post->title }}</h2>
            <p>
                <a href="#" class="author">
                    {{ $post->user->name }}
                </a>
                <br>
                <b>{{ $post->created_at }}</b>
            </p>
            <p>{{ $post->description }}</p>
            <p><a href="{{ route('post', $post) }}">Read more...</a></p>
        </article>
        <hr>
    @endforeach
@endsection
