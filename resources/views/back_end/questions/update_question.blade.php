@extends("back_end.layout.main")
@section("content")
    @php
        $record = $pageData["question_record"];
      //  dd($record);
        $parentCategories = $pageData["parent_category"];
        $childCategories = $pageData["child_category"];
    @endphp
    <div class="row">
        <div class="col-md-6 col-sm-6">
        </div>
        <div class="col-md-6 col-sm-6 text-right">
            <div class="btn-group">
                <a href="{{route('question-list')}}">
                    <button id="sample_editable_1_new" class="btn green">
                        Back To Question List
                    </button>
                </a>
            </div>
        </div>
        <div class="col-md-12 col-sm-12" id="error">
            <form method="Post" action="{{route("question-update",["id"=>$record->id])}}" class="form-horizontal">
                @if(Session::has('alert-update-question'))
                    {!!Session::get('alert-update-question')!!}
                @endif
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-3 control-label">Question Title<span class="text-danger">*</span></label>
                    <div class="col-md-4 ">
                        <input type="text" name="title" class="form-control" placeholder="Example: Programing"
                               value="{{$errors->has('title') || $errors->has('limit') || $errors->has('blocked_keyword_title') ? old("title") :$record->title }}">
                        @if ($errors->has('title'))
                            <span class="text-danger" role="alert">{{$errors->first('title')}}</span>
                        @endif
                        @if ($errors->has('limit'))
                            <span class="text-danger"
                                  role="alert">{{$errors->first('limit')}}</span>
                        @endif
                        @if ($errors->has('blocked_keyword_title'))
                            <span class="text-danger"
                                  role="alert">{{$errors->first('blocked_keyword_title')}}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Question Description<span class="text-danger">*</span></label>
                    <div class="col-md-4 ">
                        <textarea name="description" class="form-control" cols="6" rows="6"
                        >{{$errors->has('description') || $errors->has('limit') || $errors->has('blocked_keyword_title')
                               ? old("description") :$record->title }}</textarea></div>
                    @if ($errors->has('description'))
                        <span class="text-danger" role="alert">{{$errors->first('description')}}</span>
                    @endif
                    @if ($errors->has('limit'))
                        <span class="text-danger"
                              role="alert">{{$errors->first('limit')}}</span>
                    @endif
                    @if ($errors->has('blocked_keyword_title'))
                        <span class="text-danger"
                              role="alert">{{$errors->first('blocked_keyword_title')}}</span>
                    @endif
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label">Category*</label>
                    <div class="col-md-4">
                        <select name="category" id="sub_cat" class="form-control">
                            @foreach($parentCategories as $value)
                                <optgroup label="{{$value->category_name}}">
                                    @foreach($childCategories as $item)
                                        @if ($item->parent_id ==$value->id)
                                            <option value="{{$item->id}}" {{ $record->category_id == $item->id ? "selected" : ""}}>
                                                {{$item->category_name}}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @if($errors->has("parent_id"))
                            <span class="text-danger" role="alert">{{ $errors->first('parent_id')}}</span>
                        @endif()
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Is Blocked<span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <select name="is_blocked" class="form-control">
                            <option value="1" {{$record->is_blocked == "true" ? "selected" : ""}}>Yes</option>
                            <option value="0" {{$record->is_blocked == "false" ? "selected" : ""}}>No
                            </option>
                        </select>
                        @if($errors->has("is_blocked"))
                            <span class="text-danger" role="alert">{{ $errors->first('is_blocked') }}</span>
                        @endif()
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Tags Support List</label>
                    <div class="col-md-4">
                        <input type="hidden" name="tags" id="select2_sample5" class="form-control select2"
                               value="{{$record->tags}}">
                        @if ($errors->has('tag_limit'))
                            <span class="text-danger"
                                  role="alert">{{$errors->first('tag_limit')}}</span>
                        @endif
                        @if ($errors->has('blocked_keyword_tag'))
                            <span class="text-danger"
                                  role="alert">{{$errors->first('blocked_keyword_tag')}}</span>
                        @endif
                    </div>

                </div>

                <div class="form-actions fluid">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn blue">Save</button>
                        <button type="reset" class="btn default">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
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
            });
            jQuery("#select2_sample5").select2({
                tags: ["red", "green", "blue", "yellow", "pink"]
            });
        });
    </script>

@endsection