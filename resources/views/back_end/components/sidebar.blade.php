<?php
$currentRouteName = Route::currentRouteName();
?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu">


            {{--{{dd($currentrouteName)}}--}}
            <li class="start {{$currentRouteName == "dashboard" ?  "active" :"" }} ">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-home"></i>
                    <span class="title">
						 Dashboard
					</span>
                </a>
            </li>

            <li class="{{ $currentRouteName == "admin-add" || $currentRouteName == "admin-list" ? "active" : ""}}">
                <a href="http://localhost/meme-creator/public/javascript:;?=20221130035639">
                    <i class="fa fa-male"></i>
                    <span class="title">
						 Manage Admin
					</span>
                    <span class="selected">
					</span>
                    <span class="arrow open">
					</span>
                </a>
                <ul class="sub-menu">
                    <li class="start {{$currentRouteName == "admin-add" ?  "active" :"" }} ">
                        <a href="{{route('admin-add')}}">
                            Add Admin</a>
                    </li>
                    <li class="start {{$currentRouteName == "admin-list" ?  "active" :"" }} ">
                        <a href="{{route('admin-list')}}">
                            Admin list </a>
                    </li>


                </ul>
            </li>
            <li class="{{ $currentRouteName == "user-add" || $currentRouteName == "user-list" ? "active" : ""}}">
                <a href="http://localhost/meme-creator/public/javascript:;?=20221130035639">
                    <i class="fa fa-user"></i>
                    <span class="title">
						 Manage User
					</span>
                    <span class="selected">
					</span>
                    <span class="arrow open">
					</span>
                </a>
                <ul class="sub-menu">
                    <li class="start {{$currentRouteName == "user-add" ?  "active" :"" }} ">
                        <a href="{{route("user-add")}}">
                            Add User</a>
                    </li>
                    <li class="start {{$currentRouteName == "user-list" ?  "active" :"" }} ">
                        <a href="{{route("user-list")}}">
                            User List</a>
                    </li>


                </ul>
            </li>
            <li class="{{ $currentRouteName == "category-add" || $currentRouteName == "category-list" ? "active" : ""}}">
                <a href="http://localhost/meme-creator/public/javascript:;?=20221130035639">
                    <i class="fa fa-toggle-down"></i>
                    <span class="title">
						 Manage Category
					</span>
                    <span class="selected">
					</span>
                    <span class="arrow open">
					</span>
                </a>
                <ul class="sub-menu">
                    <li class="start {{$currentRouteName == "category-add" ?  "active" :"" }} ">
                        <a href="{{route("category-add")}}">
                            Add Category</a>
                    </li>
                    <li class="start {{$currentRouteName == "category-list" ?  "active" :"" }} ">
                        <a href="{{route("category-list")}}">
                            Category List</a>
                    </li>


                </ul>
            </li>

            <li class="{{ $currentRouteName == "blocked-keyword-add" || $currentRouteName == "blocked-keyword-list" ? "active" : ""}}">
                <a href="http://localhost/meme-creator/public/javascript:;?=20221130035639">
                    <i class="fa fa-key"></i>
                    <span class="title">
						 Blocked Keyword
					</span>
                    <span class="selected">
					</span>
                    <span class="arrow open">
					</span>
                </a>
                <ul class="sub-menu">
                    <li class="start {{$currentRouteName == "blocked-keyword-add" ?  "active" :"" }} ">
                        <a href="{{route("blocked-keyword-add")}}">
                            Add Blocked Keyword</a>
                    </li>
                    <li class="start {{$currentRouteName == "blocked-keyword-list" ?  "active" :"" }} ">
                        <a href="{{route("blocked-keyword-list")}}">
                            Blocked Keyword List</a>
                    </li>


                </ul>
            </li>

            <li class="{{ $currentRouteName == "question-list" ? "active" : ""}}">
                <a href="http://localhost/meme-creator/public/javascript:;?=20221130035639">
                    <i class="fa fa-question"></i>
                    <span class="title">
						Manage Questions
					</span>
                    <span class="selected">
					</span>
                    <span class="arrow open">
					</span>
                </a>
                <ul class="sub-menu">
                    <li class="start {{$currentRouteName == "question-list" ?  "active" :"" }} ">
                        <a href="{{route("question-list")}}">
                            Question List</a>
                    </li>


                </ul>
            </li>
            <li class="{{ $currentRouteName == "answer-list" ? "active" : ""}}">
                <a href="http://localhost/meme-creator/public/javascript:;?=20221130035639">
                    <i class="fa fa-comments"></i>
                    <span class="title">
						Manage Answer
					</span>
                    <span class="selected">
					</span>
                    <span class="arrow open">
					</span>
                </a>
                <ul class="sub-menu">
                    <li class="start {{$currentRouteName == "answer-list" ?  "active" :"" }} ">
                        <a href="{{route("answer-list")}}">
                            Answer List</a>
                    </li>


                </ul>
            </li>
            <li class="{{ $currentRouteName == "site-setting-list" ? "active" : ""}}">
                <a href="http://localhost/meme-creator/public/javascript:;?=20221130035639">
                    <i class="fa fa-percent">%</i>
                    <span class="title">
						Manage Language Limit
					</span>
                    <span class="selected">
					</span>
                    <span class="arrow open">
					</span>
                </a>
                <ul class="sub-menu">
                    <li class="start {{$currentRouteName == "site-setting-list" ?  "active" :"" }} ">
                        <a href="{{route("site-setting-list")}}">
                            Limit List</a>
                    </li>


                </ul>
            </li>

        </ul>

    </div>
</div>









