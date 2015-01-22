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
            <h3>{{ link_to("user/update_password","Update password") }}</h3>
        </ul>
    </div>
    <div id="nav">
        <ul>
            <h3>{{ link_to_route('user.show', "Profile", ['id'=>Auth::User()->id]); }}</h3>
        </ul>
    </div>
    <div id="main">
        <ul>
            <h3>{{ link_to("user/logout","logout") }}</h3>
        </ul>
    </div>


</div>