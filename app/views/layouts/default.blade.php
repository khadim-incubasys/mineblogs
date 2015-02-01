<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>
            @if(isset($title)) {{ $title }} 
            @else
            {{ 'Welcome-Laravel'}}
            @endif
        </title>
        {{ HTML::style( asset('css/all.css') ) }}
        {{ HTML::style( asset('css/style.css') ) }}
        {{ HTML::script( asset('js/jquery-1.11.1.min.js')) }}
        {{ HTML::script( asset('js/jquery-lightbox.js')) }}
        {{ HTML::script( asset('js/all.js')) }}
    </head>
    <body>
        <header class="header row">
            <h1>
                MineBlogs
            </h1>
        </header>
        @if(Auth::check())
        @include('partials.user-sidebar')
        @else
         @include('partials.sidebar')
        @endif

        <div class="content">
            @yield('content')
        </div>
        <footer class="footer row">
            Created By: Khadim
            <div id="copyright text-right">© Copyright 2013 Scotchy Scotch Scotch</div>
        </footer>
    </body>
</html>