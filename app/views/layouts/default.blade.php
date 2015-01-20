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
    </head>
    <body>
        <header class="header row">
            <h1>
                MineBlogs
            </h1>
        </header>
        <div id="wrap">
            <!--<div id="header"><h1>Document Heading</h1></div>-->
            <div id="nav">
                 <ul>
                    <h3>{{ link_to("user","Home") }}</h3>
                 </ul>
            </div>
            <div id="main">
                <ul>
                    <h3>{{ link_to("blog/create","Create Blog") }}</h3>
                </ul>
            </div>
            <div id="nav">
                 <ul>
                   <h3>{{ link_to("blog","View All Blog") }}</h3>
                 </ul>
            </div>
            <div id="main">
                <ul>
                   <h3>{{ link_to_route('user.show', "Profile", ['id'=>Auth::User()->id]); }}</h3>
                </ul>
            </div>
            <div id="nav">
                 <ul>
                   <h3>{{ link_to("user/logout","logout") }}</h3>
                 </ul>
            </div>
            
          
        </div>
        <div class="content">
            @yield('content')
        </div>
        <footer class="footer row">
            Created By: Khadim
            <div id="copyright text-right">© Copyright 2013 Scotchy Scotch Scotch</div>
        </footer>
    </body>
</html>