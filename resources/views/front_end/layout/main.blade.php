<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from techydevs.com/demos/themes/html/disilab-demo/disilab/category-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Dec 2022 05:46:37 GMT -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Disilab - {{env('APP_NAME')}}</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&amp;display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{assets("images/favicon.png",true)}}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset("css/upvotejs.min.css",true)}}">
    <link rel="stylesheet" href="{{assets("css/bootstrap.min.css", true )}}">
    <link rel="stylesheet" href="{{assets('css/line-awesome.css',true)}}">
    <link rel="stylesheet" href="{{assets('css/owl.carousel.min.css',true)}}">
    <link rel="stylesheet" href="{{assets('css/owl.theme.default.min.css',true)}}">
    <link rel="stylesheet" href="{{assets('css/style.css',true)}}">
    <!-- end inject -->
    <script src="{{assets('js/jquery-3.4.1.min.js',true)}}"></script>
    <script src="{{assets('js/bootstrap.bundle.min.js',true)}}"></script>
    <script src="{{assets('js/owl.carousel.min.js',true)}}"></script>
    <script src="{{assets('js/main.js',true)}}"></script>

    <script src="{{assets('assets/scripts/app.js',true)}}"></script>
    <script src="{{assets('assets/scripts/ui-bootbox.js',true)}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{--<script type="text/javascript" src="{{assets("select2/select2.min.js",true)}}"></script>--}}


    <!-- BEGIN THEME STYLES -->
    <link href="{{assets('assets/css/style-metronic.css',true)}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/style.css',true)}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/style-responsive.css',true)}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/plugins.css',true)}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/custom.css',true)}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="{{assets('shortcut icon',true)}}" href="{{assets("favicon.ico",true)}}"/>
    <link rel="stylesheet" type="text/css" href="{{assets("assets/plugins/select2/select2_metro.css",true)}}"/>
    <script src="{{asset("js/upvote.vanilla.js",true)}}"></script>
    <script src="{{asset("js/upvote-script.js",true)}}"></script>

    <style>
        .readmore .moretext {
            display: none;
        }
    </style>
</head>
<body>

<!-- start cssload-loader -->
<div id="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->

<!--======================================
        START HEADER AREA
    ======================================-->
@include("front_end/components/header")
<!--======================================
        END HEADER AREA
======================================-->

<!-- ================================
         START QUESTION AREA
================================= -->
@yield("content")
<!-- ================================
         END QUESTION AREA
================================= -->

<!-- ================================
         END FOOTER AREA
================================= -->
@php
    $routeName = Route::currentRouteName();
   //dd($routeName);
@endphp
@if($routeName == "login" || $routeName == "register")
    @include("front_end/components/login_signUp_footer")
@else
    @include("front_end/components/footer")
@endif


<!-- ================================
          END FOOTER AREA
================================= -->

<!-- start back to top -->
<div id="back-to-top" data-toggle="tooltip" data-placement="top" title="Return to top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end back to top -->

<!-- template js files -->

</body>
<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
        App.init();
        UIBootbox.init();
    });
</script>
</html>