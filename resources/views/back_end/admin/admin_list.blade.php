@extends("back_end.layout.main")
@section("content")
    @php
        $record = $pageData["admin_record"];
        $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "";
        $sortDir = isset($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "";
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : "";
        $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : "";
    @endphp
    @if(Session::has('alert-delete-admin'))
        {!!Session::get('alert-delete-admin')!!}
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box light-grey">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-male"></i>Admin List
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="dataTables_filter " id="sample_1_filter">
                                    <form action="">
                                        <label>Search:
                                            <input type="search" name="search" placeholder="Search by Name or Email"
                                                   value="{{isset($_GET['search']) ? $_GET['search'] : ""}}"
                                                   aria-controls="sample_1"
                                                   class="form-control form-control input-medium">
                                        </label>
                                        <input class="btn dark" type="submit" value="Search">
                                        <a href="{{route('admin-list')}}"><input class="btn red" type="button"
                                                                                 value="Reset"></a>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 text-right">
                                <div class="btn-group">
                                    <a href="{{route('admin-add')}}">
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
                                    <th class="sorting" class="id" style="width: 70px;">
                                        @php
                                            $url = getSortPageURL("id");
                                        @endphp
                                        <a class="default" href="{{$url}}"> Id
                                            <i class="
                                         {{($sort == "id") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                            {{($sort == "id") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                            {{($sortDir) && $sort != "id" ? "fa fa-unsorted": "5555"}}
                                                    ">
                                            </i></a>

                                    </th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample_1"
                                        rowspan="1" colspan="1" aria-label="
									Username
								: activate to sort column ascending" style="width: 258px;">
                                        <a href="{{getSortPageURL('name')}}"> Name <i
                                                    class="{{($sort == "name") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "name") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "name" ? "fa fa-unsorted": "5555"}}
                                                            ">
                                            </i></a>
                                    </th>
                                    <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1"
                                        aria-label="
									Email
								" style="width: 400px;">
                                        <a href="{{getSortPageURL('email')}}"> Email <i
                                                    class="{{($sort == "email") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "email") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "email" ? "fa fa-unsorted": "5555"}}
                                                            ">
                                            </i></a>
                                    </th>
                                    <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1"
                                        aria-label="
									Joined
								" style="width: 200px;">
                                        <a href="{{getSortPageURL('gender')}}"> Gender <i
                                                    class="{{($sort == "gender") && ($sortDir == "asc")   ? "fa fa-caret-up" :"" }}
                                                    {{($sort == "gender") &&  ($sortDir == "desc") ? "fa fa-caret-down": ""}}
                                                    {{($sortDir) && $sort != "gender" ? "fa fa-unsorted": "5555"}}
                                                            ">
                                            </i></a>
                                    </th>
                                    <th class=" text-center"
                                        style="width: 200px;">
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
                                            {{$list->name}}
                                        </td>
                                        <td class=" " style="vertical-align: middle">
                                            <a href="mailto:{{$list->email}}">{{$list->email}}</a>
                                        </td>
                                        <td class="center " style="vertical-align: middle">
                                            {{ucfirst($list->gender)}}
                                        </td>
                                        <td class=" text-center" style="vertical-align: middle">

                                            <a name="delete" class="del_ete  btn default"
                                               href="{{route('admin-delete',["id"=>$list->id])}}"><b>Delete </b><span
                                                        class="fa fa-trash-o">              </span></a>
                                            <a class="btn default"
                                               href="{{route('admin-edit',["id"=>$list->id])}}"><b>Edit </b><span
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
                                            <option value="5"   {{$limit == "5" ? "selected" : ""}}>5</option>
                                            <option value="10"   {{$limit == "10" ? "selected" : ""}}>10</option>
                                            <option value="15"   {{$limit == "15" ? "selected" : ""}}>15</option>
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
            <script>
                jQuery(document).ready(function () {

                    jQuery(".del_ete").on('click', function (e) {
                        e.preventDefault();
                        //console.log(jQuery(this).attr('href'));
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
        </div>
@endsection

