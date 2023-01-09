@extends("back_end.layout.main")
@include("vendor.sweetalert.alert")
@section("content")
    @php
        $data = $pageData["user_data"];
   // dd($data);
    @endphp
    <div class="row">
        <div class="col-md-6 col-sm-6">
        </div>
        <div class="col-md-6 col-sm-6 text-right">
            <div class="btn-group">
                <a href="{{route('user-list')}}">
                    <button id="sample_editable_1_new" class="btn green">
                        Back To User List
                    </button>
                </a>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <h3 class="form-section">Update Account Information</h3>
            <form action="{{route('user-update',["id"=>$data->id])}}" method="post" class="form-horizontal">
                @if(Session::has('alert-update-user-info'))
                    {!!Session::get('alert-update-user-info')!!}
                @endif
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-4 ">
                        <input type="text" name="email" class="form-control" placeholder="Example: abc@gmail.com"
                               value="{{isset($data->id) ?$data->email : old('email')}}">
                        @if ($errors->has('email'))
                            <span class="text-danger" role="alert">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-4">
                        <input type="text" name="name" value="{{ isset($data->id) ?$data->name : old('name')}}"
                               class="form-control" placeholder="Example: Ayesha Ali">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Gender
                    </label>
                    <div class="col-md-4">
                        <div class="radio-list" data-error-container="#form_2_membership_error">
                            <label>
                                <div class="radio"><span><input type="radio" name="gender"
                                                                value="female" {{($data->gender == "female") ? "checked=checked" : ""}} ></span>
                                </div>
                                Female </label>
                            <label>
                                <div class="radio"><span><input type="radio" name="gender"
                                                                value="male"{{($data->gender == "male") ? "checked=checked" : ""}} ></span>
                                </div>
                                Male </label>
                        </div>
                        <div id="form_2_membership_error">
                        </div>
                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn blue">Update</button>
                        <button type="reset" class="btn default">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 col-sm-12">
            <h3 id="update-pass" class="form-section">Update Password</h3>
            <form action="{{route('user-update-pass',["id"=>$data->id])}}" method="post" class="form-horizontal">
                @if(Session::has('alert-update-user-pass'))
                    {!!Session::get('alert-update-user-pass')!!}
                @endif
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-3 control-label">Password *</label>
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
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm Password *</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="password" name="confirmPassword" value=""
                                   class="password form-control" placeholder="Confirm Password">
                            <span class="input-group-addon" style="cursor: pointer">
                        <i class="showPass fa fa-eye-slash"></i>
                        </span>
                        </div>
                        @if ($errors->has('confirmPassword'))
                            <span class="text-danger">{{ $errors->first('confirmPassword') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn blue">Update</button>
                        <button type="reset" class="btn default">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 col-sm-12 ">
            <h3 id="update-profile-pic" class="form-section">Update Profile Pic</h3>
            <form action="{{route('user-update-profile-pic',["id"=>$data->id])}}" method="post" class="form-horizontal"
                  enctype="multipart/form-data">
                @if(Session::has('alert-update-user-profile'))
                    {!!Session::get('alert-update-user-profile')!!}
                @endif
                    @if(Session::has('alert-delete-user-profile'))
                        {!!Session::get('alert-delete-user-profile')!!}
                    @endif
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Profile Pic</label>
                        <div class="col-md-4 ">
                            <input type="file" name="profile_pic" class="form-control"
                                   placeholder="Password">
                            @if ($errors->has('profile_pic'))
                                <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                            @endif
                        </div>
                        <div class="col-md-5 text-center ">
                            <?php
                            $record = $pageData["user_data"];
                            $profilePic = getProfileThumbnail($record["id"], "medium", $record['profile_pic']);
                            if(isset($record['profile_pic']) && !empty($record['profile_pic'])) {
                            ?>
                            <img width="200" height="200" src="{{$profilePic}}">
                            <br/>
                            <a class="del_ete  btn default" style="margin-top: 10px"
                               href="{{route('user-delete-profile-pic',["id"=>$record->id])}}">
                                Delete
                            </a>
                            <?php
                            }
                            else{?>
                            <img width="200" height="200" src="{{$profilePic}}">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="col-md-offset-3 col-md-9">
                        {{--{{dd($record['id'])}}--}}
                        <button type="submit" class="btn blue">Update</button>
                        <button type="reset" class="btn default">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        jQuery(document).ready(function () {
            jQuery(".del_ete").on('click', function (e) {
                e.preventDefault();
                //console.log(jQuery(this).attr('href'));
                var path = jQuery(this).attr('href');
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
