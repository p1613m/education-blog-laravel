@extends('template')

@section('content')
    <h1>Create post</h1>
    <form action="{{ route('create.send') }}" novalidate method="post" enctype="multipart/form-data">
        @csrf
        @include('_form', [
            'post' => null,
        ])

        <div>
            <input type="submit" value="Create" name="submit">
        </div>
    </form>
@endsection
