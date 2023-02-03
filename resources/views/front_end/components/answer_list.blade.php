@php
    $answerRecord = isset($pageData['answer_record']) && !empty($pageData['answer_record']) ? $pageData['answer_record'] : $finalResult;
    $questionId = isset(request()->id) && !empty(request()->id) ? request()->id :"";
    $usrId = isset(auth()->user()->id) && !empty(auth()->user()->id) ? auth()->user()->id : "";
    $shareComponent = isset($pageData["share_component"]) && !empty($pageData["share_component"]) ? $pageData["share_component"] : "";
@endphp
@foreach($answerRecord as $item)
    <div class="answer-wrap d-flex">
        <div class="votes votes-styled w-auto">
            <div id="vote2" class="upvotejs">
                <a onclick="voteUp({{$item->id}})" id="up_answer_{{$item->id}}"
                   class="upvote {{$item->is_logged_user_vote_up == "No" ? "" : "upvote-on" }}
                           vote_{{$item->id}}"
                   data-toggle="tooltip" data-placement="right"
                   title="Up Vote" style="cursor: pointer"></a>
                @php
                    $voteValue = $item->is_logged_user_vote_up == "Yes" ? $item->total_up_vote : $item->total_down_vote;
                @endphp
                <span id="vote_counter_{{$item->id}}">{{isset($voteValue) && !empty($voteValue) ? $voteValue : "0"}}</span>
                <a onclick="voteDown({{$item->id}})" id="down_answer_{{$item->id}}"
                   class="downvote  {{$item->is_logged_user_vote_down == "No" ? "" : "downvote-on" }} vote_{{$item->id}}"
                   data-vote-type="0"
                   id="post_vote_down_{{$item->id}}"
                   data-toggle="tooltip" data-placement="right"
                   title="Down Vote" style="cursor: pointer"></a>
                <br>
                <span class="counter" id="vote_down_count_{{$item->id}}"></span>
                <a onclick="isAccepted({{$item->id}})" id="accepted_{{$item->id}}"
                   class="star approve   {{$item->is_accepted == "true" ? "star-on" : "star"}}"
                   data-toggle="tooltip" data-placement="right"
                   title="Approve" style="cursor: pointer">
                </a>
            </div>
        </div><!-- end votes -->
        <div class="answer-body-wrap flex-grow-1">
            <div class="success-message">
                @if(Session::has('alert-update-user-answer-'. $item->id))
                    {!!Session::get('alert-update-user-answer-'. $item->id)!!}
                @endif
            </div>
            <div class="answer-body">
                <p id="ansewr_body_{{$item->id}}">{{$item->answer}}</p>
                <div id="update_answer_{{$item->id}}"></div>
            </div><!-- end answer-body -->
            <div class="error-message">
                @if($errors->has('error_answer_limit_'.$item->id))
                    <span class="text-danger" id="update-fail"
                          role="alert">{{$errors->first('error_answer_limit_'.$item->id)}}</span>
                @endif
                @if ($errors->has('blocked_keyword_update_ans_'.$item->id) )
                    <span class="text-danger"
                          role="alert">{{$errors->first('blocked_keyword_update_ans_'.$item->id)}}</span>
                @endif
            </div>
            <div class="question-post-user-action">
                <div class="post-menu">
                    <div class="post-form" id="answer_{{$item->id}}" style="display: none">
                        <form method="post" action="{{route("update-answer")}}" class="pt-3" id="#update-answer">
                            @csrf
                            <div class="input-box">
                                <div class="form-group">
                                        <textarea
                                                class="form-control form--control form-control-sm fs-13 user-text-editor"
                                                name="update_answer" rows="6"
                                                placeholder="Your answer here...">{{$item->answer}}</textarea>
                                </div>
                                @if ($errors->has('answer') )
                                    <span class="text-danger"
                                          role="alert">{{$errors->first('answer')}}</span>
                                @endif

                            </div>
                            <input type="hidden" name="answer_id" value="{{$item->id}}">
                            <input type="hidden" name="question_id" value="{{$item->question_id}}">
                            <button class="btn theme-btn theme-btn-sm" type="submit" id="save_updated_answer">Post Your
                                Answer
                            </button>
                            <input onclick="hideTextArea({{$item->id}})" class="btn theme-btn theme-btn-sm"
                                   type="button"
                                   id="reset_{{$item->id}}" value="Back">
                        </form>
                    </div>
                    <div class="btn-group">
                        {!! $shareComponent !!}
                    </div><!-- btn-group -->
                    @if(Auth::check() && $item->user_id = $usrId)
                        <a onclick="editAnswer({{$item->id}})" class="btn">Edit</a>
                    @endif
                </div><!-- end post-menu -->
                <div class="media media-card user-media align-items-center">
                    <a href="{{route("user-questions-list",["id"=>$item->user_id])}}" class="media-img d-block">
                        <img src="{{getProfileThumbnail($item->user_id,"small",$item->profile_pic)}}"
                             alt="avatar">
                    </a>
                    <div class="media-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="pb-1"><a
                                        href="{{route("user-questions-list",["id"=>$item->user_id])}}">{{$item->name}}</a>
                            </h5>

                        </div>

                        <small class="meta d-block text-right">
                            <span class="text-black d-block lh-18">answered</span>
                            <span class="d-block lh-18 fs-12">{{dateFormat($item->created_at)}}</span>
                        </small>
                    </div>
                </div><!-- end media -->
            </div><!-- end question-post-user-action -->
        </div><!-- end answer-body-wrap -->
    </div><!-- end answer-wrap -->

@endforeach

<script>
    function voteUp(id) {
        vote(id, "vote Up");
    }

    function voteDown(id) {
        vote(id, "vote Down");
    }

    function vote(id, voteType) {
        $.ajax({
            type: 'POST',
            url: '{{ url('/') . "/answer-votes"}}',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                user_id: "{{isset($usrId) && !empty($usrId) ? $usrId : ""}}",
                ans_id: id,
                vote_type: voteType
            },
            success: function (response) {

                if (response.vote_type == "vote Up") {
                    $("#down_answer_" + id).removeClass("downvote-on");
                    $("#up_answer_" + id).addClass("upvote-on");
                    $("#vote_counter_" + id).empty().text(response.up_vote);
                }
                else if (response.vote_type == "vote Down") {
                    $("#up_answer_" + id).removeClass("upvote-on");
                    $("#down_answer_" + id).addClass("downvote-on");
                    $("#vote_counter_" + id).empty().text(response.down_vote);
                }
            }
        });
    }

    function isAccepted(id) {
        accepted(id, "true");
    }

    function accepted(id, successType) {
        $.ajax({
            type: 'POST',
            url: '{{route("accepted-answer")}}',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                user_id: "{{isset($usrId) && !empty($usrId) ? $usrId : ""}}",
                ans_id: id,
                question_id: "{{$questionId}}",
                success_type: successType
            },
            success: function (response) {
                $("#accepted_" + id).attr("class");
                if (response.success_type = "true") {
                    $(".approve").removeClass("star-on");
                    if (id == response.id) {
                        $("#accepted_" + id).addClass("star-on");
                    }
                }
            }
        });
    }

    function hideTextArea(id) {
        $("#reset_" + id).on("click", function () {
            $("#answer_" + id).hide();
            $("#ansewr_body_" + id).show();
        })
    }

    function editAnswer(id) {
        $("#ansewr_body_" + id).hide();
        $("#update_answer_" + id).append(
            $("#answer_" + id).show(),
        );
    }

    $(".success-message").delay(3000).fadeOut();
    $(".error-message").delay(3000).fadeOut();
</script>


