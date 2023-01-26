@extends('template')

@section('content')
<h1>Registration</h1>
<form action="{{ route('registration.send') }}" novalidate method="post">
    @csrf
    <div>
        <label>
            Name:
            <input type="text" placeholder="Your name" name="name"
                   value="{{ old('name') }}"
            >
            @error('name') {{ $message }} @enderror
        </label>
    </div>
    <div>
        <label>
            E-Mail:
            <input type="email" placeholder="Your email" name="email"
                   value="{{ old('email') }}"
            >
            @error('email') {{ $message }} @enderror
        </label>
    </div>
    <div>
        <label>
            Password:
            <input type="password" placeholder="Your password" name="password">
            @error('password') {{ $message }} @enderror
        </label>
    </div>

    <div>
        <input type="submit" value="Registration">
    </div>
</form>
@endsection
