@extends("back_end.layout.main")
@section("content")
    @php
        $optionRecord = $pageData["option_record"];
    @endphp
    <div class="row">
        <div class="col-md-6 col-sm-6">
        </div>
        <div class="col-md-6 col-sm-6 text-right">
            <div class="btn-group">
                <a href="{{route('site-setting-list')}}">
                    <button id="sample_editable_1_new" class="btn green">
                        Back To Lang Limit List
                    </button>
                </a>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <form action="{{route("site-setting-update",["id"=>$optionRecord->id])}}" method="post"
                  class="form-horizontal">
                @if(Session::has('alert-update-option'))
                    {!!Session::get('alert-update-option')!!}
                @endif
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-3 control-label">Value<span class="text-danger">*</span></label>
                    <div class="col-md-4 ">
                        <input type="text" name="percentage" class="form-control" placeholder="Example: Programing"
                               value="{{isset($optionRecord->id) && !empty($optionRecord->id) ? $optionRecord->value : old('value')}}">
                        @if ($errors->has('percentage'))
                            <span class="text-danger" role="alert">{{$errors->first('percentage')}}</span>
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
    </div>
@endsection