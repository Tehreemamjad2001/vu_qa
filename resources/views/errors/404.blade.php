

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from techydevs.com/demos/themes/html/disilab-demo/disilab/error.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Dec 2022 05:46:27 GMT -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Disilab -  Social Questions and Answers HTML Template</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&amp;display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{assets("images/favicon.png",true)}}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{assets("css/bootstrap.min.css",true)}}">
    <link rel="stylesheet" href="{{assets("css/line-awesome.css",true)}}">
    <link rel="stylesheet" href="{{assets("css/owl.carousel.min.css",true)}}">
    <link rel="stylesheet" href="{{assets("css/owl.theme.default.min.css",true)}}">
    <link rel="stylesheet" href="{{assets("css/jquery.fancybox.min.css",true)}}">
    <link rel="stylesheet" href="{{assets("css/leaflet.css",true)}}">
    <link rel="stylesheet" href="{{assets("css/style.css",true)}}">
    <!-- end inject -->
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

<section class="error-area section-padding position-relative">
    <span class="icon-shape icon-shape-1"></span>
    <span class="icon-shape icon-shape-2"></span>
    <span class="icon-shape icon-shape-3"></span>
    <span class="icon-shape icon-shape-4"></span>
    <span class="icon-shape icon-shape-5"></span>
    <span class="icon-shape icon-shape-6"></span>
    <span class="icon-shape icon-shape-7"></span>
    <div class="container">
        <div class="text-center">
            <img src="{{assets("images/error-img.png",true)}}" alt="error-image" class="img-fluid mb-40px">
            <h2 class="section-title pb-3">Oops! Page not found!</h2>
            <p class="section-desc pb-4">We're sorry, we couldn't find the page you requested.</p>
            <a class="btn theme-btn" href="{{route("home")}}"> Go to homepage </a>
        </div>
    </div><!-- end container -->
</section>
<!-- ================================
         END ERROR AREA
================================= -->


<!-- start back to top -->
<div id="back-to-top" data-toggle="tooltip" data-placement="top" title="Return to top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end back to top -->


<!-- Modal -->
<div class="modal fade modal-container recover-form" id="recoverModal" tabindex="-1" role="dialog" aria-labelledby="recoverModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="recoverModalTitle">Reset password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div>
            <div class="modal-body">
                <p class="fs-15 lh-20 pb-3">
                    Enter your username or email to reset your password.
                    You will receive an email with instructions on how to reset your password. If you are experiencing problems
                    resetting your password <a href="contact.html" class="text-color hover-underline">contact us</a> or <a href="#" class="text-color hover-underline">send us an email</a>
                </p>
                <form method="post">
                    <div class="form-group">
                        <label class="fs-14 text-black fw-medium lh-18">Email</label>
                        <input class="form-control form--control" type="text" name="text" placeholder="Email address">
                    </div>
                    <div class="btn-box">
                        <button type="submit" class="btn theme-btn w-100">
                            Get New Password <i class="la la-arrow-right icon ml-1"></i>
                        </button>
                        <p class="create-account-text text-right fs-14">
                            Not a member? <a class="text-color signup-btn hover-underline" href="javascript:void(0)">Create account</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- template js files -->
<script src="{{assets("js/jquery-3.4.1.min.js",true)}}"></script>
<script src="{{assets("js/bootstrap.bundle.min.js",true)}}"></script>
<script src="{{assets("js/owl.carousel.min.js",true)}}"></script>
<script src="{{assets("js/jquery.fancybox.min.js",true)}}"></script>
<script src="{{assets("js/main.js",true)}}"></script>
</body>

<!-- Mirrored from techydevs.com/demos/themes/html/disilab-demo/disilab/error.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Dec 2022 05:46:27 GMT -->
</html>