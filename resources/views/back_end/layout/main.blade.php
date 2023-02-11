<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0.3
Version: 1.5.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>{{isset($pageData["page_title"])&&!empty($pageData["page_title"])? $pageData["page_title"].' |  Q/A Forum':''}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{assets('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{assets('assets/css/style-metronic.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{assets('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{assets('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="{{assets('shortcut icon')}}" href="{{assets("favicon.ico")}}"/>

    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="{{assets('assets/plugins/respond.min.js')}}"></script>
    <script src="{{assets('assets/plugins/excanvas.min.js')}}"></script>
    <![endif]-->
    <script src="{{assets('assets/plugins/jquery-1.10.2.min.js')}}" type="text/javascript"></script>
    <script src="{{assets('assets/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{assets('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{assets('assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js')}}"
            type="text/javascript"></script>
    <script src="{{assets('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
            type="text/javascript"></script>
    <script src="{{assets('assets/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{assets('assets/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
    <script src="{{assets('assets/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
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


</head>
<style>
    textarea {
        resize: none;
    }
</style>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
@include("back_end/components/header")
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">

        @include("back_end/components/sidebar")
    </div>


    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        {{isset($pageData["page_heading"])&&!empty($pageData["page_heading"])?$pageData["page_heading"] :''}}
                    </h3>
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="{{route('dashboard')}}">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <?php
                            if(isset($pageData['bc_title_1']) && $pageData['bc_title_1'] != ""){
                            //echo  $pageData['bc_title_1'];
                            ?>
                            <a href="{{$pageData['bc_link_1']}}">{{$pageData['bc_title_1']}}</a>
                            <i class="fa fa-angle-right"></i>
                            {{ isset($pageData['bc_title_2']) && !empty($pageData['bc_title_2']) ? $pageData['bc_title_2'] : ""}}
                            <?php
                            }else{
                            ?>
                        </li>
                        {{ isset($pageData['bc_title_2']) && !empty($pageData['bc_title_2']) ? $pageData['bc_title_2'] : ""}}
                        <li>
                            <?php
                            }
                            ?>


                        </li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            @yield("content")
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
@include("back_end/components/footer")
<!-- END FOOTER -->

<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
        App.init();
        UIBootbox.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
{{--{{dd($pageData['page_title'])}}--}}