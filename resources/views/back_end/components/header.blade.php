<div class="header navbar navbar-inverse navbar-fixed-top" style="height:47px">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <a class="navbar-brand" href="{{route('dashboard')}}">
            <img style="width: 100px"
                 src="{{assets('images/qa-forum-high-resolution-logo-white-on-transparent-background.png ',true)}}">
        </a>
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->--}}
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="{{assets('assets/img/menu-toggler.png')}}" alt=""/>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                   data-close-others="true">
                    <img width="30" src="{{getProfileThumbnail(
                            auth()->user()->id,'small',auth()->user()->profile_pic )}}">
                    <span class="username">
					 {{auth()->user()->name}}
				</span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route("admin-edit",["id"=>auth()->user()->id])}}"><i class="fa fa-user"></i> My
                            Profile</a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="#" onclick="logout()">
                            <i class="fa fa-key"></i>Log out
                        </a>
                        <form id="logout" action="{{route("logout")}}" method="post"
                              style="float: right ;display: none">
                            {{csrf_field()}}
                            <input type="submit" name="sub" value="Log Out">
                        </form>
                    </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<script>
    function logout() {
        document.getElementById("logout").submit();
    }
</script>