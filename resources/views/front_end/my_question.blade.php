@extends("front_end/layout/main")
@section("content")
    @php
        $questionRecord =  $pageData["question_Record"];
        $RandomQuestions =$pageData['related_questions'] ;
        $limit = isset($_GET["limit"]) && !empty($_GET["limit"]) ? $_GET["limit"] : "10";
        $sort = isset($_GET["sort"]) && !empty($_GET["sort"]) ? $_GET["sort"] : "newest";
        $sortDirection = isset($_GET["sort_dir"]) && !empty($_GET["sort_dir"]) ? $_GET["sort_dir"] : "";
        $tags = isset($_GET["tag"]) && !empty($_GET["tag"]) ? $_GET["tag"] : "";
        $id = request()->id;
        $slug = isset($_GET['slug']) && !empty($_GET['slug']) ? $_GET['slug'] : "";


    @endphp
    <section class="question-area pt-85px pb-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar pb-45px">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="fs-17 pb-3">Related Questions</h3>
                                <div class="divider"><span></span></div>
                                <div class="sidebar-questions pt-3">
                                    @foreach($RandomQuestions as $item)
                                        @php
                                            $time =getUserTimeZone($item->created_at);
                                        @endphp
                                        <div class="media media-card media--card media--card-2">
                                            <div class="media-body">
                                                <h5>
                                                    <a href="{{route("answers-page",["id"=>$item->questions_id])}}">{{Str::limit($item->title,30)}}</a>
                                                </h5>
                                                <small class="meta">
                                                    <span class="pr-1">{{$time}}</span>
                                                    <span class="pr-1">. by</span>
                                                    <a href="{{route("user-questions-list",["id"=>$item->id])}}"
                                                       class="author">{{$item->name}}</a>
                                                </small>
                                            </div>
                                        </div><!-- end media -->
                                    @endforeach
                                </div><!-- end sidebar-questions -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-9">
                    <div class="question-main-bar">
                        <div class="filters pb-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3">

                                <h3 class="fs-22 fw-medium">{{isset($id) && !empty($id) ?$pageData["user_name"]->name . " Questions" : "My Questions"}}</h3>
                                <a href="{{route("ask-question-page")}}" class="btn theme-btn theme-btn-sm">Ask
                                    Question</a>
                            </div>
                            <form id="filter">
                                <div>
                                    <input type="hidden" name="sort" id="sort_value" value="{{$sort}}">
                                    <input type="hidden" name="limit" id="limit_value" value="{{$limit}}">
                                    <input type="hidden" name="tag" id="tag" value="{{$tags}}">
                                    <input type="submit" value="submit" style="display: none">
                                </div>
                            </form>
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <p class="pt-1 fs-15 fw-medium lh-20">{{number_format($questionRecord->total()) }}{{$questionRecord->total() <=1 ? "  question" : "  questions"}}
                                </p>


                                <div class="filter-option-box w-20">
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
                            @if(Session::has('alert-delete-question-record'))
                                {!!Session::get('alert-delete-question-record')!!}
                            @endif
                            @foreach($questionRecord as $data)
                                @php
                                    $time = dateFormat($data->created_at);
                                      $timeInAgo = getUserTimeZone($data->created_at);
                                @endphp
                                @include("front_end.components.question_list")
                            @endforeach

                        </div><!-- end questions-snippet -->
                        <div class="pager d-flex flex-wrap align-items-center justify-content-between pt-30px px-3">
                            <div>
                                <nav aria-label="Page navigation example">
                                    {!!$questionRecord->appends($_GET)->render()!!}
                                </nav>
                            </div>
                            <div class="filter-option-box w-20">
                                <div class="selectize-control select-container single">
                                    <select size="1" id="limit"
                                            class="select-container selectize-input items full has-options has-items select-container select-container selectized"
                                            id="sort">
                                        <option value="10" {{$limit == "10" ? "selected" : ""}}>10</option>
                                        <option value="20" {{$limit == "20" ? "selected" : ""}}>20</option>
                                        <option value="30" {{$limit == "30" ? "selected" : ""}}>30</option>
                                    </select>
                                </div>
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