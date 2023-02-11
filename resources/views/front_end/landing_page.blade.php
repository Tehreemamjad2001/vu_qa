@extends("front_end/layout/main")
@section("content")
    @php
        $questionRecord =  $pageData["question_Record"];
        $selectRandomQuestions =  $pageData["related_questions"];
        $limit = isset($_GET["limit"]) && !empty($_GET["limit"]) ? $_GET["limit"] : "10";
        $sort = isset($_GET["sort"]) && !empty($_GET["sort"]) ? $_GET["sort"] : "newest";
        $sortDirection = isset($_GET["sort_dir"]) && !empty($_GET["sort_dir"]) ? $_GET["sort_dir"] : "desc";
        $tags = isset($_GET["tag"]) && !empty($_GET["tag"]) ? $_GET["tag"] : "";
        $title = isset($_GET["title"]) && !empty($_GET["title"]) ? $_GET["title"] : "";
    @endphp
    @include("front_end.components.question_content_hero_area")
    <!--======================================
            END HERO AREA
    ======================================-->

    <!-- ================================
             START QUESTION AREA
    ================================= -->
    <section class="question-area pt-85px pb-30px">
        <div class="container">
            <div class="row">
                <form id="filter">
                    <div>
                        <input type="hidden" name="sort" id="sort_value" value="{{$sort}}">
                        <input type="hidden" name="limit" id="limit_value" value="{{$limit}}">
                        <input type="hidden" name="tag" id="tag" value="{{$tags}}">
                        <input type="submit" value="submit" style="display: none">
                    </div>
                </form>
                <div class="col-lg-9 px-0">
                    <div class="question-main-bar border-left border-left-gray pb-50px">
                        <div class="filters pb-4 pl-3 d-flex align-items-center justify-content-between">
                            <form action="">
                                <div class="form-group mb-10 mr-3">
                                    <label> <input class="form-control form--control h-auto py-2 " type="search"
                                                   name="title" style="width: 750px"
                                                   value="{{$title}}" placeholder="Type your search words...">
                                    </label>
                                    <button class="btn theme-btn " type="Search" value="Search">Search</button>
                                    <a href="{{route('home')}}"><input class="btn theme-btn " type="button"
                                                                       value="Reset"></a></div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="filters pb-4 pl-3 d-flex align-items-center justify-content-between col-sm-3 col-md-3">
                                <div class="ml-3 mb-10">
                                    <h3 class="fs-18 fw-medium">All Questions</h3>
                                    <p class="pt-1 fs-14 fw-medium lh-20">{{number_format($questionRecord->total())}}</p>
                                </div>
                            </div>

                            <div class="filters pb-4 pl-3 d-flex align-items-center justify-content-end  col-sm-9 col-md-9">

                                <div class="filter-option-box w-20">
                                    <div class="selectize-control select-container single mr-2">
                                        <select class="selectize-input items full has-options has-items select-container select-container selectized"
                                                size="1" id="limit">
                                            <option value="10" {{$limit == "10" ? "selected" : ""}}>10</option>
                                            <option value="20" {{$limit == "20" ? "selected" : ""}}>20</option>
                                            <option value="30" {{$limit == "30" ? "selected" : ""}}>30</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-option-box w-20 mr-4">
                                    <div class="selectize-control select-container single">
                                        <select class="selectize-input items full has-options has-items select-container select-container selectized"
                                                id="sort">
                                            <option value="newest"{{$sort == "Newest"  ?  "selected" : ""}}>Newest</option>
                                            <option value="oldest"{{$sort == "Oldest"  ?  "selected" : ""}}>Oldest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end filters -->
                        <div class="questions-snippet border-top border-top-gray">
                            @if($questionRecord->total() == "0")
                                <div class="row pt-10px">
                                    <p class="col-sm-4 col-sm-4"></p>
                                    <p class="col-md-3 col-sm-3 alert alert-info" style="text-align: center">No Question is
                                        available</p>
                                </div>
                            @else
                                @foreach($questionRecord as $data)
                                    @php
                                        $time = dateFormat($data->created_at);
                                         $timeInAgo = getUserTimeZone($data->created_at);
                                    @endphp
                                    @include("front_end.components.question_list")
                                @endforeach
                            @endif
                        </div><!-- end questions-snippet -->
                        <div class="pager d-flex flex-wrap align-items-center justify-content-between pt-30px px-3">
                            <div>
                                <nav aria-label="Page navigation example">
                                    {!!$questionRecord->appends($_GET)->render()!!}
                                </nav>
                            </div>
                        </div>
                    </div><!-- end question-main-bar -->
                </div><!-- end col-lg-7 -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="fs-17 pb-3">Related Questions</h3>
                                <div class="divider"><span></span></div>
                                <div class="sidebar-questions pt-3">
                                    @foreach($selectRandomQuestions as $value)
                                        @php
                                            $time = getUserTimeZone($value->created_at);
                                        @endphp
                                        <div class="media media-card media--card media--card-2">
                                            <div class="media-body">
                                                <h5>
                                                    <a href="{{route("answers-page",["id"=>$value->questions_id])}}">{{Str::limit($value->title,30)}}</a>
                                                </h5>
                                                <small class="meta">
                                                    <span class="pr-1">{{$time}}</span>
                                                    <span class="pr-1">. by</span>
                                                    <a href="{{route("user-questions-list",["id"=>$value->id])}}"
                                                       class="author">{{$value->name}}</a>
                                                </small>
                                            </div>
                                        </div><!-- end media -->
                                    @endforeach
                                </div><!-- end sidebar-questions -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end question-area -->
    <script>
        jQuery("document").ready(function () {
            jQuery("#sort").change(function () {
                var valueOfLimit = jQuery(" #sort option:selected").text();
                var sortValueChange = jQuery("#sort_value").val(valueOfLimit);
                if (sortValueChange) {
                    formSubmit();
                }
            });
            jQuery("#limit").change(function () {
                var valueOfSort = jQuery(" #limit option:selected").text();
                var limitValueChange = jQuery("#limit_value").val(valueOfSort);
                if (limitValueChange) {
                    formSubmit();
                }
            });
        });

        function formSubmit() {
            jQuery("#filter").submit();
        }

        var maxLength = 100;
        jQuery(".readmore").each(function () {
            var str = jQuery(this).text();
            if (jQuery.trim(str).length > maxLength) {
                var nstr = str.substring(0, maxLength);
                var rmstr = str.substring(maxLength, $.trim(str).length);
                jQuery(this).append('<a href = "javascript:void(0);" class="read_more"> read more... </a>');
                jQuery(this).append('<span class = "moretext">' + rmstr + '</span> ');
            }
        });
        jQuery(".read_more").click(function () {
            jQuery(this).siblings(".moretext").contents().unwrap();
            jQuery(this).remove();
        });
    </script>
@endsection