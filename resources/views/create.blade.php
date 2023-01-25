@extends('template')

@section('content')
    <h1>Create post</h1>
    <form action="{{ route('create.send') }}" novalidate method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label>
                Post title:<br>
                <input type="text" placeholder="Post title" name="title" value="{{ old('title') }}">
                @error('title') {{ $message }} @enderror
            </label>
        </div>
        <div>
            <label>
                Post description:<br>
                <textarea placeholder="Post description" name="description">{{ old('description') }}</textarea>
                @error('description') {{ $message }} @enderror
            </label>
        </div>
        <div>
            <label>
                Post content:<br>
                <textarea placeholder="Post content" name="content">{{ old('content') }}</textarea>
                @error('content') {{ $message }} @enderror
            </label>
        </div>
        <div>
            <label>
                Post image:<br>
                <input type="file" name="image">
                @error('image') {{ $message }} @enderror
            </label>
        </div>

        <div>
            <input type="submit" value="Create" name="submit">
        </div>
    </form>
@endsection
