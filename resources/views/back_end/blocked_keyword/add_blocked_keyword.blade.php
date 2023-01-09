@extends("back_end.layout.main")
@section("content")
    <div class="row">

        <div class="col-md-6 col-sm-6">
        </div>
        <div class="col-md-6 col-sm-6 text-right">
            <div class="btn-group">
                <a href="{{route('blocked-keyword-list')}}">
                    <button id="sample_editable_1_new" class="btn green">
                        Blocked Keyword List
                    </button>
                </a>
            </div>
        </div>


        <div class="col-md-12 col-sm-12">
            <form action="{{route('blocked-keyword-save')}}" method="post" class="form-horizontal">
                {{csrf_field()}}

                @if(Session::has('alert-add-keyword'))
                    {!!Session::get('alert-add-keyword')!!}
                @endif


                <div class="form-group">
                    <label class="col-md-3 control-label">Blocked Keyword<span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="keyword" value="{{old("keyword")}}" class="form-control"
                               placeholder="Example: Bad Word">
                        @if($errors->has("keyword"))
                            <span class="text-danger" role="alert">{{ $errors->first('keyword') }}</span>
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
