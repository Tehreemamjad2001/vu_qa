@extends("front_end/layout/main")
@section("content")
    <section class="hero-area section-padding bg-gray">
        <span class="icon-shape icon-shape-1 is-scale"></span>
        <span class="icon-shape icon-shape-2 is-bounce"></span>
        <span class="icon-shape icon-shape-3 is-swing"></span>
        <span class="icon-shape icon-shape-4 is-spin"></span>
        <span class="icon-shape icon-shape-5 is-spin"></span>
        <span class="icon-shape icon-shape-6 is-bounce"></span>
        <span class="icon-shape icon-shape-7 is-tilt"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h3 class="fs-16 fw-medium pb-3">Who we are</h3>
                        <h2 class="section-title fs-40 pb-3 lh-55">Helping developers and technologists write the script
                            of the future.</h2>
                        <p class="lh-26 pb-3">Our public platform <strong class="fw-medium text-black">will be serves 100
                                million people every month</strong>, making it one of the most popular websites in
                            the world.</p>
                    </div><!-- end hero-content -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="generic-img-box h-100">
                        <img class="lazy" src="{{assets("images/img1.jpg",true)}}"
                             data-src="{{assets("images/img1.jpg",true)}}" alt="image">
                        <img class="lazy" src="{{assets("images/img2.jpg",true)}}"
                             data-src="{{assets("images/img2.jpg",true)}}" alt="image">
                        <img class="lazy" src="{{assets("images/img3.jpg",true)}}"
                             data-src="{{assets("images/img3.jpg",true)}}" alt="image">
                        <img class="lazy" src="{{assets("images/img4.jpg",true)}}"
                             data-src="{{assets("images/img4.jpg",true)}}" alt="image">
                    </div>
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <section class="award-area pt-100px pb-70px">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="award-content text-center">
                        <p class="section-desc pb-3">{{ config('app.name') }}’s public platform is used
                            by nearly everyone who codes to learn, share their knowledge, collaborate, and build their
                            careers. Our products and tools help developers and technologists in life and at work.
                        </p>
                    </div>
                </div>
            </div><!-- end row-->
        </div><!-- end container -->
    </section><!-- end award-area -->
@endsection