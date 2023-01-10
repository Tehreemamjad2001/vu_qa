@extends("layout/main")
@section('content')
    <section class="recovery-area pt-200px pb-80px position-relative">
        <div class="container ">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="container card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ $email ?? old('email') }}" required autocomplete="email"
                                       autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="position-absolute bottom-0 left-0 w-100 h-100 z-index-n1">
                    <svg class="w-100 h-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                         preserveAspectRatio="none">
                        <path fill="#2d86eb"
                              d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                              opacity=".07"></path>
                        <path fill="#2d86eb"
                              d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                              opacity=".06"></path>
                        <path fill="#2d86eb"
                              d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                              opacity=".04"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <hr>


    <section class="recovery-area pt-200px pb-80px position-relative">
        <div class="container">
            <div class="card-header">{{ __('Reset Password') }}</div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="card card-item login-form">
                @csrf
                <div class="card-body row p-0">
                    <div class="col-lg-6">
                        <div class="form-content py-4 pr-60px pl-60px border-right border-right-gray h-100 d-flex align-items-center justify-content-center">
                            <img src="{{assets("images/undraw-forgot-password.svg",true)}}" alt="Image"
                                 class="img-fluid">
                        </div>
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-5 mx-auto">
                        <div class="form-action-wrapper py-5">
                            <div class="form-group">
                                <h3 class="fs-22 pb-3 fw-bold">Forgotten your password?</h3>
                                <div class="divider"><span></span></div>
                                <p class="pt-3">Forgot your account's password or having trouble logging into your
                                    Account? Don't worry, we'll help you to get back your account. Enter your email
                                    address and we'll send you a recovery link to reset your password.</p>
                            </div>
                            <div class="form-group">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ $email ?? old('email') }}" required autocomplete="email"
                                       autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div><!-- end form-group -->
                            <div class="form-group">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"  autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div><!-- end form-group -->
                            <div class="form-group">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation"  autocomplete="new-password">

                            </div><!-- end form-group -->
                            <div class="form-group">
                                <button id="send-message-btn" class="btn theme-btn w-100"
                                        type="submit">{{ __('Reset Password') }}<i
                                            class="la la-arrow-right icon ml-1"></i></button>
                            </div><!-- end form-group -->
                        </div><!-- end form-action-wrapper -->
                    </div><!-- end col-lg-5 -->
                </div><!-- end row -->
            </form>
            <p class="text-center"><a href="{{route("login")}}" class="text-color hover-underline">Return to log in</a>
            </p>
        </div><!-- end container -->
        <div class="position-absolute bottom-0 left-0 w-100 h-100 z-index-n1">
            <svg class="w-100 h-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                 preserveAspectRatio="none">
                <path fill="#2d86eb"
                      d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                      opacity=".07"></path>
                <path fill="#2d86eb"
                      d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                      opacity=".06"></path>
                <path fill="#2d86eb"
                      d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                      opacity=".04"></path>
            </svg>
        </div>
    </section>
@endsection
