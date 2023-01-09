@extends("front_end/layout/main")
@section("content")


    @if(Route::has('login'))
        @auth
            @php

                    $id =auth()->user()->id;
            $profilePic  = auth()->user()->profile_pic;
           // dd($profilePic);
            @endphp
            <section class="hero-area bg-white shadow-sm overflow-hidden pt-60px">
                <span class="stroke-shape stroke-shape-1"></span>
                <span class="stroke-shape stroke-shape-2"></span>
                <span class="stroke-shape stroke-shape-3"></span>
                <span class="stroke-shape stroke-shape-4"></span>
                <span class="stroke-shape stroke-shape-5"></span>
                <span class="stroke-shape stroke-shape-6"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="hero-content d-flex align-items-center">
                                <div class="icon-element shadow-sm flex-shrink-0 mr-3 border border-gray lh-55">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 0 24 24"
                                         width="32px"
                                         fill="#2d86eb">
                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                        <path d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"></path>
                                    </svg>
                                </div>
                                <h2 class="section-title fs-30">Acount Settings</h2>
                            </div><!-- end hero-content -->
                        </div><!-- end col-lg-8 -->
                        <div class="col-lg-4">
                            <div class="hero-btn-box text-right py-3">
                                <a href="user-profile.html"
                                   class="btn theme-btn theme-btn-outline theme-btn-outline-gray"><i
                                            class="la la-user mr-1"></i>View Profile</a>
                            </div>
                        </div><!-- end col-lg-4 -->
                    </div><!-- end row -->
                    <ul class="nav nav-tabs generic-tabs generic--tabs generic--tabs-2 mt-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="edit-profile-tab" data-toggle="tab" href="#edit-profile"
                               role="tab"
                               aria-controls="edit-profile" aria-selected="true">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password"
                               role="tab"
                               aria-controls="change-password" aria-selected="false">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="delete-account-tab" data-toggle="tab" href="#delete-account"
                               role="tab"
                               aria-controls="delete-account" aria-selected="false">Delete Account</a>
                        </li>
                    </ul>
                </div><!-- end container -->
            </section>
            <section class="user-details-area pt-40px pb-40px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="tab-content mb-50px" id="myTabContent">
                                <div class="tab-pane fade show active" id="edit-profile" role="tabpanel"
                                     aria-labelledby="edit-profile-tab">
                                    <div class="user-panel-main-bar">
                                        <div class="user-panel">
                                            <div class="bg-gray p-3 rounded-rounded">
                                                <h3 id="profile-pic" class="fs-17">Edit your profile</h3>
                                            </div>


                                            <form method="post" action="{{route("update-profile-pic",["id"=>$id])}}"
                                                  enctype="multipart/form-data"
                                                  class="pt-35px MultiFile-intercepted">
                                                @if(Session::has('alert-delete-frontend-user-profile'))
                                                    {!!Session::get('alert-delete-frontend-user-profile')!!}
                                                @endif
                                                @if(Session::has('alert-update-user-profile-pic'))
                                                    {!!Session::get('alert-update-user-profile-pic')!!}
                                                @endif
                                                @csrf
                                                <div class="settings-item mb-10px">
                                                    <h4 class="fs-14 pb-2 text-gray text-uppercase">Public
                                                        information</h4>
                                                    <div class="divider"><span></span></div>
                                                    <div class="row pt-4 align-items-center">
                                                        <div class="col-lg-6">
                                                            <div class="edit-profile-photo d-flex flex-wrap align-items-center">
                                                                @php
                                                                    $profilePic = getProfileThumbnail(auth()->user()->id,'large',auth()->user()->profile_pic );
                                                                @endphp
                                                                @if(isset(auth()->user()->profile_pic ) && !empty(auth()->user()->profile_pic ))

                                                                    <img src="{{$profilePic}}"
                                                                         alt="user avatar"
                                                                         class="profile-img mr-4" width="200px">
                                                                    <div>
                                                                        <div class="file-upload-wrap file--upload-wrap">
                                                                            <div class="MultiFile-wrap" id="MultiFile1">
                                                                                <input type="file" name="profile_pic"
                                                                                       class="multi file-upload-input MultiFile-applied"
                                                                                       multiple="" id="MultiFile1"
                                                                                       value="{{old("profile_pic")}}">
                                                                                <div class="MultiFile-list"
                                                                                     id="MultiFile1_list">
                                                                                    <a class="del_ete  btn default"
                                                                                       style="margin-top: 10px"
                                                                                       href="{{route('delete-user-profile-pic',["id"=>$id])}}">
                                                                                        Delete
                                                                                    </a>

                                                                                </div>
                                                                            </div>
                                                                            <span class="file-upload-text"><i
                                                                                        class="la la-photo mr-2 "></i>Upload Photo</span>

                                                                        </div>


                                                                    </div>

                                                                @else

                                                                    <img src="{{$profilePic}}"
                                                                         alt="user avatar"
                                                                         class="profile-img mr-4">
                                                                    <div>
                                                                        <div class="file-upload-wrap file--upload-wrap">
                                                                            <div class="MultiFile-wrap" id="MultiFile1">
                                                                                <input type="file" name="profile_pic"
                                                                                       class="multi file-upload-input MultiFile-applied"
                                                                                       multiple="" id="MultiFile1"
                                                                                       value="{{old("profile_pic")}}">
                                                                                <div class="MultiFile-list"
                                                                                     id="MultiFile1_list"></div>
                                                                            </div>
                                                                            <span class="file-upload-text"><i
                                                                                        class="la la-photo mr-2 "></i>Upload Photo</span>

                                                                        </div>


                                                                    </div>

                                                                @endif

                                                            </div><!-- end edit-profile-photo -->
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6">
                                                            <div class="input-box">
                                                                <label class="fs-13 text-black lh-20 fw-medium">Display
                                                                    name</label>
                                                                <div class="form-group">
                                                                    <input class="form-control form--control"
                                                                           type="text"
                                                                           name="name" value="{{auth()->user()->name}}">
                                                                </div>
                                                            </div>
                                                            <div class="input-box">
                                                                <label class="fs-13 text-black lh-20 fw-medium">Location</label>
                                                                <div class="form-group">
                                                                    <input class="form-control form--control"
                                                                           type="text"
                                                                           name="country"
                                                                           value="{{auth()->user()->country}}">
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-12">
                                                            <div class="input-box">
                                                                <label class="fs-15 text-black lh-20 fw-medium">About
                                                                    me</label>
                                                                <div class="form-group">
                                                                    <div class="jqte">
                                                                        <div class="jqte_toolbar unselectable"
                                                                             role="toolbar" unselectable="on"
                                                                             style="user-select: none;">
                                                                            <div class="jqte_tool jqte_tool_1 unselectable"
                                                                                 role="button" data-tool="0"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_label unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"><span
                                                                                            class="jqte_tool_text unselectable"
                                                                                            unselectable="on"
                                                                                            style="user-select: none;">Paragraph</span><span
                                                                                            class="jqte_tool_icon unselectable"
                                                                                            unselectable="on"
                                                                                            style="user-select: none;"></span></a>
                                                                                <div class="jqte_formats unselectable"
                                                                                     unselectable="on"
                                                                                     style="user-select: none;"><a
                                                                                            jqte-formatval="p"
                                                                                            class="jqte_format jqte_format_0 unselectable"
                                                                                            role="menuitem"
                                                                                            unselectable="on"
                                                                                            style="user-select: none;">Paragraph</a><a
                                                                                            jqte-formatval="h1"
                                                                                            class="jqte_format jqte_format_1 unselectable"
                                                                                            role="menuitem"
                                                                                            unselectable="on"
                                                                                            style="user-select: none;">Heading
                                                                                        1</a><a jqte-formatval="h2"
                                                                                                class="jqte_format jqte_format_2 unselectable"
                                                                                                role="menuitem"
                                                                                                unselectable="on"
                                                                                                style="user-select: none;">Heading
                                                                                        2</a><a jqte-formatval="h3"
                                                                                                class="jqte_format jqte_format_3 unselectable"
                                                                                                role="menuitem"
                                                                                                unselectable="on"
                                                                                                style="user-select: none;">Heading
                                                                                        3</a><a jqte-formatval="h4"
                                                                                                class="jqte_format jqte_format_4 unselectable"
                                                                                                role="menuitem"
                                                                                                unselectable="on"
                                                                                                style="user-select: none;">Heading
                                                                                        4</a><a jqte-formatval="h5"
                                                                                                class="jqte_format jqte_format_5 unselectable"
                                                                                                role="menuitem"
                                                                                                unselectable="on"
                                                                                                style="user-select: none;">Heading
                                                                                        5</a><a jqte-formatval="h6"
                                                                                                class="jqte_format jqte_format_6 unselectable"
                                                                                                role="menuitem"
                                                                                                unselectable="on"
                                                                                                style="user-select: none;">Heading
                                                                                        6</a><a jqte-formatval="pre"
                                                                                                class="jqte_format jqte_format_7 unselectable"
                                                                                                role="menuitem"
                                                                                                unselectable="on"
                                                                                                style="user-select: none;">Preformatted</a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_2 unselectable"
                                                                                 role="button" data-tool="1"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                                <div class="jqte_fontsizes unselectable"
                                                                                     unselectable="on"
                                                                                     style="user-select: none;"><a
                                                                                            jqte-styleval="10"
                                                                                            class="jqte_fontsize unselectable"
                                                                                            style="font-size: 10px; user-select: none;"
                                                                                            role="menuitem"
                                                                                            unselectable="on">Abcdefgh...</a><a
                                                                                            jqte-styleval="12"
                                                                                            class="jqte_fontsize unselectable"
                                                                                            style="font-size: 12px; user-select: none;"
                                                                                            role="menuitem"
                                                                                            unselectable="on">Abcdefgh...</a><a
                                                                                            jqte-styleval="16"
                                                                                            class="jqte_fontsize unselectable"
                                                                                            style="font-size: 16px; user-select: none;"
                                                                                            role="menuitem"
                                                                                            unselectable="on">Abcdefgh...</a><a
                                                                                            jqte-styleval="18"
                                                                                            class="jqte_fontsize unselectable"
                                                                                            style="font-size: 18px; user-select: none;"
                                                                                            role="menuitem"
                                                                                            unselectable="on">Abcdefgh...</a><a
                                                                                            jqte-styleval="20"
                                                                                            class="jqte_fontsize unselectable"
                                                                                            style="font-size: 20px; user-select: none;"
                                                                                            role="menuitem"
                                                                                            unselectable="on">Abcdefgh...</a><a
                                                                                            jqte-styleval="24"
                                                                                            class="jqte_fontsize unselectable"
                                                                                            style="font-size: 24px; user-select: none;"
                                                                                            role="menuitem"
                                                                                            unselectable="on">Abcdefgh...</a><a
                                                                                            jqte-styleval="28"
                                                                                            class="jqte_fontsize unselectable"
                                                                                            style="font-size: 28px; user-select: none;"
                                                                                            role="menuitem"
                                                                                            unselectable="on">Abcdefgh...</a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_3 unselectable"
                                                                                 role="button" data-tool="2"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                                <div class="jqte_cpalette unselectable"
                                                                                     unselectable="on"
                                                                                     style="user-select: none;"><a
                                                                                            jqte-styleval="0,0,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(0, 0, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="68,68,68"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(68, 68, 68); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="102,102,102"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(102, 102, 102); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="153,153,153"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(153, 153, 153); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="204,204,204"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(204, 204, 204); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="238,238,238"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(238, 238, 238); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="243,243,243"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(243, 243, 243); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="255,255,255"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(255, 255, 255); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a>
                                                                                    <div class="jqte_colorSeperator"></div>
                                                                                    <a jqte-styleval="255,0,0"
                                                                                       class="jqte_color unselectable"
                                                                                       style="background-color: rgb(255, 0, 0); user-select: none;"
                                                                                       role="gridcell"
                                                                                       unselectable="on"></a><a
                                                                                            jqte-styleval="255,153,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(255, 153, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="255,255,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(255, 255, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="0,255,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(0, 255, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="0,255,255"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(0, 255, 255); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="0,0,255"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(0, 0, 255); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="153,0,255"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(153, 0, 255); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="255,0,255"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(255, 0, 255); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a>
                                                                                    <div class="jqte_colorSeperator"></div>
                                                                                    <a jqte-styleval="244,204,204"
                                                                                       class="jqte_color unselectable"
                                                                                       style="background-color: rgb(244, 204, 204); user-select: none;"
                                                                                       role="gridcell"
                                                                                       unselectable="on"></a><a
                                                                                            jqte-styleval="252,229,205"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(252, 229, 205); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="255,242,204"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(255, 242, 204); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="217,234,211"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(217, 234, 211); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="208,224,227"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(208, 224, 227); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="207,226,243"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(207, 226, 243); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="217,210,233"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(217, 210, 233); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="234,209,220"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(234, 209, 220); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="234,153,153"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(234, 153, 153); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="249,203,156"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(249, 203, 156); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="255,229,153"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(255, 229, 153); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="182,215,168"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(182, 215, 168); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="162,196,201"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(162, 196, 201); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="159,197,232"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(159, 197, 232); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="180,167,214"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(180, 167, 214); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="213,166,189"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(213, 166, 189); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="224,102,102"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(224, 102, 102); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="246,178,107"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(246, 178, 107); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="255,217,102"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(255, 217, 102); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="147,196,125"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(147, 196, 125); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="118,165,175"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(118, 165, 175); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="111,168,220"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(111, 168, 220); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="142,124,195"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(142, 124, 195); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="194,123,160"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(194, 123, 160); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="204,0,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(204, 0, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="230,145,56"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(230, 145, 56); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="241,194,50"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(241, 194, 50); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="106,168,79"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(106, 168, 79); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="69,129,142"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(69, 129, 142); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="61,133,198"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(61, 133, 198); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="103,78,167"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(103, 78, 167); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="166,77,121"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(166, 77, 121); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="153,0,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(153, 0, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="180,95,6"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(180, 95, 6); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="191,144,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(191, 144, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="56,118,29"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(56, 118, 29); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="19,79,92"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(19, 79, 92); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="11,83,148"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(11, 83, 148); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="53,28,117"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(53, 28, 117); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="116,27,71"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(116, 27, 71); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="102,0,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(102, 0, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="120,63,4"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(120, 63, 4); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="127,96,0"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(127, 96, 0); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="39,78,19"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(39, 78, 19); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="12,52,61"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(12, 52, 61); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="7,55,99"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(7, 55, 99); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="32,18,77"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(32, 18, 77); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a><a
                                                                                            jqte-styleval="76,17,48"
                                                                                            class="jqte_color unselectable"
                                                                                            style="background-color: rgb(76, 17, 48); user-select: none;"
                                                                                            role="gridcell"
                                                                                            unselectable="on"></a></div>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_4 unselectable"
                                                                                 role="button" data-tool="3"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_5 unselectable"
                                                                                 role="button" data-tool="4"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_6 unselectable"
                                                                                 role="button" data-tool="5"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_7 unselectable"
                                                                                 role="button" data-tool="6"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_8 unselectable"
                                                                                 role="button" data-tool="7"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_9 unselectable"
                                                                                 role="button" data-tool="8"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_10 unselectable"
                                                                                 role="button" data-tool="9"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_11 unselectable"
                                                                                 role="button" data-tool="10"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_12 unselectable"
                                                                                 role="button" data-tool="11"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_13 unselectable"
                                                                                 role="button" data-tool="12"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_14 unselectable"
                                                                                 role="button" data-tool="13"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_15 unselectable"
                                                                                 role="button" data-tool="14"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_16 unselectable"
                                                                                 role="button" data-tool="15"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_17 unselectable"
                                                                                 role="button" data-tool="16"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_18 unselectable"
                                                                                 role="button" data-tool="17"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_19 unselectable"
                                                                                 role="button" data-tool="18"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_20 unselectable"
                                                                                 role="button" data-tool="19"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                            <div class="jqte_tool jqte_tool_21 unselectable"
                                                                                 role="button" data-tool="20"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;"><a
                                                                                        class="jqte_tool_icon unselectable"
                                                                                        unselectable="on"
                                                                                        style="user-select: none;"></a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="jqte_linkform" style="display:none"
                                                                             role="dialog">
                                                                            <div class="jqte_linktypeselect unselectable"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;">
                                                                                <div class="jqte_linktypeview unselectable"
                                                                                     unselectable="on"
                                                                                     style="user-select: none;">
                                                                                    <div class="jqte_linktypearrow unselectable"
                                                                                         unselectable="on"
                                                                                         style="user-select: none;"></div>
                                                                                    <div class="jqte_linktypetext">Web
                                                                                        Address
                                                                                    </div>
                                                                                </div>
                                                                                <div class="jqte_linktypes unselectable"
                                                                                     role="menu" unselectable="on"
                                                                                     style="user-select: none; display: none;">
                                                                                    <a jqte-linktype="0"
                                                                                       unselectable="on"
                                                                                       class="unselectable"
                                                                                       style="user-select: none;">Web
                                                                                        Address</a><a jqte-linktype="1"
                                                                                                      unselectable="on"
                                                                                                      class="unselectable"
                                                                                                      style="user-select: none;">E-mail
                                                                                        Address</a><a jqte-linktype="2"
                                                                                                      unselectable="on"
                                                                                                      class="unselectable"
                                                                                                      style="user-select: none;">Picture
                                                                                        URL</a></div>
                                                                            </div>
                                                                            <input class="jqte_linkinput"
                                                                                   type="text/css" value="">
                                                                            <div class="jqte_linkbutton unselectable"
                                                                                 unselectable="on"
                                                                                 style="user-select: none;">OK
                                                                            </div>
                                                                            <div style="height:1px;float:none;clear:both"></div>
                                                                        </div>
                                                                        <div class="jqte_editor" contenteditable="true"
                                                                             style="height: 160px;"></div>
                                                                        <div class="jqte_source jqte_hiddenField">
                                                                            <textarea
                                                                                    class="form-control form--control user-text-editor"
                                                                                    rows="10" cols="40"
                                                                                    data-origin="textarea"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end row -->
                                                </div><!-- end settings-item -->
                                                <div class="col-lg-12">
                                                    <div class="submit-btn-box pt-3">
                                                        <button class="btn theme-btn" type="submit">Save changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!-- end user-panel -->
                                    </div><!-- end user-panel-main-bar -->
                                </div><!-- end tab-pane -->

                                <div class="tab-pane fade" id="change-password" role="tabpanel"
                                     aria-labelledby="change-password-tab">
                                    <div class="user-panel-main-bar">
                                        <div class="user-panel">
                                            <div class="bg-gray p-3 rounded-rounded">
                                                <h3 class="fs-17">Change password</h3>
                                            </div>
                                            <form method="post" action="{{route("profile-pass-setting",["id"=>$id])}}"
                                                  class="pt-20px MultiFile-intercepted">
                                                @if(Session::has('alert-delete-frontend-user-pass'))
                                                    {!!Session::get('alert-delete-frontend-user-pass')!!}
                                                @endif
                                                @csrf
                                                <div id="password-update"></div>
                                                <div class="settings-item mb-30px">
                                                    <div class="form-group">
                                                        <label class="fs-13 text-black lh-20 fw-medium">Current
                                                            Password</label>
                                                        <input class="form-control form--control password-field"
                                                               type="password"
                                                               name="password" placeholder="Current password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="fs-13 text-black lh-20 fw-medium">New
                                                            Password</label>
                                                        <input class="form-control form--control password-field"
                                                               type="password"
                                                               name="password" placeholder="New password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="fs-13 text-black lh-20 fw-medium">New Password
                                                            (again)</label>
                                                        <input class="form-control form--control password-field"
                                                               type="password"
                                                               name="password" placeholder="New password again">
                                                        <p class="fs-14 lh-18 py-2">Passwords must contain at least
                                                            eight
                                                            characters, including at least 1 letter and 1 number.</p>
                                                        <button class="btn theme-btn-outline theme-btn-outline-gray toggle-password"
                                                                type="button" data-toggle="tooltip"
                                                                data-placement="right"
                                                                title="" data-original-title="Show/hide password">
                                                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg"
                                                                 height="22px"
                                                                 viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"></path>
                                                            </svg>
                                                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg"
                                                                 height="22px" viewBox="0 0 24 24" width="22px"
                                                                 fill="#7f8897">
                                                                <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z"
                                                                      fill="none"></path>
                                                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="submit-btn-box pt-3">
                                                        <button class="btn theme-btn" type="submit">Change Password
                                                        </button>
                                                    </div>
                                                </div><!-- end settings-item -->
                                                <div class="border border-gray p-4">
                                                    <h4 class="fs-18 mb-2">Forgot your password</h4>
                                                    <p class="pb-3">Don't worry it's happen with everyone. We'll help
                                                        you to get
                                                        back your password</p>
                                                    <a href="recover-password.html"
                                                       class="btn theme-btn theme-btn-sm theme-btn-white">Recover
                                                        Password <i
                                                                class="la la-arrow-right ml-1"></i></a>
                                                </div>
                                            </form>
                                        </div><!-- end user-panel -->
                                    </div><!-- end user-panel-main-bar -->
                                </div><!-- end tab-pane -->
                                <div class="tab-pane fade" id="delete-account" role="tabpanel"
                                     aria-labelledby="delete-account-tab">
                                    <div class="user-panel-main-bar">
                                        <div class="user-panel">
                                            <div class="delete-account-info card card-item border border-danger">
                                                <div class="card-body">
                                                    <h3 class="fs-22 text-danger fw-bold">Delete Account</h3>
                                                    <p class="pb-3 pt-2 lh-22 fs-15">Before confirming that you would
                                                        like your
                                                        profile deleted, we'd like to take a moment to explain the
                                                        implications
                                                        of deletion:</p>
                                                    <ul class="generic-list-item generic-list-item-bullet fs-15">
                                                        <li>Deletion is irreversible, and you will have no way to regain
                                                            any of
                                                            your original content, should this deletion be carried out
                                                            and you
                                                            change your mind later on.
                                                        </li>
                                                        <li>Your questions and answers will remain on the site, but will
                                                            be
                                                            disassociated and anonymized (the author will be listed as
                                                            "user15319675") and will not indicate your authorship even
                                                            if you
                                                            later return to the site.
                                                        </li>
                                                    </ul>
                                                    <p class="pb-3 pt-2 lh-22 fs-15">Once you delete your account, there
                                                        is no
                                                        going back. Please be certain.</p>
                                                    <div class="custom-control custom-checkbox fs-15 mb-4">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="delete-terms">
                                                        <label class="custom-control-label custom--control-label lh-22"
                                                               for="delete-terms">I have read the information stated
                                                            above and
                                                            understand the implications of having my profile deleted. I
                                                            wish to
                                                            proceed with the deletion of my profile.</label>
                                                    </div>
                                                    <button type="button" class="btn btn-danger fw-medium"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal" id="delete-button" disabled=""><i
                                                                class="la la-trash mr-1"></i> Delete your account
                                                    </button>
                                                </div>
                                            </div>
                                        </div><!-- end user-panel -->
                                    </div><!-- end user-panel-main-bar -->
                                </div><!-- end tab-pane -->
                            </div>
                        </div><!-- end col-lg-9 -->
                        <div class="col-lg-3">
                            <div class="sidebar">
                                <div class="card card-item p-4">
                                    <div class="card-body">
                                        <h3 class="fs-17 pb-3">Number Achievement</h3>
                                        <div class="divider"><span></span></div>
                                        <div class="row no-gutters text-center">
                                            <div class="col-lg-6 responsive-column-half">
                                                <div class="icon-box pt-3">
                                                    <span class="fs-20 fw-bold text-color">980k</span>
                                                    <p class="fs-14">Questions</p>
                                                </div><!-- end icon-box -->
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 responsive-column-half">
                                                <div class="icon-box pt-3">
                                                    <span class="fs-20 fw-bold text-color-2">610k</span>
                                                    <p class="fs-14">Answers</p>
                                                </div><!-- end icon-box -->
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 responsive-column-half">
                                                <div class="icon-box pt-3">
                                                    <span class="fs-20 fw-bold text-color-3">650k</span>
                                                    <p class="fs-14">Answer accepted</p>
                                                </div><!-- end icon-box -->
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6 responsive-column-half">
                                                <div class="icon-box pt-3">
                                                    <span class="fs-20 fw-bold text-color-4">320k</span>
                                                    <p class="fs-14">Users</p>
                                                </div><!-- end icon-box -->
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-12 pt-3">
                                                <p class="fs-14">To get answer of question <a href="signup.html"
                                                                                              class="text-color hover-underline">Join<i
                                                                class="la la-arrow-right ml-1"></i></a></p>
                                            </div>
                                        </div><!-- end row -->
                                    </div>
                                </div><!-- end card -->
                            </div><!-- end sidebar -->
                        </div><!-- end col-lg-3 -->
                    </div><!-- end row -->
                </div><!-- end container -->

                <script>
                    $(document).ready(function () {
                        $(".del_ete").on('click', function (e) {
                            e.preventDefault();
                            var path = jQuery(this).attr('href');
                            console.log(path);
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = path;
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                }
                            })
                        });
                    });
                </script>


            </section><!-- end user-details-area -->
            <!-- ================================
                     END USER DETAILS AREA


@endauth
    @endif

@endsection
