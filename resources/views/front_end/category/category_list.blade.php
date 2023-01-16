@extends("front_end.layout.main")
@section("content")
    @php
      $categoryRecord =  $pageData["category_name"];

      $search = isset($_GET["category"]) && !empty($_GET["category"]) ? $_GET["category"] : "";

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
                                <input class="form-control form--control form-control-sm h-auto lh-34" type="text"
                                       name="category" value="{{$search}}"
                                       placeholder="Filter by category">
                            </label>
                            <a href="{{route("frontend-category-list")}}"><input class="btn theme-btn " type="button"
                                                                                 value="reset"></a>
                        </div>
                    </form>
                </div>
            </div><!-- end filters -->
            <div class="row">
                @foreach($categoryRecord as $record)
                    <div class="col-lg-3 responsive-column-half">
                        <div class="media media-card p-3 align-items-center hover-y">
                            <div class="icon-element shadow-sm flex-shrink-0 mr-3 border border-gray ">
                                <span><i class="{{$record->icon}}"></i></span>
                            </div>
                            <div class="media-body">
                                <h5 class="fs-19 fw-medium mb-1 "><a
                                            href="{{route("sub-category-list",["id"=>$record->id])}}">{{$record->category_name}}</a>
                                </h5>
                                <p class="fw-medium fs-15 text-black-50 lh-18">{{$record->total_no_of_questions}}</p>
                            </div><!-- end media-body -->
                        </div><!-- end media -->
                    </div><!-- end col-lg-3 -->
                @endforeach
            </div><!-- end row -->
            <div class="pager pt-20px">
                {{--<nav aria-label="Page navigation example">--}}

                {!!$categoryRecord->appends($_GET)->render()!!}

                {{--</nav>--}}
            </div>
        </div><!-- end container -->
    </section>
@endsection
