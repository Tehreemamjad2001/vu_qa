@extends("back_end.layout/main")
@section("content")
    @php
        $record = $pageData["category_record"];
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
                        <i class="fa fa-toggle-down"></i>Category List
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
                                        <a href="{{route('category-list')}}"><input class="btn red" type="button"
                                                                                    value="Reset"></a>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 text-right">
                                <div class="btn-group">
                                    <a href="{{route('category-add')}}">
                                        <button id="sample_editable_1_new" class="btn green">
                                            Add New <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
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
                                        <a href="{{getSortPageURL('category_name')}}"> Title <i
                                                    class="{{($sort == "category_name") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "category_name") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "category_name" ? "fa fa-unsorted": ""}}
                                                            ">
                                            </i></a>
                                    </th>
                                    <th class="sorting_disabled" style="width: 150px">
                                        <a href="{{getSortPageURL('parent_id')}}"> Parent Category <i
                                                    class="{{($sort == "parent_id") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "parent_id") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "parent_id" ? "fa fa-unsorted": ""}}
                                                            ">
                                            </i></a>
                                    </th>
                                    <th class="sorting_disabled" style="">
                                        <a href="{{getSortPageURL('description')}}"> Slug <i
                                                    class="{{($sort == "description") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "description") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "description" ? "fa fa-unsorted": ""}}
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
                                            {{$list->category_name}}
                                        </td>
                                        <td class=" " style="vertical-align: middle">
                                            {{isset($list->parent_name) ? $list->parent_name : "Parent"}}
                                        </td>
                                        <td class="center " style="vertical-align: middle">
                                            {{$list->slug}}
                                        </td>
                                        <td class=" text-center" style="vertical-align: middle">

                                            <a name="delete" class="del_ete  btn default"
                                               href="{{route('category-delete',["id"=>$list->id])}}"><b>Delete </b><span
                                                        class="fa fa-trash-o"></span></a>
                                            <a class="btn default"
                                               href="{{route('category-edit',["id"=>$list->id])}}"><b>Edit </b><span
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
                                            <option selected="selected">{{isset($limit) && !empty($limit) ? $limit : "5"}}</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
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
                            'Your file has been deleted.',
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
        });
    </script>
@endsection