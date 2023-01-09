@extends("back_end/layout/main")
@section("content")
    @php
        $userCount =  $pageData["user_count"];
        $categoryCount =  $pageData["category_count"];
    @endphp
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="fa fa-user"></i>
                </div>
                <div class="details">
                    <div class="number">
                        {{$userCount}}
                    </div>
                    <div class="desc">
                        Total Number of User
                    </div>
                </div>
                <a class="more" href="{{route("user-list")}}">
                    User List <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-toggle-down"></i>
                </div>
                <div class="details">
                    <div class="number">
                        {{$categoryCount}}
                    </div>
                    <div class="desc">
                        Total Number of Category
                    </div>
                </div>
                <a class="more" href="{{route("category-list")}}">
                    Category List <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
    </div>
@endsection