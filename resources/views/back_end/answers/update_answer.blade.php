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
        <div class="col-md-12 col-sm-12" id="error">
            <form action="{{route("answer-update",["id"=>$answerRecord->id])}}" method="post" class="form-horizontal">
                @if(Session::has('alert-update-question'))
                    {!!Session::get('alert-update-question')!!}
                @endif
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-3 control-label">Answer<span class="text-danger">*</span></label>
                    <div class="col-md-4 ">
                        <textarea type="text" name="answer" class="form-control" placeholder="Example: Programing" cols="6" rows="6" style="resize: none"
                                  value="">{{$errors->has('answer') || $errors->has('answer_limit') || $errors->has('blocked_keyword') ? old("answer") : $answerRecord->answer}}</textarea>
                        @if ($errors->has('answer'))
                            <span class="text-danger" role="alert">{{$errors->first('answer')}}</span>
                        @endif
                        @if ($errors->has('answer_limit') )
                            <span class="text-danger"
                                  role="alert">{{$errors->first('answer_limit')}}</span>
                        @endif
                        @if ($errors->has('blocked_keyword') )
                            <span class="text-danger"
                                  role="alert">{{$errors->first('blocked_keyword')}}</span>
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
@endsection