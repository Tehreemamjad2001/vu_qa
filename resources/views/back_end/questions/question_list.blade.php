@extends("back_end.layout/main")
@section("content")
    @php
        $parentCategories = $pageData["parent_category"];
        $childCategories = $pageData["child_category"];
        $record = $pageData["question_record"];
       $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "";
       $sortDir = isset($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "";
       $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : "";
       $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : "";
       $searchByCategory = isset($_GET['category']) && !empty($_GET['category']) ? $_GET['category'] : "";
       $searchByIsBlocked = isset($_GET['is_blocked']) && !empty($_GET['is_blocked']) ? $_GET['is_blocked'] : "sadadasdaada";
       $advancedSearch = isset($_REQUEST['advance_search']) && !empty($_REQUEST['advance_search']) ? $_REQUEST['advance_search'] :"";
    @endphp
    @if(Session::has('alert-delete-question'))
        {!!Session::get('alert-delete-question')!!}
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet box light-grey">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-question"></i>Question List
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <div class="row">
                            <div class="dataTables_filter " id="sample_1_filter">
                                <form action="">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Question:
                                            <input type="search" name="question" placeholder="Search by question"
                                                   value="{{isset($_GET['question']) ? $_GET['question'] : ""}}"
                                                   aria-controls="sample_1"
                                                   class=" form-control input-medium">
                                        </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Publish By:
                                            <input type="search" name="publish_by"
                                                   placeholder="Search by publish By"
                                                   value="{{isset($_GET['publish_by']) ? $_GET['publish_by'] : ""}}"
                                                   aria-controls="sample_1"
                                                   class=" form-control input-medium">
                                        </label>
                                    </div>
                                    <div id="toggle" class="{{$advancedSearch == "1" ? "show":"hide"}}">
                                        <div class="col-md-6 col-sm-6">
                                            <label>Staring Date:
                                                <input type="date" name="publish_at_from"
                                                       placeholder="Starting Date"
                                                       value="{{isset($_GET['publish_at_from']) ? $_GET['publish_at_from'] : ""}}"
                                                       aria-controls="sample_1"
                                                       class=" form-control input-medium">
                                            </label>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Ending date:
                                                <input type="date" name="publish_at_to"
                                                       placeholder="eEnding date"
                                                       value="{{isset($_GET['publish_at_to']) ? $_GET['publish_at_to'] : ""}}"
                                                       aria-controls="sample_1"
                                                       class=" form-control input-medium">
                                            </label>

                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Category:
                                                <select name="category" class="form-control">
                                                    <option value="">All</option>
                                                    @foreach($parentCategories as $value)
                                                        <optgroup label="{{$value->category_name}}">
                                                            @foreach($childCategories as $item)
                                                                @if ($item->parent_id ==  $value->id)
                                                                    <option value="{{$item->id}}" {{$searchByCategory == $item->id ? "selected" : ""}}>
                                                                        {{$item->category_name}}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Is Blocked:
                                                <select name="is_blocked" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="true" {{$searchByIsBlocked == "true" ? "selected" : ""}}>
                                                        Yes
                                                    </option>
                                                    <option value="false" {{$searchByIsBlocked == "false" ? "selected" : ""}}>
                                                        No
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3"></div>
                                    <div class="col-md-6 col-sm-6">
                                        <input id="advance_search" name="advance_search" type="hidden"
                                               value="{{$advancedSearch == "1" ? "1":"0"}}">
                                        <input class="btn dark" type="submit" value="Search">
                                        <a href="{{route('question-list')}}"><input class="btn red" type="button"
                                                                                    value="Reset"></a>
                                        <a href="{{route('question-list')}}"> <input id="advance" class="btn red"
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
                                    <a href="{{getSortPageURL('title')}}"> Question <i
                                                class="{{($sort == "title") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "title") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "title" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting" style="width:150px">
                                    <a href="{{getSortPageURL('category_id')}}"> Category <i
                                                class="{{($sort == "category_id") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "category_id") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "category_id" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting " style="width: 150px">
                                    <a href="{{getSortPageURL('category_id')}}"> Publish By <i
                                                class="{{($sort == "category_id") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "category_id") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "category_id" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting text-center" style="width: 150px">
                                    <a href="{{getSortPageURL('category_id')}}"> Publish at <i
                                                class="{{($sort == "category_id") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "category_id") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "category_id" ? "fa fa-unsorted": ""}}
                                                        ">
                                        </i></a>
                                </th>
                                <th class="sorting text-center" style="width: 150px">
                                    <a href="{{getSortPageURL('is_blocked')}}"> Is Blocked <i
                                                class="{{($sort == "category_id") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                {{($sort == "category_id") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                {{($sortDir) && $sort != "category_id" ? "fa fa-unsorted": ""}}
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
                            {{--                            {{dd($record)}}--}}
                            @foreach ($record as $list)
                                <tr class="gradeX odd">
                                    <td class="" style="vertical-align: middle">
                                        {{$list->id}}
                                    </td>
                                    <td class=" " style="vertical-align: middle">
                                        {{Str::limit($list->title,50)}}
                                    </td>
                                    <td class=" " style="vertical-align: middle">
                                        {{ucwords($list->category_name)}}
                                    </td>
                                    <td class=" " style="vertical-align: middle">
                                        {{ucwords($list->user_name)}}
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">
                                        {{dateFormat($list->created_at)}}
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">
                                        {{$list->is_blocked == "false" ? "No" : "Yes"}}
                                    </td>
                                    <td class=" text-center" style="vertical-align: middle">
                                        <a name="delete" class="del_ete  btn default"
                                           href="{{route('question-delete',["id"=>$list->id])}}"><b>Delete </b><span
                                                    class="fa fa-trash-o"></span></a>
                                        <a class="btn default"
                                           href="{{route('question-edit',["id"=>$list->id])}}"><b>Edit </b><span
                                                    class="fa fa-edit "></span></a>
                                        <a class="btn default"
                                           href="{{route('answer-user-list',["id"=>$list->id])}}"><b>Answer </b><span
                                                    class="fa fa-comments "></span></a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="text-left">
                                <form action="">
                                    <label>Choose a Number:</label>
                                    <select class="option" size="1" name="limit">
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
                                {!!$record->appends($_GET)->render()!!}
                            </div>
                        </div>
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
                            'Your Question has been deleted.',
                            'success'
                        )
                    }
                })
            });
            jQuery(function () {
                jQuery('.option').change(function () {
                    this.form.submit();
                });
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

