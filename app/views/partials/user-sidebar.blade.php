<div id='cssmenu'>
<ul>
   <li>{{ link_to("user","Home") }}</li>
   <li>{{ link_to("blog/create","Create Blog") }}</li>
   <li>{{ link_to("blog","View All Blog") }}</li>
   <li>{{ link_to("user/update_password","Update password") }}</li>
   <li>{{ link_to_route('user.show', "Profile", ['id'=>Auth::User()->id]); }}</li>
   <li>{{ link_to("user/logout","logout") }}</li>
</ul>
</div>