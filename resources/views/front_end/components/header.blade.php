<?php
$currentRouteName = Route::currentRouteName();
?>
<header class="header-area bg-white shadow-sm bg-white border-bottom border-bottom-gray fixed-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2 ">
                <div class="logo-box">

                    <a href="{{route("home")}}" class="logo">
                        <img src="{{assets('images/qa-forum-logo1.png',true)}}" alt="logo"
                             style="width: 180px "></a>
                </div>

            </div><!-- end col-lg-2 -->
            <div class="col-lg-10">
                <div class="menu-wrapper border-left border-left-gray pl-4 justify-content-end">
                    <nav class="menu-bar mr-auto menu--bar">
                        <ul>
                            <li>
                                <a href="{{route("home")}}"
                                   class="{{$currentRouteName == "home" ? "top_nav_active " : ""}}">Home<i
                                            class=" fs-11"></i></a>
                            </li>
                            <li>
                                <a href="{{route("frontend-category-list")}}"
                                   class="{{$currentRouteName == "frontend-category-list" ? "top_nav_active " : ""}}">Categories<i
                                            class=" fs-11"></i></a>
                            </li>
                            <li class="is-mega-menu">
                                <a href="{{route("about-us") }}"
                                   class="{{$currentRouteName == "about-us" ? "top_nav_active " : ""}}">About Us<i
                                            class=" fs-11"></i></a>
                            </li>
                            <li>
                                <a href="{{route("contact-us")}}"
                                   class="{{$currentRouteName == "contact-us" ? "top_nav_active " : ""}}">Contact Us <i
                                            class=" fs-11"></i></a>
                            </li>
                        </ul><!-- end ul -->
                    </nav><!-- end main-menu -->
                    <form action="{{route("home")}}" class="mr-2 MultiFile-intercepted">
                        <div class="form-group mb-0">
                            <input class="form-control form--control form--control-bg-gray" type="search" name="title"
                                   {{--value="{{$title}}" --}}
                                   placeholder="Type your search words...">
                            <button class="form-btn" type="search"><i class="la la-search"></i></button>
                        </div>
                    </form>
                    @if(Auth::check())
                        <div class="nav-right-button">
                            <ul class="user-action-wrap d-flex align-items-center">
                                <li class="dropdown user-dropdown">
                                    <a class="nav-link dropdown-toggle dropdown--toggle pl-2" href="#"
                                       id="userMenuDropdown" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                            <div class="media-img media-img-xs flex-shrink-0 rounded-full mr-2">
                                                <img src="{{getProfileThumbnail(
                            auth()->user()->id,'small',auth()->user()->profile_pic )}}" alt="avatar"
                                                     class="rounded-full">
                                            </div>
                                            <div class="media-body p-0 border-left-0">
                                                <h5 class="fs-14">{{auth()->user()->name}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown--menu dropdown-menu-right mt-3 keep-open"
                                         aria-labelledby="userMenuDropdown" style="">
                                        <h6 class="dropdown-header">Hi, {{auth()->user()->name}}</h6>
                                        <div class="dropdown-divider border-top-gray mb-0"></div>
                                        <div class="dropdown-item-list">
                                            <a class="dropdown-item"
                                               href="{{route("my-question")}}"><i
                                                        class="la la-gear mr-2"></i>My questions</a>
                                            <a class="dropdown-item"
                                               href="{{route("profile-setting")}}"><i
                                                        class="la la-gear mr-2"></i>Settings</a>
                                            <a class="dropdown-item" href="#" onclick="logout()"><i
                                                        class="la la-power-off mr-2"></i>Log out</a>
                                            <form id="logout" action="{{route("logout")}}" method="post"
                                                  style="float: right ;display: none">
                                                {{csrf_field()}}
                                                <input type="submit" name="sub" value="Log Out">
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="nav-right-button">
                            <a href="{{route("login")}}"
                               class="btn theme-btn {{$currentRouteName == "login" ? "theme-btn-outline" : ""}}"
                            ><i class="la la-sign-in mr-1"></i>
                                Login</a>
                            <a href="{{route("register")}}"
                               class="btn theme-btn  {{$currentRouteName == "register" ? "theme-btn-outline" : ""}}"
                            ><i class="la la-user mr-1"></i> Join</a>
                        </div>

                    @endif
                </div><!-- end menu-wrapper -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="off-canvas-menu custom-scrollbar-styled">
        <div class="off-canvas-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip"
             data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="#">Home</a>
                <ul class="sub-menu">
                    <li><a href="index.html">Home - landing</a></li>
                    <li><a href="home-2.html">Home - main</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Pages</a>
                <ul class="sub-menu">
                    <li><a href="user-profile.html">user profile</a></li>
                    <li><a href="notifications.html">Notifications</a></li>
                    <li><a href="referrals.html">Referrals</a></li>
                    <li><a href="setting.html">settings</a></li>
                    <li><a href="ask-question.html">ask question</a></li>
                    <li><a href="question-details.html">question details</a></li>
                    <li><a href="about.html">about</a></li>
                    <li><a href="revisions.html">revisions</a></li>
                    <li><a href="category.html">category</a></li>
                    <li><a href="companies.html">companies</a></li>
                    <li><a href="company-details.html">company details</a></li>
                    <li><a href="careers.html">careers</a></li>
                    <li><a href="career-details.html">career details</a></li>
                    <li><a href="contact.html">contact</a></li>
                    <li><a href="faq.html">FAQs</a></li>
                    <li><a href="pricing-table.html">pricing tables</a></li>
                    <li><a href="error.html">page 404</a></li>
                    <li><a href="terms-and-conditions.html">Terms & conditions</a></li>
                    <li><a href="privacy-policy.html">privacy policy</a></li>
                </ul>
            </li>
            <li>
                <a href="#">blog</a>
                <ul class="sub-menu">
                    <li><a href="blog-grid-no-sidebar.html">grid no sidebar</a></li>
                    <li><a href="blog-left-sidebar.html">blog left sidebar</a></li>
                    <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                    <li><a href="blog-single.html">blog detail</a></li>
                </ul>
            </li>
        </ul>
        <div class="off-canvas-btn-box px-4 pt-5 text-center">
            <a href="#" class="btn theme-btn theme-btn-sm theme-btn-outline" data-toggle="modal"
               data-target="#loginModal"><i class="la la-sign-in mr-1"></i> Login</a>
            <span class="fs-15 fw-medium d-inline-block mx-2">Or</span>
            <a href="#" class="btn theme-btn theme-btn-sm" data-toggle="modal" data-target="#signUpModal"><i
                        class="la la-plus mr-1"></i> Sign up</a>
        </div>
    </div><!-- end off-canvas-menu -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 mr-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control pl-40px" type="text" name="search"
                           placeholder="Type your search words...">
                    <span class="la la-search input-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
        </div>
    </div><!-- end mobile-search-form -->
    <div class="body-overlay"></div>
</header><!-- end header-area -->
<script>
    function logout() {
        document.getElementById("logout").submit();
    }
</script>