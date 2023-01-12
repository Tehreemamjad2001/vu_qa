@extends("front_end/layout/main")
@section("content")
    @php
        $questionRecord  = $pageData["question-record"];
        $time = getTimeAgo($questionRecord->created_at);
        $id = request()->id;
    @endphp
    <section class="hero-area bg-white shadow-sm overflow-hidden pt-40px pb-40px">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <div class="hero-content">
                        <h2 class="section-title pb-2 fs-24 lh-34">Find the best answer to your technical question, <br>
                            help others answer theirs
                        </h2>
                        <p class="lh-26">If you are going to use a passage of Lorem Ipsum, you need to be sure there
                            <br> isn't anything embarrassing hidden in the middle of text.
                        </p>
                        <ul class="generic-list-item pt-3">
                            <li><span class="icon-element icon-element-xs shadow-sm d-inline-block mr-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                            width="20px" fill="#6c727c"><path d="M0 0h24v24H0V0z" fill="none"/><path
                                                d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"/></svg></span>
                                Anybody can ask a question
                            </li>
                            <li><span class="icon-element icon-element-xs shadow-sm d-inline-block mr-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                            width="20px" fill="#6c727c"><path d="M0 0h24v24H0V0z" fill="none"/><path
                                                d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg></span>
                                Anybody can answer
                            </li>
                            <li><span class="icon-element icon-element-xs shadow-sm d-inline-block mr-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 320 512"
                                            width="20px"><path fill="#6c727c"
                                                               d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"></path></svg></span>
                                The best answers are voted up and rise to the top
                            </li>
                        </ul>
                    </div><!-- end hero-content -->
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
                <div class="col-lg-9">
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
                                            <a href="#" class="text-black">19 days ago</a>
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
                        <div class="subheader d-flex align-items-center justify-content-between">
                            <div class="subheader-title">
                                <h3 class="fs-16">1 Answer</h3>
                            </div><!-- end subheader-title -->
                            <div class="subheader-actions d-flex align-items-center lh-1">
                                <label class="fs-13 fw-regular mr-1 mb-0">Order by</label>
                                <div class="w-100px">
                                    <select class="select-container">
                                        <option value="active">active</option>
                                        <option value="oldest">oldest</option>
                                        <option value="votes" selected="selected">votes</option>
                                    </select>
                                </div>
                            </div><!-- end subheader-actions -->
                        </div><!-- end subheader -->

                        <div class="" style="">
                            <div id="data-wrapper">
                                <!-- Results -->
                            </div>
                            <!-- Data Loader -->
                            <div class="auto-load text-center">
                                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
                                     xml:space="preserve">
                <path fill="#000"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite"/>
                </path>
            </svg>
                            </div>
                        </div>
                        <div class="subheader">
                            <div class="subheader-title">
                                <h3 class="fs-16">Your Answer</h3>
                            </div><!-- end subheader-title -->
                        </div><!-- end subheader -->

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
                                </div>
                                <input type="hidden" name="question_id" value="{{$id}}">
                                <button class="btn theme-btn theme-btn-sm" type="submit">Post Your Answer</button>
                            </form>
                        </div>

                    </div><!-- end question-main-bar -->
                </div><!-- end col-lg-9 -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="fs-17 pb-3">Related Questions</h3>
                                <div class="divider"><span></span></div>
                                <div class="sidebar-questions pt-3">
                                    <div class="media media-card media--card media--card-2">
                                        <div class="media-body">
                                            <h5><a href="question-details.html">How to select the dom element with
                                                    event.target</a></h5>
                                            <small class="meta">
                                                <span class="pr-1">2 mins ago</span>
                                                <span class="pr-1">. by</span>
                                                <a href="#" class="author">Sudhir Kumbhare</a>
                                            </small>
                                        </div>
                                    </div><!-- end media -->
                                    <div class="media media-card media--card media--card-2">
                                        <div class="media-body">
                                            <h5><a href="question-details.html">How can you cut an onion without
                                                    crying?</a></h5>
                                            <small class="meta">
                                                <span class="pr-1">48 mins ago</span>
                                                <span class="pr-1">. by</span>
                                                <a href="#" class="author">wimax</a>
                                            </small>
                                        </div>
                                    </div><!-- end media -->
                                    <div class="media media-card media--card media--card-2">
                                        <div class="media-body">
                                            <h5><a href="question-details.html">How to change the behavior of dropdown
                                                    buttons in HTML</a></h5>
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
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end question-area -->
    <script>
        $(document).ready(function () {
            $('#limit').change(function () {
                $("#submit_limit_form").submit();
            });
        });
        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        //infinteLoadMore(page);
        $(window).scroll(function () {
            //alert("sadsadasdasdasd");
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                // alert("tehreem");
                page++;
                infinteLoadMore(page);
            }
            // alert("tehreem");
        });

        function infinteLoadMore(page) {
            $.ajax({
                url: ENDPOINT + "/answers/{{$id}}?page=" + page,
                datatype: "html",
                type: "get",

                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response);
                })

                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

    </script>
@endsection

