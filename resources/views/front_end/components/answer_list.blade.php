@php
    $answerRecord = isset($pageData['answer_record']) && !empty($pageData['answer_record']) ? $pageData['answer_record'] : $answerRecord;
    $usrId = isset(auth()->user()->id) && !empty(auth()->user()->id) ? auth()->user()->id : "";
@endphp
<div>
    @foreach($answerRecord as $item)
        <div class="answer-wrap d-flex">
            <div class="votes votes-styled w-auto">
                <div id="vote2" class="upvotejs">
                <span class="counter"
                      id="upvote_count_{{$item->id}}">{{"0"}}</span>
                    <a onclick="voteUp({{$item->id}})" id="up_answer_{{$item->id}}" class="upvote vote_{{$item->id}}"
                       data-toggle="tooltip" data-placement="right"
                       title="This question is useful"></a>

                    <span class="counter"
                          id="downvote_count_{{$item->id}}">{{"0"}}</span>
                    <a onclick="voteDown({{$item->id}})" id="down_answer_{{$item->id}}"
                       class="downvote  vote_{{$item->id}}"
                       data-vote-type="0"
                       id="post_vote_down_{{$item->id}}"
                       data-toggle="tooltip" data-placement="right"
                       title="This question is not useful"></a>

                    <br>
                    <span class="counter" id="vote_down_count_{{$item->id}}"></span>
                    <a onclick="isAccepted({{$item->id}})" id="accepted_{{$item->id}}"
                       class="star approve   {{$item->is_accepted == "true" ? "star-on" : "star"}}"
                       data-toggle="tooltip" data-placement="right"
                       title="The question owner accepted this answer">
                    </a>
                </div>
            </div><!-- end votes -->
            <div class="answer-body-wrap flex-grow-1">
                <div class="answer-body">
                    <p>{{$item->answer}}</p>
                </div><!-- end answer-body -->
                <div class="question-post-user-action">
                    <div class="post-menu">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle after-none" type="button"
                                    id="shareDropdownMenuTwo" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Share
                            </button>
                            <div class="dropdown-menu dropdown--menu dropdown--menu-2 mt-2"
                                 aria-labelledby="shareDropdownMenuTwo">
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
                                                <li><a href="#"
                                                       class="bg-dark text-white shadow-none"
                                                       title="Share link to this question on DEV"><i
                                                                class="lab la-dev"></i></a></li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- btn-group -->
                        <a href="#" class="btn">Edit</a>

                    </div><!-- end post-menu -->
                    <div class="media media-card user-media align-items-center">
                        <a href="user-profile.html" class="media-img d-block">
                            <img src="{{getProfileThumbnail($item->user_id,"small",$item->profile_pic)}}"
                                 alt="avatar">
                        </a>
                        <div class="media-body d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="pb-1"><a href="user-profile.html">{{$item->name}}</a>
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
</div>
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
                    $("#upvote_count_" + id).empty().text(response.up_vote);
                    $("#up_answer_" + id).addClass("upvote-on");
                    $(this).prop('disabled', true);

                }

                if (response.vote_type == "vote down") {
                    $("#downvote_count_" + id).text(response.down_vote);
                    $("#down_answer_" + id).addClass("downvote-on");
                    $(this).prop('disabled', true);
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
                success_type: successType
            },
            success: function (response) {
                var attr = $("#accepted_" + id).attr("class");
                if (response.success_type = "true") {
                    $(".approve").removeClass("star-on");
                    if (id == response.id) {
                        $("#accepted_" + id).addClass("star-on");
                        // $(this).attr('disabled', 'disabled');
                    }
                }
            }
        });
    }

</script>


