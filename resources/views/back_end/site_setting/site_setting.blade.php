@extends("back_end.layout/main")
@section("content")
    @php
        $record = $pageData["option_record"];
        $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "";
        $sortDir = isset($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "";
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : "";
        $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : "";
    @endphp
    @if(Session::has('alert-delete-category'))
        {!!Session::get('alert-delete-category')!!}
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box light-grey">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-percent">%</i>Lang Limit List
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="dataTables_filter " id="sample_1_filter">
                                    <form action="">
                                        <label>Search:
                                            <input type="search" name="search" placeholder="Search by Title"
                                                   value="{{isset($_GET['search']) ? $_GET['search'] : ""}}"
                                                   aria-controls="sample_1"
                                                   class="form-control form-control input-medium">
                                        </label>
                                        <input class="btn dark" type="submit" value="Search">
                                        <a href="{{route('site-setting-list')}}"><input class="btn red" type="button"
                                                                                      value="Reset"></a>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover dataTable" id="sample_1"
                                   aria-describedby="sample_1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" class="id" style="width: 70px">
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
                                    <th class="sorting" style="width: 150px">
                                        <a href="{{getSortPageURL('key')}}"> Key <i
                                                    class="
                                                   {{($sort == "key") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "key") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "key" ? "fa fa-unsorted": ""}}
                                                            ">
                                            </i></a>
                                    </th>
                                    <th class="sorting" style="width: 150px">
                                        <a href="{{getSortPageURL('description')}}"> Description <i
                                                    class="
                                                   {{($sort == "description") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "description") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "description" ? "fa fa-unsorted": ""}}
                                                            ">
                                            </i></a>
                                    </th>
                                    <th class="sorting_disabled" style="width: 150px">
                                        <a href="{{getSortPageURL('value')}}"> Value <i
                                                    class="
                                                   {{($sort == "value") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "value") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "value" ? "fa fa-unsorted": ""}}
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
                                @foreach ($record as $list)
                                    <tr class="gradeX odd">
                                        <td class="" style="vertical-align: middle">
                                            {{$list->id}}
                                        </td>
                                        <td class=" " style="vertical-align: middle">
                                            {{$list->key}}
                                        </td>
                                        <td class=" " style="vertical-align: middle">
                                            {{$list->description}}
                                        </td>
                                        <td class=" " style="vertical-align: middle">
                                            {{$list->value}}
                                        </td>
                                        <td class=" text-center" style="vertical-align: middle">
                                            <a class="btn default"
                                               href="{{route('site-setting-edit',["id"=>$list->id])}}"><b>Edit </b><span
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
                                    <form action="">
                                        <label>Choose a Number:</label>
                                        <select class="option" size="1" name="limit">
                                            <option value="5" {{$limit == "5" ? "selected" : ""}}>5</option>
                                            <option value="10" {{$limit == "10" ? "selected" : ""}}>10</option>
                                            <option value="15" {{$limit == "15" ? "selected" : ""}}>15</option>
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function () {
            jQuery(function () {
                jQuery('.option').change(function () {
                    this.form.submit();
                });
            });
        });
    </script>
@endsection