@extends("front_end/layout/main")
@section("content")
    @php
        $questionRecord =  $pageData["question-Record"];
        $limit = isset($_GET["limit"]) && !empty($_GET["limit"]) ? $_GET["limit"] : "10";
        $sort = isset($_GET["sort"]) && !empty($_GET["sort"]) ? $_GET["sort"] : "newest";
        $sortDirection = isset($_GET["sort_dir"]) && !empty($_GET["sort_dir"]) ? $_GET["sort_dir"] : "";
        $tags = isset($_GET["tag"]) && !empty($_GET["tag"]) ? $_GET["tag"] : "";
    @endphp
    <section class="question-area pt-40px pb-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar pb-45px">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="fs-17 pb-3">Related Questions</h3>
                                <div class="divider"><span></span></div>
                                <div class="sidebar-questions pt-3">
                                    <div class="media media-card media--card media--card-2">
                                        <div class="media-body">
                                            <h5><a href="question-details.html">Using web3 to call precompile
                                                    contract</a></h5>
                                            <small class="meta">
                                                <span class="pr-1">2 mins ago</span>
                                                <span class="pr-1">. by</span>
                                                <a href="#" class="author">Sudhir Kumbhare</a>
                                            </small>
                                        </div>
                                    </div><!-- end media -->
                                    <div class="media media-card media--card media--card-2">
                                        <div class="media-body">
                                            <h5><a href="question-details.html">Is it true while finding Time Complexity
                                                    of the algorithm [closed]</a></h5>
                                            <small class="meta">
                                                <span class="pr-1">48 mins ago</span>
                                                <span class="pr-1">. by</span>
                                                <a href="#" class="author">wimax</a>
                                            </small>
                                        </div>
                                    </div><!-- end media -->
                                    <div class="media media-card media--card media--card-2">
                                        <div class="media-body">
                                            <h5><a href="question-details.html">image picker and store them into
                                                    firebase with flutter</a></h5>
                                            <small class="meta">
                                                <span class="pr-1">1 hour ago</span>
                                                <span class="pr-1">. by</span>
                                                <a href="#" class="author">Antonin gavrel</a>
                                            </small>
                                        </div>
                                    </div><!-- end media -->
                                </div><!-- end sidebar-questions -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-9">
                    <div class="question-main-bar">
                        <div class="filters pb-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3">
                                <h3 class="fs-22 fw-medium">All Questions</h3>
                                <a href="{{route("ask-question-page")}}" class="btn theme-btn theme-btn-sm">Ask
                                    Question</a>
                            </div>
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <p class="pt-1 fs-15 fw-medium lh-20">{{number_format($questionRecord->total())}}
                                    questions</p>


                                <div class="filter-option-box w-20">
                                    <div class="selectize-control select-container single">
                                        <select class="selectize-input items full has-options has-items select-container select-container selectized"
                                                id="sort">
                                            <option value="newest" {{$sort == "Newest"  ?  "selected" : ""}}>Newest
                                            </option>
                                            <option value="oldest" {{$sort == "Oldest"  ?  "selected" : ""}}>Oldest
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end filters -->
                        <div class="questions-snippet border-top border-top-gray">

                            @foreach($questionRecord as $data)
                                @php
                                    $time = getTimeAgo($data->created_at);
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
                        <form id="filter">
                            <div>
                                <input type="hidden" name="sort" id="sort_value" value="{{$sort}}">
                                <input type="hidden" name="limit" id="limit_value" value="{{$limit}}">
                                <input type="hidden" name="tag" id="tag" value="{{$tags}}">
                                <input type="submit" value="submit" style="display: none">
                            </div>

                        </form>
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

        var maxLength = 180;
        jQuery(".readmore").each(function () {
            var str = jQuery(this).text();

            if (jQuery.trim(str).length > maxLength) {
                var nstr = str.substring(0, maxLength);
                var rmstr = str.substring(maxLength, $.trim(str).length);
                jQuery(this).empty().html(nstr);
                jQuery(this).append('<a href = "javascript:void(0);" class="readmore"> read more... </a>');
                jQuery(this).append('<span class = "moretext">' + rmstr + '</span> ');
            }
        });
        jQuery(".readmore").click(function () {
            jQuery(this).siblings(".moretext").contents().unwrap();
            //  jQuery(this).remove();
        });

    </script>


@endsection