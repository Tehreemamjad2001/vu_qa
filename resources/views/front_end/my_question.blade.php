@extends("front_end/layout/main")
@section("content")
    @php
        $questionRecord =  $pageData["question_Record"];
        $limit = isset($_GET["limit"]) && !empty($_GET["limit"]) ? $_GET["limit"] : "10";
        $sort = isset($_GET["sort"]) && !empty($_GET["sort"]) ? $_GET["sort"] : "newest";
        $sortDirection = isset($_GET["sort_dir"]) && !empty($_GET["sort_dir"]) ? $_GET["sort_dir"] : "";
        $tags = isset($_GET["tag"]) && !empty($_GET["tag"]) ? $_GET["tag"] : "";
        $id = isset(request()->id) && !empty(request()->id) ? request()->id : "";
        $slug = isset($_GET['slug']) && !empty($_GET['slug']) ? $_GET['slug'] : "";
        $title = isset($_GET["title"]) && !empty($_GET["title"]) ? $_GET["title"] : "";
        $countTotalNumOfQuestions =  $pageData["no_of_questions"];
        $countTotalNumOfAnswers = $pageData["no_of_answer"];
        $countTotalNumOfAcceptedAnswers = $pageData["no_of_accepted_answer"];
        $countTotalNumOfRejectedAnswers = $pageData["no_of_rejected_answer"];
        $countTotalNumOfAcceptedQuestions = $pageData["no_of_accepted_questions"] ;
        $countTotalNumOfRejectedQuestions =  $pageData["no_of_rejected_questions"] ;
    @endphp
    <section class="question-area pt-70px pb-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar pb-45px">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="fs-17 pb-3">Number Achievement</h3>
                                <div class="divider"><span></span></div>
                                <div class="row no-gutters text-center">
                                    <div class="col-lg-6 responsive-column-half">
                                        <div class="icon-box pt-3">
                                            <span class="fs-20 fw-bold text-color">{{$countTotalNumOfQuestions}}</span>
                                            <p class="fs-14">{{$countTotalNumOfQuestions <=1 ? "Question" : "Questions"}}</p>
                                        </div><!-- end icon-box -->
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column-half">
                                        <div class="icon-box pt-3">
                                            <span class="fs-20 fw-bold text-color-2">{{$countTotalNumOfAnswers}}</span>
                                            <p class="fs-14">{{$countTotalNumOfAnswers <=1 ? "Answer" : "Answers"}}</p>
                                        </div><!-- end icon-box -->
                                    </div><!-- end col-lg-6 -->

                                    <div class="col-lg-6 responsive-column-half">
                                        <div class="icon-box pt-3">
                                            <span class="fs-20 fw-bold text-color-3">{{$countTotalNumOfAcceptedQuestions}}</span>
                                            <p class="fs-14">{{$countTotalNumOfAcceptedQuestions <=1 ? "Accepted Question" : "Accepted Questions"}}</p>
                                        </div><!-- end icon-box -->
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column-half">
                                        <div class="icon-box pt-3">
                                            <span class="fs-20 fw-bold text-color-4">{{$countTotalNumOfRejectedQuestions}}</span>
                                            <p class="fs-14">{{$countTotalNumOfRejectedQuestions <=1 ? "Rejected Question" : "Rejected Questions"}}</p>
                                        </div><!-- end icon-box -->
                                    </div><!-- end col-lg-6 -->

                                    <div class="col-lg-6 responsive-column-half">
                                        <div class="icon-box pt-3">
                                            <span class="fs-20 fw-bold text-color-3">{{$countTotalNumOfAcceptedAnswers}}</span>
                                            <p class="fs-14">{{$countTotalNumOfAcceptedAnswers <=1 ? "Accepted Answer" : "Accepted Answers"}}</p>
                                        </div><!-- end icon-box -->
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6 responsive-column-half">
                                        <div class="icon-box pt-3">
                                            <span class="fs-20 fw-bold text-color-4">{{$countTotalNumOfRejectedAnswers}}</span>
                                            <p class="fs-14">{{$countTotalNumOfRejectedAnswers <=1 ? "Rejected Answer" : "Rejected Answers"}}</p>
                                        </div><!-- end icon-box -->
                                    </div><!-- end col-lg-6 -->
                                </div><!-- end row -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-9">
                    <div class="question-main-bar">
                        <div class="filters pb-4">
                            <div class="d-flex flex-wrap pb-3">
                                <h3 class="fs-22 fw-medium">{{isset($id) && !empty($id) ? ucfirst($pageData["user_name"]->name)  . "'s Questions" : "My Questions"}}   </h3>
                                <span>  ( {{number_format($questionRecord->total()) }}{{$questionRecord->total() <=1 ? "  question" : "  questions"}}
                                    )</span>

                            </div>
                            <div class="filters d-flex align-items-center justify-content-between">
                                <form action="">
                                    <div class="form-group mb-10 mr-3 ">
                                        <label> <input class="form-control form--control h-auto py-2" type="search"
                                                       style="width: 700px"
                                                       name="title"
                                                       value="{{$title}}" placeholder="Type your search words...">
                                        </label>
                                        <button class="btn theme-btn " type="Search" value="Search">Search</button>

                                        <a href="{{Route::current()->getName() === "my-question" ? route('my-question') : route('user-questions-list',["id"=>$id])}}"><input
                                                    class="btn theme-btn " type="button"
                                                    value="Reset"></a></div>
                                </form>
                            </div>
                            <form id="filter">
                                <div>
                                    <input type="hidden" name="sort" id="sort_value" value="{{$sort}}">
                                    <input type="hidden" name="limit" id="limit_value" value="{{$limit}}">
                                    <input type="hidden" name="tag" id="tag" value="{{$tags}}">
                                    <input type="submit" value="submit" style="display: none">
                                </div>
                            </form>
                            <div class="row">
                                <div class="d-flex flex-wrap align-items-center justify-content-lg-start col-sm-8 col-sm-8 ">
                                    <div class="filter-option-box w-20">
                                        <div class="selectize-control select-container single mr-2">
                                            <select size="1" id="limit"
                                                    class="select-container selectize-input items full has-options has-items select-container select-container selectized"
                                                    id="sort">
                                                <option value="10" {{$limit == "10" ? "selected" : ""}}>10</option>
                                                <option value="20" {{$limit == "20" ? "selected" : ""}}>20</option>
                                                <option value="30" {{$limit == "30" ? "selected" : ""}}>30</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="filter-option-box w-20">
                                        <div class="selectize-control select-container single">
                                            <select class="selectize-input items full has-options has-items select-container select-container selectized"
                                                    id="sort">
                                                <option value="Newest"{{$sort == "Newest"  ?  "selected" : ""}}>Newest
                                                </option>
                                                <option value="Oldest"{{$sort == "Oldest"  ?  "selected" : ""}}>Oldest
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-sm-3 d-flex flex-wrap  justify-content-lg-end">
                                    <a href="{{route("ask-question-page")}}" class="btn theme-btn theme-btn-sm ml-5">Ask
                                        Question</a>
                                </div>
                            </div>


                        </div><!-- end filters -->

                        <div class="questions-snippet border-top border-top-gray">
                            @if(Session::has('alert-delete-question-record'))
                                {!!Session::get('alert-delete-question-record')!!}
                            @endif
                            @if($questionRecord->total() == "0")
                                <div class="row pt-20px mr-2 ml-2">
                                    <p class="col-md-12 col-sm-12 alert alert-info" style="text-align: center">No
                                        Question is
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
                    </div>
                </div><!-- end question-main-bar -->
            </div><!-- end col-lg-9 -->
        </div><!-- end row -->
        </div><!-- end container -->
    </section>
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

            jQuery(".del_ete").on('click', function (e) {
                e.preventDefault();
                var path = jQuery(this).attr('href');
                console.log(path);
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
                // jQuery(this).empty().html(nstr);
                jQuery(this).append('<a href = "javascript:void(0);" class="read_more" > read more... </a>');
                jQuery(this).append('<span class = "moretext">' + rmstr + '</span> ');
            }
        });
        jQuery(".read_more").click(function () {
            jQuery(this).siblings(".moretext").contents().unwrap();
            jQuery(this).remove();
        });

    </script>


@endsection