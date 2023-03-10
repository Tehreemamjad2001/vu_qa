@extends("back_end.layout/main")
@section("content")
    @php
        $answerRecord = $pageData["answer-record"];
        $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "";
        $sortDir = isset($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "";
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : "";
        $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : "";
        $searchByIsAccepted = isset($_GET['is_accepted']) && !empty($_GET['is_accepted']) ? $_GET['is_accepted'] : "sadadasdaada";
        $searchByAnswer = isset($_REQUEST['answer']) ? $_REQUEST['answer'] : "";
    $advancedSearch = isset($_REQUEST['advance_search']) && !empty($_REQUEST['advance_search']) ? $_REQUEST['advance_search'] :"";
    @endphp
    @if(Session::has('alert-delete-answer'))
        {!!Session::get('alert-delete-answer')!!}
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet box light-grey">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-comments"></i>Answer List
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <div class="row">
                            <div class="dataTables_filter " id="sample_1_filter">
                                <form action="">
                                    <div class="col-md-6 col-sm-6 text-center">
                                        <label>Answer:
                                            <input type="search" name="answer" placeholder="Search by answer"
                                                   value="{{isset($_GET['answer']) ? $_GET['answer'] : ""}}"
                                                   aria-controls="sample_1"
                                                   class=" form-control input-medium">
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 text-center">
                                        <label>Question Id:
                                            <input type="search" name="question_id"
                                                   placeholder="Search by question id"
                                                   value="{{isset($_GET['question_id']) ? $_GET['question_id'] : ""}}"
                                                   aria-controls="sample_1"
                                                   class=" form-control input-medium">
                                        </label>
                                    </div>
                                    <div id="toggle" class="{{$advancedSearch == "1" ? "show":"hide"}}">
                                        <div class="col-md-6 col-sm-6 text-center">
                                            <label>Staring Date:
                                                <input type="date" name="publish_at_from"
                                                       placeholder="Starting Date"
                                                       value="{{isset($_GET['publish_at_from']) ? $_GET['publish_at_from'] : ""}}"
                                                       aria-controls="sample_1"
                                                       class=" form-control input-medium">
                                            </label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-center">
                                            <label>Ending date:
                                                <input type="date" name="publish_at_to"
                                                       placeholder="eEnding date"
                                                       value="{{isset($_GET['publish_at_to']) ? $_GET['publish_at_to'] : ""}}"
                                                       aria-controls="sample_1"
                                                       class=" form-control input-medium">
                                            </label>

                                        </div>
                                        <div class="col-md-6 col-sm-6 text-center">
                                            <label>Is Accepted:
                                                <select name="is_accepted" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="true" {{$searchByIsAccepted == "true" ? "selected" : ""}}>
                                                        Yes
                                                    </option>
                                                    <option value="false" {{$searchByIsAccepted == "false" ? "selected" : ""}}>
                                                        No
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <input id="advance_search" name="advance_search" type="hidden"
                                               value="{{$advancedSearch == "1" ? "1":"0"}}">
                                        <input class="btn dark" type="submit" value="Search">
                                        <a href="{{route('answer-list')}}"><input class="btn red" type="button"
                                                                                  value="Reset"></a>
                                        <a href="{{route('answer-list')}}"> <input id="advance" class="btn red"
                                                                                   type="button"
                                                                                   value="Advance"></a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6"></div>
                    </div>


                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover dataTable"
                               id="sample_1"
                               aria-describedby="sample_1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" class="id" style="width: 50px">
                                    @php
                                        $url = getSortPageURL("id");
                                    @endphp
                                    <a class="default" href="{{$url}}"> Id
                                        <i class="
                                         {{($sort == "id") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                        {{($sort == "id") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                        {{($sortDir) && $sort != "id" ? "fa fa-unsorted": ""}}
                                                ">
                                        </i></a>
                                </th>
                                <th class="sorting" style="width: 450px">
                                    <a href="{{getSortPageURL('answer')}}"> Answer <i
                                                class="{{($sort == "answer") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "answer") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "answer" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting" style="width: 450px">
                                    <a href="{{getSortPageURL('question_id')}}"> Question Id <i
                                                class="{{($sort == "question_id") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "question_id") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "question_id" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting" style="width: 150px">
                                    <a href="{{getSortPageURL('total_up_vote')}}"> Up Vote <i
                                                class="{{($sort == "total_up_vote") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "total_up_vote") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "total_up_vote" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting" style="width: 150px">
                                    <a href="{{getSortPageURL('total_down_vote')}}"> Down Vote <i
                                                class="{{($sort == "total_down_vote") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "total_down_vote") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "total_down_vote" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting text-center" style="width: 150px">
                                    <a href="{{getSortPageURL('created_at')}}"> Publish at <i
                                                class="{{($sort == "created_at") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "created_at") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "created_at" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting text-center" style="width: 150px">
                                    <a href="{{getSortPageURL('is_accepted')}}"> Is Accepted ? <i
                                                class="{{($sort == "is_accepted") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "is_accepted") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "is_accepted" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>

                                <th class=" text-center"
                                    style="width: 50px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach ($answerRecord as $list)
                                <tr class="gradeX odd">
                                    <td class="" style="vertical-align: middle">
                                        {{$list->id}}
                                    </td>
                                    <td class=" " style="vertical-align: middle">
                                        {{Str::limit($list->answer,50)}}
                                    </td>
                                    <td class="" style="vertical-align: middle">
                                        {{$list->question_id}}
                                    </td>
                                    <td class=" " style="vertical-align: middle">
                                        {{ucwords($list->total_up_vote)}}
                                    </td>
                                    <td class=" " style="vertical-align: middle">
                                        {{ucwords($list->total_down_vote)}}
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">
                                        {{dateFormat($list->created_at)}}
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">
                                        {{$list->is_accepted == "false" ? "No" :"Yes"}}
                                    </td>
                                    <td class=" text-center" style="vertical-align: middle">

                                        <a name="delete" class="del_ete  btn default"
                                           href="{{route('answer-delete',["id"=>$list->id])}}"><b>Delete </b><span
                                                    class="fa fa-trash-o"></span></a>
                                        <a class="btn default"
                                           href="{{route('answer-edit',["id"=>$list->id])}}"><b>Edit </b><span
                                                    class="fa fa-edit "></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="text-left">
                                <form action="" id="form-option">
                                    <label>Choose a Number:</label>
                                    <select class="paginate" size="1" name="limit">
                                        <option value="30" {{$limit == "30" ? "selected" : ""}}>30</option>
                                        <option value="60" {{$limit == "60" ? "selected" : ""}}>60</option>
                                        <option value="90" {{$limit == "90" ? "selected" : ""}}>90</option>
                                    </select> records
                                    <br><br>
                                    <input type="hidden" name="sort_dir" value="{{$sortDir}}">
                                    <input type="hidden" name="sort" value="{{$sort}}">
                                    <input type="hidden" name="search" value="{{$search}}">
                                    <input type="submit" value="Submit" style="display: none">
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="text-right">
                                {!!$answerRecord->appends($_GET)->render()!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function () {
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
                            'Your Answer has been deleted.',
                            'success'
                        )
                    }
                })
            });
            jQuery('.paginate').change(function () {
                jQuery('#form-option').submit();
            });
            jQuery('#advance').on('click', function (e) {
                e.preventDefault();
                var advanceSearch = $("#advance_search").val();
                advanceSearch = 1 - advanceSearch;
                $("#advance_search").val(advanceSearch);
                $("#toggle").toggleClass('hide show');
            });
        });
    </script>
@endsection
