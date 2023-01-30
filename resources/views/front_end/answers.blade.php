@extends("front_end/layout/main")
@section("content")
    @php
        $questionRecord  = $pageData["question_record"];
        $time = getUserTimeZone($questionRecord->created_at);
        $activeTime = getUserTimeZone($questionRecord->updated_at);
        $id = request()->id;
        $totalNumberOfAnswers =   $pageData['answer_total_record'];
        $perPageAnswers = $pageData['answer_per_page'];

    @endphp
    <section class="question-area pt-40px pb-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="question-main-bar mb-50px">
                        <div class="question-highlight">
                            <div class="media media-card shadow-none rounded-0 mb-0 bg-transparent p-0">
                                <div class="media-body">
                                    <h5 class="fs-20"><a href="#">{{$questionRecord->title}}</a>
                                    </h5>
                                    <div class="meta d-flex flex-wrap align-items-center fs-13 lh-20 py-1">
                                        <div class="pr-3">
                                            <span class="pr-1">Category</span>
                                            <span class="text-black">{{$questionRecord->category_name}} </span>
                                        </div>
                                        <div class="pr-3">
                                            <span>Asked</span>
                                            <span class="text-black">{{$time}}</span>
                                        </div>
                                        <div class="pr-3">
                                            <span class="pr-1">Active</span>
                                            <a href="#" class="text-black">{{$activeTime}}</a>
                                        </div>
                                        <div class="pr-3">
                                            <span class="pr-1">Viewed</span>
                                            <span class="text-black">{{$questionRecord->views}} times</span>
                                        </div>
                                    </div>
                                    @php
                                        $tagsRecord = explode(",",$questionRecord->tags);
                                    @endphp
                                    <div class="tags">
                                        @foreach($tagsRecord as $item)
                                            <a href="{{route("home")."?tag=$item"}}" class="tag-link">
                                                {{$item}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div><!-- end media -->
                        </div><!-- end question-highlight -->
                        <!-- end question -->
                        <div class="subheader">
                            <div class="subheader-title">
                                <h3 class="fs-16">{{$totalNumberOfAnswers == 1 ? "Answer" : "Answers"}}</h3>
                            </div><!-- end subheader-title -->
                        </div><!-- end subheader -->
                        <div class="container1">
                            @include("front_end.components.answer_list")
                        </div>
                        <div id="no-more" class="row">
                            <p class="col-sm-4 col-sm-4"></p>
                        </div>
                        @if($perPageAnswers < $totalNumberOfAnswers)
                            <input type="submit" value="Load More" id="load-more" class="btn theme-btn">
                        @endif
                        <div class="post-form" id="save-answer">
                            <form method="post" action="{{route("save-answer")}}" class="pt-3" id="error">
                                @csrf
                                @if(Session::has('alert-save-answer'))
                                    {!!Session::get('alert-save-answer')!!}
                                @endif
                                <div class="input-box">
                                    <label class="fs-14 text-black lh-20 fw-medium">Body</label>
                                    <div class="form-group">
                                        <textarea
                                                class="form-control form--control form-control-sm fs-13 user-text-editor"
                                                name="answer" rows="6"
                                                placeholder="Your answer here...">{{old("answer")}}</textarea>
                                    </div>
                                    @if ($errors->has('answer') )
                                        <span class="text-danger"
                                              role="alert">{{$errors->first('answer')}}</span>
                                    @endif
                                    @if ($errors->has('answer_limit') )
                                        <span class="text-danger"
                                              role="alert">{{$errors->first('answer_limit')}}</span>
                                    @endif

                                </div>
                                <input type="hidden" name="question_id" value="{{$id}}">
                                <button class="btn theme-btn theme-btn-sm" type="submit">Post Your Answer</button>
                            </form>
                        </div>
                    </div><!-- end question-main-bar -->
                </div><!-- end col-lg-9 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end question-area -->
    <script>
        var page = 1;
        $("#load-more").on("click", function () {
            page++;
            load_more(page);
        });

        function load_more(page) {
            $.ajax({
                type: 'Get',
                url: '{{route("answers-page",["id"=>$id]) ."?page="}}' + page,
                dataType: 'json',
                success: function (response) {
                    $(".container1").append(response.view);
                    if (response.button == "false") {
                        $("#load-more").hide();
                        $("#no-more").append("<p class=\"col-md-4 col-sm-4 alert alert-info\" style=\"text-align: center\" >No more data is available</p>");

                    } else {
                        $("#load-more").show();
                    }

                }
            });

        }


        $(document).ready(function () {
            $('#limit').change(function () {
                $("#submit_limit_form").submit();
            });
        });
    </script>
@endsection

