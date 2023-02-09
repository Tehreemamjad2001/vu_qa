@php
    require_once 'Text/LanguageDetect.php';
    $ld = new Text_LanguageDetect();
@endphp
        <!DOCTYPE html>
<html lang="en ,ur">

<!-- Mirrored from techydevs.com/demos/themes/html/disilab-demo/disilab/category-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Dec 2022 05:46:37 GMT -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{isset($pageData["page_title"]) && !empty($pageData["page_title"]) ? $pageData["page_title"] ." - ". config('app.name') : "abd234"}} </title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&amp;display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{assets("images/favicon.png",true)}}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{assets("css/upvotejs.min.css", true)}}">

    <link rel="stylesheet" href="{{assets("css/bootstrap.min.css", true )}}">
    <link rel="stylesheet" href="{{assets('css/line-awesome.css',true)}}">
    <link rel="stylesheet" href="{{assets('css/owl.carousel.min.css',true)}}">
    <link rel="stylesheet" href="{{assets('css/owl.theme.default.min.css',true)}}">
    <link rel="stylesheet" href="{{assets('css/style.css',true)}}">
    {{--alert msg css--}}
    <link href="{{assets('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    {{--alert msg css--}}
<!-- end inject -->
    <script src="{{assets('js/jquery-3.4.1.min.js',true)}}"></script>
    <script src="{{assets('js/bootstrap.bundle.min.js',true)}}"></script>
    <script src="{{assets('js/owl.carousel.min.js',true)}}"></script>
    <script src="{{assets('js/main.js',true)}}"></script>

    <script src="{{assets('assets/scripts/app.js',true)}}"></script>
    <script src="{{assets('assets/scripts/ui-bootbox.js',true)}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- BEGIN THEME STYLES -->
    <link href="{{assets('assets/css/style-metronic.css',true)}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/style.css',true)}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/style-responsive.css',true)}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/plugins.css',true)}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/custom.css',true)}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="{{assets('shortcut icon',true)}}" href="{{assets("favicon.ico",true)}}"/>
    <link rel="stylesheet" type="text/css" href="{{assets("assets/plugins/select2/select2_metro.css",true)}}"/>
    <script src="{{assets("js/upvote.vanilla.js",true)}}"></script>
    <script src="{{assets("js/upvote-script.js",true)}}"></script>

    <!-- for drop down -->
    <link rel="stylesheet" href="{{assets("css/selectize.css",true)}}">
    <link rel="stylesheet" href="{{assets("css/style.css",true)}}">
    <!-- end style for drop down -->


    <!--tags-->
    <script src="{{assets('assets/plugins/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{assets('assets/scripts/app.js')}}"></script>
    <script src="{{assets('assets/scripts/ui-bootbox.js')}}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{assets("assets/plugins/select2/select2.min.js")}}"></script>
    <link rel="stylesheet" type="text/css" href="{{assets("assets/plugins/select2/select2_metro.css")}}"/>
    <script type="text/javascript"
            src="{{assets("assets/plugins/jquery-multi-select/js/jquery.multi-select.js")}}"></script>
    <script type="text/javascript"
            src="{{assets("assets/plugins/jquery-multi-select/js/jquery.quicksearch.js")}}"></script>
    <script type="text/javascript"
            src="{{assets("assets/plugins/jquery.input-ip-address-control-1.0.min.js")}}"></script>
    <script type="text/javascript"
            src="{{assets("assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")}}"></script>
    <script type="text/javascript"
            src="{{assets("assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js")}}"></script>
    <script type="text/javascript" src="{{assets("assets/plugins/fuelux/js/spinner.min.js")}}"></script>
    <script src="{{assets("assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js")}}"
            type="text/javascript"></script>
    <script src="{{assets("assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js")}}"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!--tags end-->

    {{--for sweetAlert--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    {{--for sweetAlert--}}


    {{--facebook share button--}}
    <script src="{{ assets('js/share.js',true) }}"></script>
    {{--facebook share button--}}
    <style>
        textarea{
            direction: rtl;
            resize: none;
        }
        .readmore .moretext {
            display: none;
        }

        .top_nav_active {
            color: #2d86eb;
            background-color: rgba(45, 134, 235, .05);
        }

        div#social-links {
            /*width: 20px;*/
            margin: 0 auto;
            max-width: 300px;
        }

        div#social-links ul li {
            display: block;
        }

        div#social-links ul li a {
            padding: 6px;
            border: 1px solid #ccc;
            margin: 15px;
            font-size: 10px;
            color: #222;
            background-color: #ccc;
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