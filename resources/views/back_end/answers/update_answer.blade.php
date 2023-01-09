@extends("back_end.layout.main")
@section("content")
    @php
        $answerRecord = $pageData["answer-data"];
    //dd($answerRecord);
    @endphp
    <div class="row">
        <div class="col-md-6 col-sm-6">
        </div>
        <div class="col-md-6 col-sm-6 text-right">
            <div class="btn-group">
                <a href="{{route('answer-list')}}">
                    <button id="sample_editable_1_new" class="btn green">
                        Back To Answer List
                    </button>
                </a>
            </div>
        </div>
        <br><br>
        <form action="{{route("answer-update",["id"=>$answerRecord->id])}}" method="post" class="form-horizontal">
            @if(Session::has('alert-update-question'))
                {!!Session::get('alert-update-question')!!}
            @endif
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-md-3 control-label">Answer<span class="text-danger">*</span></label>
                <div class="col-md-4 ">
                    <input type="text" name="answer" class="form-control" placeholder="Example: Programing"
                           value="{{isset($answerRecord->id) && !empty($answerRecord->id) ? $answerRecord->answer : old('answer')}}">
                    @if ($errors->has('title'))
                        <span class="text-danger" role="alert">{{$errors->first('answer')}}</span>
                    @endif
                </div>
            </div>
            {{--<div class="form-group">--}}
                {{--<label class="col-md-3 control-label">Is Accepted<span class="text-danger">*</span></label>--}}
                {{--<div class="col-md-4">--}}
                    {{--<select name="is_blocked" class="form-control">--}}
                        {{--<option value="1" {{$answerRecord->is_blocked == "1" ? "selected" : ""}}>True</option>--}}
                        {{--<option value="0" {{$answerRecord->is_blocked == "0" ? "selected" : ""}}>False--}}
                        {{--</option>--}}
                    {{--</select>--}}
                    {{--@if($errors->has("is_blocked"))--}}
                        {{--<span class="text-danger" role="alert">{{ $errors->first('is_blocked') }}</span>--}}
                    {{--@endif()--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="form-actions fluid">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn blue">Save</button>
                    <button type="reset" class="btn default">Cancel</button>
                </div>
            </div>
        </form>
    </div>
@endsection