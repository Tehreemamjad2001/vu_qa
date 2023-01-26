@php
    $answerRecord = isset($pageData['answer_record']) && !empty($pageData['answer_record']) ? $pageData['answer_record'] : $answerRecord;
    $usrId = isset(auth()->user()->id) && !empty(auth()->user()->id) ? auth()->user()->id : "";
@endphp
<div>
    @foreach($answerRecord as $item)

        <div class="answer-wrap d-flex">
            <div class="votes votes-styled w-auto  ">
                <div id="vote2" class="upvotejs">
                    <table>
                        <tr>
                            <td><span class="counter"
                                      id="upvote_count_{{$item->id}}">{{isset($item->total_up_vote) &&
                               !empty($item->total_up_vote) ? $item->total_up_vote : "0"}}</span>
                            </td>
                            <td>
                                <button onclick="voteUp({{$item->id}})" class="upvote   vote_{{$item->id}}"
                                        data-toggle="tooltip" data-placement="right"
                                        title="This question is useful"></button>
                            </td>
                        </tr>
                        <tr>
                            <td> <span class="counter"
                                       id="downvote_count_{{$item->id}}">{{isset($item->total_down_vote) &&
                                 !empty($item->total_down_vote) ? $item->total_down_vote : "0"}}</span>
                            </td>
                            <td>
                                <button onclick="voteDown({{$item->id}})" class="downvote   vote_{{$item->id}}"
                                        data-vote-type="0"
                                        id="post_vote_down_82"
                                        data-toggle="tooltip" data-placement="right"
                                        title="This question is not useful"></button>
                            </td>
                        </tr>
                    </table>


                    <br>

                    <span class="counter" id="vote_down_count_82"></span>


                    <button onclick="isAccepted({{$item->id}})" id="accepted_{{$item->id}}"
                            class="star check star-on {{$item->is_accepted == "true" ? "btn btn-success" : "btn btn-light"}}"
                            data-toggle="tooltip" data-placement="right"
                            title="The question owner accepted this answer"> approved
                    </button>
                </div>
            </div><!-- end votes -->
            <div class="answer-body-wrap flex-grow-1">
                <div class="answer-body">
                    <p>Since you're using an <code class="code">arrow-function</code>, <code
                                class="code">this</code> does not refer to the <code
                                class="code">button</code>:</p>
                    <pre class="code-block custom-scrollbar-styled">
                                         <span class="code-string">{{$item->answer}}</span>
                                         </pre>
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
                        <button class="btn">Follow</button>
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
                                <div class="stats fs-12 d-flex align-items-center lh-18">
                                    <span class="text-black pr-2">15.5k</span>
                                    <span class="pr-2 d-inline-flex align-items-center"><span
                                                class="ball gold"></span>3</span>
                                    <span class="pr-2 d-inline-flex align-items-center"><span
                                                class="ball silver"></span>10</span>
                                    <span class="pr-2 d-inline-flex align-items-center"><span
                                                class="ball"></span>26</span>
                                </div>
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
                $("#upvote_count_" + id).empty().text(response.up_vote);
                $("#downvote_count_" + id).empty().text(response.down_vote);

                if ($("#upvote_count_" + id).empty().text(response.up_vote)) {
                    $(".vote_" + id).prop('disabled', true);
                }
                else if ($("#downvote_count_" + id).empty().text(response.down_vote)) {
                    $(".vote_" + id).prop('disabled', true);
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
                console.log(attr);
                if (response.success_type = "true") {
                    $("#accepted_" + id).attr("class", "btn btn-success");
                }
            }
        });
    }

</script>


