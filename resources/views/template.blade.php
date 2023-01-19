<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <style>
        .author {
            line-height: 50px;
            display: inline-block;
            vertical-align: middle;
        }

        .author img {
            display: inline-block;
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<nav>
    <b><a href="{{ route('home') }}">Home</a></b> |

    @guest
        <a href="{{ route('login') }}">Login</a> |
        <a href="{{ route('registration') }}">Registration</a>
    @endguest

    @auth
        <a href="#">Create post</a> |
        <a href="#">My posts</a> |
        <a href="{{ route('logout') }}">Logout (test@gmail.com)</a>
    @endauth
</nav>

@yield('content')

<footer>
    &copy; My First Blog 2022
</footer>

</body>
</html>
