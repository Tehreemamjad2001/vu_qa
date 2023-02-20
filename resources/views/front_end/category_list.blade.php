@extends("front_end.layout.main")
@section("content")
    @php
        $categoryRecord =  $pageData["category_name"];
        $search = isset($_GET["category"]) && !empty($_GET["category"]) ? $_GET["category"] : "";
        $catId = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : "" ;
    @endphp
    <section class="question-area pt-90px pb-40px">
        <div class="container">
            <div class="filters pb-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between pb-3">
                    <h3 class="fs-22 fw-medium">Categories</h3>
                    <a href="{{route("ask-question-page")}}" class="btn theme-btn theme-btn-sm">Ask Question</a>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <form class="mr-3 w-25">
                        <div class="form-group">
                            <label>
                                <input type="hidden" name="id" value="{{$catId}}">
                                <input class="form-control form--control form-control-sm h-auto lh-34" type="search"
                                       name="category" value="{{$search}}"
                                       placeholder="Filter by category">
                            </label>
                            <a href="{{route("frontend-category-list")}}"><input class="btn theme-btn " type="button"
                                                                                 value="reset"></a>
                        </div>
                    </form>
                </div>
            </div><!-- end filters -->
            @if($categoryRecord->total() != "0")
                <div class="row">
                    @foreach($categoryRecord as $record)
                        <div class="col-lg-3 responsive-column-half">
                            <div class="media media-card p-3 align-items-center hover-y">
                                <div class="icon-element shadow-sm flex-shrink-0 mr-3 border border-gray ">
                                    <span><i class="{{$record->icon}}"></i></span>
                                </div>
                                <div class="media-body">

                                    <h5 class="fs-19 fw-medium mb-1 "><a
                                                href="{{$catId ? route("home")."?slug=".$record->slug  :  route("sub-category-list")."?id=".$record->id}}">{{$record->category_name}}</a>
                                    </h5>

                                    <p class="fw-medium fs-15 text-black-50 lh-18">{{ $catId ? $record->total_no_of_questions_sc : $record->total_no_of_questions}}</p>
                                </div><!-- end media-body -->
                            </div><!-- end media -->
                        </div><!-- end col-lg-3 -->
                    @endforeach
                </div><!-- end row -->
            @else
                <div class="row pt-10px">
                    <div class="row pt-20px mr-2 ml-2">
                        <p class="col-md-12 col-sm-12 alert alert-info" style="text-align: center">No Sub Category is
                            available</p>
                    </div>
                </div>
            @endif
            <div class="pager pt-20px">
                {!!$categoryRecord->appends($_GET)->render()!!}
            </div>
        </div><!-- end container -->
    </section>
@endsection
