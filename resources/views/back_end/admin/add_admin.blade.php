@extends("back_end.layout.main")
@section("content")
    <div class="row">
        <div class="col-md-6 col-sm-6">
        </div>
        {{--list button--}}
        <div class="col-md-6 col-sm-6 text-right">
            <div class="btn-group">
                <a href="{{route('admin-list')}}">
                    <button id="sample_editable_1_new" class="btn green">
                        Admin List
                    </button>
                </a>
            </div>
        </div>
        <br><br>
        <form action="{{route('admin-save')}}" method="post" class="form-horizontal" id="form1"
              enctype="multipart/form-data">
            @if(Session::has('alert-add-admin'))
                {!!Session::get('alert-add-admin')!!}
            @endif
            <div class="flash-message"></div>
            {{csrf_field()}}
            {{--name--}}
            <div class="form-group">
                <label class="col-md-3 control-label">Email<span class="text-danger">*</span></label>
                <div class="col-md-4 ">
                    <input type="text" name="email" class="form-control" placeholder="Example: abc@gmail.com"
                           value="{{ old('email')}}">
                    @if ($errors->has('email'))
                        <span class="text-danger" role="alert">{{$errors->first('email')}}</span>
                    @endif
                </div>
            </div>
            {{--email--}}
            <div class="form-group">
                <label class="col-md-3 control-label">Name<span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <input type="text" name="name" value="{{ old('name')}}" class="form-control"
                           placeholder="Example: Ayesha Ali">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            {{--country--}}
            <div class="form-group">
                <label class="col-md-3 control-label">Country<span class="text-danger">*</span></label>
                <div class="col-md-4 ">
                    <input type="text" name="country" class="form-control" placeholder="Example: Pakistan"
                           value="{{ old('country')}}">
                    @if ($errors->has('country'))
                        <span class="text-danger" role="alert">{{$errors->first('country')}}</span>
                    @endif
                </div>
            </div>
            {{--password--}}
            <div class="form-group">
                <label class="col-md-3 control-label">Password<span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="password" name="password" value=""
                               class="password form-control" placeholder="Password">
                        <span class="input-group-addon" style="cursor: pointer">
                        <i class="showPass fa fa-eye-slash"></i>
                        </span>
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            {{--confirm password--}}
            <div class="form-group">
                <label class="col-md-3 control-label">Confirm Password<span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="password" name="confirmPassword" value=""
                               class="password form-control" placeholder="Confirm Password">
                        <span class="input-group-addon " style="cursor: pointer">
                        <i class="showPass fa fa-eye-slash"></i>
                        </span>

                    </div>
                    @if ($errors->has('confirmPassword'))
                        <span class="text-danger">{{ $errors->first('confirmPassword') }}</span>
                    @endif
                </div>
            </div>
            {{--gender--}}
            <div class="form-group">
                <label class="control-label col-md-3">Gender<span class="text-danger">*</span>
                </label>
                <div class="col-md-4">
                    <div class="radio-list" data-error-container="#form_2_membership_error">
                        <label>
                            <div class="radio"><span><input type="radio" name="gender" value="female"></span></div>
                            Female </label>
                        <label>
                            <div class="radio"><span><input type="radio" name="gender" value="male"></span></div>
                            Male </label>
                    </div>
                    <div id="form_2_membership_error">
                    </div>
                </div>
            </div>
            {{--profile pic--}}
            <div class="form-group">
                <label class="col-md-3 control-label">Profile Pic</label>
                <div class="col-md-4">
                    <input type="file" name="profile_pic" value="" class="form-control">
                    @if ($errors->has('profile_pic'))
                        <span class="text-danger" role="alert">{{ $errors->first('profile_pic') }}</span>
                    @endif
                </div>
            </div>
            {{--submit button--}}
            <div class="form-actions fluid">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn blue">Save</button>
                    <button type="reset" class="btn default">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        // toogle eye icon for password field
        jQuery(document).ready(function () {
            jQuery('.showPass').on('click', function () {
                var passInput = jQuery(".password");
                if (passInput.attr('type') == 'password') {
                    passInput.attr('type', 'text');
                    jQuery('.showPass').removeClass('fa fa-eye-slash');
                    jQuery('.showPass').addClass('fa fa-eye');
                } else {
                    passInput.attr('type', 'password');
                    jQuery('.showPass').removeClass('fa fa-eye');
                    jQuery('.showPass').addClass('fa fa-eye-slash');
                }
            })
        });
    </script>


@endsection