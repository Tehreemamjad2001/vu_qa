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
    <section class="hero-area bg-white shadow-sm overflow-hidden pt-0px pb-40px">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                </div><!-- end col-lg-9 -->
                <div class="col-lg-3">
                    <div class="hero-btn-box text-right py-3">
                        <a href="{{route("ask-question-page")}}" class="btn theme-btn">Ask a Question</a>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!--======================================
            END HERO AREA
    ======================================-->

    <!-- ================================
             START QUESTION AREA
    ================================= -->
    <section class="question-area pt-40px pb-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="question-main-bar mb-50px">
                        <div class="question-highlight">
                            <div class="media media-card shadow-none rounded-0 mb-0 bg-transparent p-0">
                                <div class="media-body">
                                    <h5 class="fs-20"><a href="question-details.html">{{$questionRecord->title}}</a>
                                    </h5>
                                    <div class="meta d-flex flex-wrap align-items-center fs-13 lh-20 py-1">
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
                                            <a href="#" class="tag-link">
                                                {{$item}}
                                            </a>
                                        @endforeach

                                    </div>
                                </div>
                            </div><!-- end media -->
                        </div><!-- end question-highlight -->
                        <div class="question d-flex">
                            <div class="votes votes-styled w-auto">
                                <div id="vote" class="upvotejs">
                                    <a class="upvote upvote-on" data-toggle="tooltip" data-placement="right"
                                       title="This question is useful"></a>
                                    <span class="count">1</span>
                                    <a class="downvote" data-toggle="tooltip" data-placement="right"
                                       title="This question is not useful"></a>
                                    <a class="star" data-toggle="tooltip" data-placement="right"
                                       title="Bookmark this question."></a>
                                </div>
                            </div><!-- end votes -->
                            <div class="question-post-body-wrap flex-grow-1">
                                <div class="question-post-body">
                                    <p></p>
                                    <pre class="code-block custom-scrollbar-styled">
                                        {{$questionRecord->description}}

                                    </pre>
                                    <p>Then I attempt to get it like so:</p>
                                    <pre class="code-block custom-scrollbar-styled">
                                        <code>(<span class="code-string">{{$questionRecord->description}}</span>)</code></pre>


                                    <pre>                                  <hr>
<code>$(<span class="code-string">"#size-click"</span>).click(<span class="code-function">() =&gt;</span> {
 <span class="code-keyword">let</span> width = $(<span class="code-string">"#prod-width"</span>).val();
 <span class="code-keyword">let</span> height = $(<span class="code-string">"#prod-height"</span>).val();
 <span class="code-keyword">var</span> prodId = $(<span class="code-built-in">this</span>).data(<span
            class="code-string">"productId"</span>);

 <span class="code-built-in">console</span>.log(<span class="code-string">'this is prodId'</span>);
 <span class="code-built-in">console</span>.log(prodId);

 <span class="code-keyword">const</span> data = {
      <span class="code-attr">prodId</span>: prodId,
      <span class="code-attr">step</span>: <span class="code-string">'Size'</span>,
      <span class="code-attr">width</span>: width,
      <span class="code-attr">height</span>: height,
    }

    postDataEstimate(data);

  })
</code></pre>
                                    <p>I'm also trying this:</p>
                                    <pre class="code-block custom-scrollbar-styled">
                                        <code><span class="code-keyword">var</span> prodId = $(<span
                                                    class="code-built-in">this</span>).attr(<span
                                                    class="code-string">'data-productId'</span>);
                                          </code></pre>
                                    <p>Posted By</p>
                                </div><!-- end question-post-body -->
                                <div class="question-post-user-action">
                                    <div class="post-menu">
                                        <div class="btn-group">
                                            <button class="btn dropdown-toggle after-none" type="button"
                                                    id="shareDropdownMenu" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Share
                                            </button>
                                            <div class="dropdown-menu dropdown--menu dropdown--menu-2 mt-2"
                                                 aria-labelledby="shareDropdownMenu">
                                                <div class="py-3 px-4">
                                                    <h4 class="fs-15 pb-2">Share a link to this question</h4>
                                                    <form action="#" class="copy-to-clipboard">
                                                        <span class="text-success-message">Link Copied!</span>
                                                        <input type="text"
                                                               class="form-control form--control form-control-sm copy-input"
                                                               value="https://disilab.com/q/66552850/15319675">
                                                        <div class="btn-box pt-2 d-flex align-items-center justify-content-between">
                                                            <a href="#" class="btn-text copy-btn">Copy link</a>
                                                            <ul class="social-icons social-icons-sm">
                                                                <li><a href="#" class="bg-8 text-white shadow-none"
                                                                       title="Share link to this question on Facebook"><i
                                                                                class="la la-facebook"></i></a></li>
                                                                <li><a href="#" class="bg-9 text-white shadow-none"
                                                                       title="Share link to this question on Twitter"><i
                                                                                class="la la-twitter"></i></a></li>
                                                                <li><a href="#" class="bg-dark text-white shadow-none"
                                                                       title="Share link to this question on DEV"><i
                                                                                class="lab la-dev"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- btn-group -->
                                        <a href="#" class="btn">Edit</a>
                                        <button class="btn">Follow</button>
                                    </div><!-- end post-menu -->
                                    <div class="media media-card user-media owner align-items-center">
                                        <a href="user-profile.html" class="media-img d-block">
                                            <img src="{{getProfileThumbnail($questionRecord->user_id,"small",$questionRecord->profile_pic)}}"
                                                 alt="avatar">
                                        </a>
                                        <div class="media-body d-flex flex-wrap align-items-center justify-content-between">
                                            <div>
                                                <h5 class="pb-1"><a
                                                            href="user-profile.html">{{$questionRecord->name}}</a></h5>
                                                <div class="stats fs-12 d-flex align-items-center lh-18">
                                                    <span class="text-black pr-2">224,110</span>
                                                    <span class="pr-2 d-inline-flex align-items-center"><span
                                                                class="ball gold"></span>16</span>
                                                    <span class="pr-2 d-inline-flex align-items-center"><span
                                                                class="ball silver"></span>93</span>
                                                    <span class="pr-2 d-inline-flex align-items-center"><span
                                                                class="ball"></span>136</span>
                                                </div>
                                            </div>
                                            <small class="meta d-block text-right">
                                                <span class="text-black d-block lh-18">asked</span>
                                                <span class="d-block lh-18 fs-12">{{$time}}</span>
                                            </small>
                                        </div>
                                    </div><!-- end media -->
                                </div><!-- end question-post-user-action -->
                            </div><!-- end question-post-body-wrap -->
                        </div><!-- end question -->

                        <div class="subheader">
                            <div class="subheader-title">
                                <h3 class="fs-16">Answer</h3>
                            </div><!-- end subheader-title -->
                        </div><!-- end subheader -->
                        <div class="">
                            @include("front_end.components.answer_list")
                        </div>
                        <div class="container1">
                        </div>
                        @if($perPageAnswers < $totalNumberOfAnswers)
                            <input type="submit" value="Load More" id="load-more" class="btn theme-btn">
                        @endif
                        <div class="post-form" id="save-answer">
                            <form method="post" action="{{route("save-answer")}}" class="pt-3">
                                @csrf
                                @if(Session::has('alert-save-answer'))
                                    {!!Session::get('alert-save-answer')!!}
                                @endif
                                <div class="input-box">
                                    <label class="fs-14 text-black lh-20 fw-medium">Body</label>
                                    <div class="form-group">
                                        <textarea
                                                class="form-control form--control form-control-sm fs-13 user-text-editor"
                                                name="answer" rows="6" placeholder="Your answer here..."></textarea>
                                    </div>
                                    @if ($errors->has('answer'))
                                        <span class="text-danger"
                                              role="alert">{{$errors->first('answer')}}</span>
                                    @endif
                                    @if(Session::has('alert-lang-limit'))
                                    {!!Session::get('alert-lang-limit')!!}
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
                    console.log("hellosuccess");
                    $(".container1").append(response.view);
                    if (response.button = "false") {
                        $("#load-more").hide();
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

