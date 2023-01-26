@extends('template')

@section('content')
    <h1>Login</h1>
    <form action="{{ route('login.send') }}" novalidate method="post">
        @csrf
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
            <input type="submit" value="Login">
        </div>
    </form>
@endsection
