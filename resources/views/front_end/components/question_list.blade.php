@php
    $routeName = Route::currentRouteName();
@endphp
<div class="media media-card rounded-0 shadow-none mb-0 bg-transparent p-3 border-bottom border-bottom-gray">
    <div class="votes text-center votes-2">
        <div class="answer-block answered my-2">
                                            <span class="answer-counts d-block lh-20 fw-medium">{{isset($data->total_no_of_ans)
                                            && !empty($data->total_no_of_ans) ? number_format($data->total_no_of_ans) : "0"}}</span>
            <span class="answer-text d-block fs-13 lh-18">{{$data->total_no_of_ans <= 1 ? "answer" : "answers"}}</span>
        </div>
        <div class="view-block">
            <span class="view-counts d-block lh-20 fw-medium">{{isset($data->views) && !empty($data->views) ?  number_format($data->views) : "0"}}</span>
            <span class="view-text d-block fs-13 lh-18">{{$data->views <=1 ? "view" :"views"}}</span>
        </div>
    </div>
    <div class="media-body">
        <h5 class="mb-2 fw-medium readmore" style="direction: rtl">
            <a
                    href="{{route("answers-page",["id"=>$data->question_id])}}">{{$data->title}}</a>
        </h5>
        <p class="mb-2 truncate lh-20 fs-15">{{$data->category_name}}</p>
        <p class="mb-2 truncate lh-20 fs-15 readmore" style="direction: rtl">{{$data->description}}</p>
        <div class="tags">
            @php
                $tagsRecord = explode(",",$data->tags);
            @endphp
            @foreach($tagsRecord as $value)
                <a href="{{isset($value) && !empty($value) ? "?tag=".$value : route("home")}}"
                   class="{{isset($value) && !empty($value) ? "tag-link" : ""}}">{{$value}}</a>
            @endforeach
        </div>
        <div class="media media-card user-media align-items-center px-0 border-bottom-0 pb-0">
            <a href="{{route("user-questions-list",["id"=>$data->id])}}"
               class="media-img d-block">
                <img src="{{getProfileThumbnail($data->id,'small',$data->profile_pic)}}" alt="avatar">
            </a>
            <div class="media-body d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h5 class="pb-1"><a
                                href="{{ route("user-questions-list",["id"=>$data->id])}}">{{$data->name}}</a>
                    </h5>
                </div>
                <small class="meta d-block text-right">
                    <span class="text-black d-block lh-18">asked</span>
                    <span class="d-block lh-18 fs-12">{{$time}}</span>
                    <span class="d-block lh-18 fs-12">{{$timeInAgo}}</span>
                </small>
            </div>
        </div>
    </div>
    @if($routeName == "my-question")
        <div class="text-center" style="padding-left: 5px">
            <div>
                <a name="delete" class="del_ete"
                   href="{{route("question-delete-page",["id"=>$data->question_id])}}">
                    <i class="las la-trash-alt la-3x "></i>
                </a>
            </div>
            <br>
            <div class="view-block">
                <a
                   href="{{route("question-edit-page",["id"=>$data->question_id])}}">
                    <i class="las la-edit la-3x "></i>
                </a>
            </div>
        </div>
    @endif
</div><!-- end media -->


