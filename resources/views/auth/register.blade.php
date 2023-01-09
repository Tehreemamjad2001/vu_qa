@extends("front_end/layout/main")
@section('content')
    <section class="sign-up-area pt-80px pb-80px position-relative">
        <div class="container">
            <form action="{{route("register")}}" method="Post" class="card card-item">
                @csrf
                <div class="card-body row p-0">
                    <div class="col-lg-6">
                        <div class="form-content py-4 pr-60px pl-60px border-right border-right-gray h-100 d-flex align-items-center justify-content-center">
                            <img src="{{assets('images/undraw-remotely.svg',true)}}" alt="Image" class="img-fluid">
                        </div>
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-5 mx-auto">
                        <div class="form-action-wrapper py-5">
                            <div class="form-group">
                                <h3 class="fs-22 pb-3 fw-bold">Join the {{env('APP_NAME')}} Community</h3>
                                <div class="divider"><span></span></div>
                                <p class="pt-3">Give us some of your information to get free access to Disilab.</p>
                            </div>
                            <div class="form-group">
                                <label class="fs-14 text-black fw-medium lh-18 "
                                       value="{{ old('name') }}">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name"
                                       class="form-control form--control form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- end form-group -->
                            <div class="form-group">
                                <label class="fs-14 text-black fw-medium lh-18"
                                       value="{{ old('email') }}">{{ __('Email Address') }}</label>
                                <input type="email" name="email"
                                       class="form-control form--control form-control @error('email') is-invalid @enderror"
                                       placeholder="Email address">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- end form-group -->
                            <div class="form-group">
                                <label class="fs-14 text-black fw-medium lh-18">{{ __('Password') }}</label>
                                <div class="input-group mb-1">
                                    <input class="form-control form--control password-field form-control @error('password') is-invalid @enderror"
                                           type="password" name="password" placeholder="Password" required
                                           autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="input-group-append">
                                        <button class="btn theme-btn-outline theme-btn-outline-gray toggle-password"
                                                type="button">
                                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px"
                                                 viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
                                            </svg>
                                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px"
                                                 viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                                <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z"
                                                      fill="none"/>
                                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <p class="fs-13 lh-18">Passwords must contain at least eight characters, including at
                                    least 1 letter and 1 number.</p>
                            </div><!-- end form-group -->
                            <div class="form-group">
                                <label class="fs-14 text-black fw-medium lh-18">{{ __('Confirm Password') }}</label>
                                <div class="input-group mb-1">
                                    <input class="form-control form--control password-field form-control @error('password') is-invalid @enderror"
                                           type="password" id="password-confirm" name="password_confirmation"
                                           placeholder="Password" required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn theme-btn-outline theme-btn-outline-gray toggle-password"
                                                type="button">
                                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px"
                                                 viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
                                            </svg>
                                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px"
                                                 viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                                <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z"
                                                      fill="none"/>
                                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <p class="fs-13 lh-18">Passwords must contain at least eight characters, including at
                                    least 1 letter and 1 number.</p>
                            </div><!-- end form-group -->
                            <div class="form-group">
                                <div class="d-flex align-items-center">
                                    <div class="custom-control custom-checkbox fs-13 mr-4">
                                        <input type="checkbox" class="custom-control-input" id="opt-in">
                                        <label class="custom-control-label custom--control-label lh-18" for="opt-in">Opt-in
                                            to receive occasional product updates, user research invitations, company
                                            announcements, and digests.</label>
                                    </div>
                                    <button type="button" class="popover-trigger btn border border-gray py-1 lh-18 px-2"
                                            data-container="body" data-toggle="popover" data-placement="top">
                                        <svg aria-hidden="true" class="svg-icon-color-gray" width="14" height="14">
                                            <path d="M7 1a6 6 0 100 12A6 6 0 007 1zm1.06 9.06c-.02.63-.48 1.02-1.1 1-.57-.02-1.03-.43-1.01-1.06.02-.63.5-1.04 1.08-1.02.6.02 1.05.45 1.03 1.08zm.73-3.07l-.47.3c-.2.15-.36.36-.44.6a3.6 3.6 0 00-.08.65c0 .04-.03.14-.16.14h-1.4c-.14 0-.16-.09-.16-.13-.01-.5.11-.99.36-1.42A4.6 4.6 0 017.7 6.07c.15-.1.21-.21.3-.33a1.14 1.14 0 00.02-1.48c-.22-.26-.46-.4-.92-.4-.45 0-.83.23-1.02.52-.19.3-.16.63-.16.94H4.2c0-1.17.31-1.92.98-2.36a3.5 3.5 0 011.83-.44c.88 0 1.58.16 2.2.62.58.42.88 1.02.88 1.82 0 .5-.17.9-.43 1.24-.15.2-.44.47-.86.79h-.01z"></path>
                                        </svg>
                                    </button>
                                    <div class="generic-popover d-none">
                                        <p class="pb-2 fs-14">We know you hate spam, and we do too. That’s why we make
                                            it easy for you to update your email preferences or unsubscribe at
                                            anytime.</p>
                                        <p class="fs-14">We never share your email address with third parties for
                                            marketing purposes.</p>
                                    </div><!-- end generic-popover -->
                                </div>
                            </div><!-- end form-group -->
                            <div class="form-group">
                                <button id="send-message-btn" class="btn theme-btn w-100" type="submit">Sign up <i
                                            class="la la-arrow-right icon ml-1"></i></button>
                            </div><!-- end form-group -->
                            <p class="fs-13 lh-18 pb-3">By clicking “Sign up”, you agree to our <a
                                        href="terms-and-conditions.html" class="text-color hover-underline">terms of
                                    conditions</a>, <a href="privacy-policy.html" class="text-color hover-underline">privacy
                                    policy</a></p>
                        </div><!-- end form-action-wrapper -->
                    </div><!-- end col-lg-5 -->
                </div><!-- end row -->
            </form>
            <p class="text-black text-center fs-15">Already have an account? <a href="{{route("login")}}"
                                                                                class="text-color hover-underline">Log
                    in</a></p>
        </div><!-- end container -->
        <div class="position-absolute top-0 left-0 w-100 h-100 z-index-n1">
            <svg class="w-100 h-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                 preserveAspectRatio="none">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" fill="#2d86eb" opacity="0.06"></path>
            </svg>
        </div>
    </section>
@endsection
