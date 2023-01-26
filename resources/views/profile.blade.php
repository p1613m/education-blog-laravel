@extends('template')

@section('content')
    <h1>Profile</h1>

    @error('success')
        <p><b>Success update!</b></p>
    @enderror

    <form action="{{ route('profile.edit.send') }}" method="post" novalidate enctype="multipart/form-data">
        @csrf
        <label>
            Name:<br>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
            @error('name') {{ $message }} @enderror
        </label><br>
        <label>
            Avatar:<br>
            @if($user->avatar_url)
                <img src="{{ $user->avatar_url }}" alt="" style="display: block;width: 100px;">
            @endif
            <input type="file" name="avatar">
            @error('avatar') {{ $message }} @enderror
        </label><br>
        <label>
            Email:<br>
            <input type="text" name="email" value="{{ old('email', $user->email) }}">
            @error('email') {{ $message }} @enderror
        </label><br>
        <label>
            Old Password:<br>
            <input type="password" name="old_password">
            @error('old_password') {{ $message }} @enderror
        </label><br>
        <label>
            New password:<br>
            <input type="password" name="new_password">
            @error('new_password') {{ $message }} @enderror
        </label><br>
        <label>
            New password confirm:<br>
            <input type="password" name="new_password_confirmation">
        </label><br>
        <input type="submit" name="submit" value="Save">
    </form>
@endsection
