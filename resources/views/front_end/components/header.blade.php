<header class="header-area bg-white shadow-sm">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <div class="logo-box">
                    <a href="{{route("home")}}" class="logo"><img src="{{assets('images/logo-black.png',true)}}"
                                                                  alt="logo"></a>
                    <div class="user-action">
                        <div class="search-menu-toggle icon-element icon-element-xs shadow-sm mr-1"
                             data-toggle="tooltip" data-placement="top" title="Search">
                            <i class="la la-search"></i>
                        </div>
                        <div class="off-canvas-menu-toggle icon-element icon-element-xs shadow-sm" data-toggle="tooltip"
                             data-placement="top" title="Main menu">
                            <i class="la la-bars"></i>
                        </div>
                    </div>
                </div>
            </div><!-- end col-lg-2 -->
            <div class="col-lg-10">
                <div class="menu-wrapper border-left border-left-gray pl-4 justify-content-end">
                    <nav class="menu-bar mr-auto menu--bar">
                        <ul>
                            <li>
                                <a href="#">Home <i class="la la-angle-down fs-11"></i></a>
                                <ul class="dropdown-menu-item">
                                    <li><a href="{{assets('index.html',true)}}">Home - landing</a></li>
                                    <li><a href="{{assets('home-2.html',true)}}">Home - main</a></li>
                                    <li><a href="{{assets('home-3.html',true)}}">Home - layout 2 <span
                                                    class="badge bg-warning text-white">New</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="is-mega-menu">
                                <a href="#">pages <i class="la la-angle-down fs-11"></i></a>
                                <div class="dropdown-menu-item mega-menu">
                                    <ul class="row">
                                        <li class="col-lg-3">
                                            <a href="{{assets('user-profile.html',true)}}">user profile</a>
                                            <a href="{{assets('notifications.html',true)}}">Notifications</a>
                                            <a href="{{assets('referrals.html',true)}}">Referrals</a>
                                            <a href="{{assets('setting.html',true)}}">settings</a>
                                            <a href="{{assets('ask-question.html',true)}}">ask question</a>
                                            <a href="{{assets('question-details.html',true)}}">question details</a>
                                            <a href="{{assets('about.html',true)}}">about</a>
                                            <a href="{{assets('revisions.html',true)}}">revisions</a>
                                            <a href="{{assets('category.html',true)}}">category</a>
                                            <a href="{{assets('companies.html',true)}}">companies</a>
                                            <a href="{{assets('company-details.html',true)}}">company details</a>
                                        </li>
                                        <li class="col-lg-3">
                                            <a href="careers.html">careers</a>
                                            <a href="career-details.html">career details</a>
                                            <a href="contact.html">contact</a>
                                            <a href="faq.html">FAQs</a>
                                            <a href="pricing-table.html">pricing tables</a>
                                            <a href="error.html">page 404</a>
                                            <a href="terms-and-conditions.html">Terms & conditions</a>
                                            <a href="privacy-policy.html">privacy policy</a>
                                            <a href="cart.html">cart</a>
                                            <a href="talent.html">talent</a>
                                            <a href="advertising.html">advertising</a>
                                        </li>
                                        <li class="col-lg-3">
                                            <a href="free-demo.html">free demo</a>
                                            <a href="checkout.html">checkout</a>
                                            <a href="wishlist.html">wishlist</a>
                                            <a href="login.html">login</a>
                                            <a href="login-2.html">login 2</a>
                                            <a href="signup.html">sign up</a>
                                            <a href="signup-2.html">sign up 2</a>
                                            <a href="recover-password.html">recover password</a>
                                            <a href="questions-layout-2.html">questions layout 2 <span
                                                        class="badge bg-warning text-white">New</span></a>
                                            <a href="questions-full-width.html">questions full-width <span
                                                        class="badge bg-warning text-white">New</span></a>
                                            <a href="questions-left-sidebar.html">questions left sidebar <span
                                                        class="badge bg-warning text-white">New</span></a>
                                        </li>
                                        <li class="col-lg-3">
                                            <a href="questions-right-sidebar.html">questions right sidebar <span
                                                        class="badge bg-warning text-white">New</span></a>
                                            <a href="user-list.html">user list <span
                                                        class="badge bg-warning text-white">New</span></a>
                                            <a href="{{route("frontend-category-list")}}">category list <span
                                                        class="badge bg-warning text-white">New</span></a>
                                            <a href="tags-list.html">tags list <span
                                                        class="badge bg-warning text-white">New</span></a>
                                            <a href="add-post.html">add post <span class="badge bg-warning text-white">New</span></a>
                                            <a href="badges-list.html">Badges list <span
                                                        class="badge bg-warning text-white">New</span></a>
                                            <a href="job-list.html">job list <span class="badge bg-warning text-white">New</span></a>
                                            <a href="error-2.html">page 404 2 <span class="badge bg-warning text-white">New</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">blog <i class="la la-angle-down fs-11"></i></a>
                                <ul class="dropdown-menu-item">
                                    <li><a href="blog-grid-no-sidebar.html">grid no sidebar</a></li>
                                    <li><a href="blog-left-sidebar.html">blog left sidebar</a></li>
                                    <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                                    <li><a href="blog-single.html">blog detail</a></li>
                                </ul>
                            </li>
                        </ul><!-- end ul -->
                    </nav><!-- end main-menu -->
                    <form method="post" class="mr-2">
                        <div class="form-group mb-0">
                            <input class="form-control form--control h-auto py-2" type="text" name="search"
                                   placeholder="Type your search words...">
                            <button class="form-btn" type="button"><i class="la la-search"></i></button>
                        </div>
                    </form>
                    @if(Route::has('login'))
                        @auth
                            <div class="nav-right-button">
                                <ul class="user-action-wrap d-flex align-items-center">
                                    <li class="dropdown">
                                        <span class="ball red ball-lg noti-dot"></span>
                                        <a class="nav-link dropdown-toggle dropdown--toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="la la-bell"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown--menu dropdown-menu-right mt-3 keep-open" aria-labelledby="notificationDropdown">
                                            <h6 class="dropdown-header"><i class="la la-bell pr-1 fs-16"></i>Notifications</h6>
                                            <div class="dropdown-divider border-top-gray mb-0"></div>
                                            <div class="dropdown-item-list">
                                                <a class="dropdown-item" href="notifications.html">
                                                    <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                                        <div class="media-img media-img-sm flex-shrink-0">
                                                            <img src="images/img3.jpg" alt="avatar">
                                                        </div>
                                                        <div class="media-body p-0 border-left-0">
                                                            <h5 class="fs-14 fw-regular">John Doe following your post</h5>
                                                            <small class="meta d-block lh-24">
                                                                <span>45 secs ago</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="notifications.html">
                                                    <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                                        <div class="media-img media-img-sm flex-shrink-0">
                                                            <img src="images/img4.jpg" alt="avatar">
                                                        </div>
                                                        <div class="media-body p-0 border-left-0">
                                                            <h5 class="fs-14 fw-regular">Arnold Smith answered on your post</h5>
                                                            <small class="meta d-block lh-24">
                                                                <span>5 mins ago</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item" href="notifications.html">
                                                    <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                                        <div class="media-img media-img-sm flex-shrink-0">
                                                            <img src="images/img4.jpg" alt="avatar">
                                                        </div>
                                                        <div class="media-body p-0 border-left-0">
                                                            <h5 class="fs-14 fw-regular">Saeed bookmarked your post</h5>
                                                            <small class="meta d-block lh-24">
                                                                <span>1 hour ago</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <a class="dropdown-item pb-1 border-bottom-0 text-center btn-text fw-regular" href="notifications.html">View All Notifications <i class="la la-arrow-right icon ml-1"></i></a>
                                        </div>
                                    </li>
                                    <li class="dropdown user-dropdown">
                                        <a class="nav-link dropdown-toggle dropdown--toggle pl-2" href="#" id="userMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                                <div class="media-img media-img-xs flex-shrink-0 rounded-full mr-2">
                                                    <img src="{{getProfileThumbnail(
                            auth()->user()->id,'small',auth()->user()->profile_pic )}}" alt="avatar" class="rounded-full">
                                                </div>
                                                <div class="media-body p-0 border-left-0">
                                                    <h5 class="fs-14">{{auth()->user()->name}}</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown--menu dropdown-menu-right mt-3 keep-open" aria-labelledby="userMenuDropdown" style="">
                                            <h6 class="dropdown-header">Hi, {{auth()->user()->name}}</h6>
                                            <div class="dropdown-divider border-top-gray mb-0"></div>
                                            <div class="dropdown-item-list">
                                                <a class="dropdown-item" href="notifications.html"><i class="la la-bell mr-2"></i>Notifications</a>
                                                <a class="dropdown-item" href="{{route("profile-setting",["id"=>auth()->user()->id])}}"><i class="la la-gear mr-2"></i>Settings</a>
                                                <a class="dropdown-item" href="#"  onclick="logout()"><i class="la la-power-off mr-2"></i>Log out</a>


                                                {{--<a href="#">--}}
                                                    {{--<button type="button" onclick="logout()">Logout</button>--}}
                                                {{--</a>--}}
                                                <form id="logout" action="{{route("logout")}}" method="post" style="float: right ;display: none">
                                                    {{csrf_field()}}
                                                    <input type="submit" name="sub" value="Log Out">
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>


                        @else
                            {{--<a href="{{ route('login') }}"--}}
                               {{--class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>--}}
                            {{--@if (Route::has('register'))--}}
                                {{--<a href="{{ route('register') }}"--}}
                                   {{--class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>--}}
                            {{--@endif--}}
                        @endauth
                        {{--{{"login"}}--}}
                    @else
                        {{"logout"}}
                    @endif
                    {{--<div class="nav-right-button">--}}
                    {{--<a href="login.html" class="btn theme-btn theme-btn-sm theme-btn-outline mr-1">Log in</a>--}}
                    {{--<a href="signup.html" class="btn theme-btn theme-btn-sm">Sign up</a>--}}
                    {{--</div><!-- end nav-right-button -->--}}
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