@extends('template')

@section('content')
    <h1>Edit post</h1>
    <form action="{{ route('edit.send', $post) }}" novalidate method="post" enctype="multipart/form-data">
        @csrf
        @include('_form', [
            'post' => $post,
        ])

        <div>
            <input type="submit" value="Edit" name="submit">
        </div>
    </form>
@endsection
