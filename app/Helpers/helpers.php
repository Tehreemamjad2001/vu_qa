<?php

use Carbon\Carbon;

function assets($path, $front = false, $secure = null)
{
    $currentTime = Carbon::now()->format('Ymdhis');
    if (!$front)
        $folder = "back-end";
    else
        $folder = "web";

    return app('url')->asset("public/$folder/" . $path, $secure) . "?=$currentTime";

}

function getSortPageURL($label)
{
    $current_page_url = url()->current();
    $current_page_url = $current_page_url . (count(Request::all()) || !(Request::get('page')) ? "?" : "");
    $current_page_url = $current_page_url . (Request::get('page') ? "&page=" . Request::get('page') : "");
    $current_page_url = $current_page_url . (Request::get('search') ? "&search=" . Request::get('search') : "");
    $current_page_url = $current_page_url . (Request::get('limit') ? "&limit=" . Request::get('limit') : "");
    $sort_dir = "DESC";
    if (Request::get('sort_dir')) {
        $sort_dir = Request::get('sort_dir');
        $sort_dir = $sort_dir == "asc" ? "desc" : "asc";
    }
    $current_page_url = $current_page_url . "&sort=$label";
    //dd($current_page_url);
    $current_page_url = $current_page_url . "&sort_dir=$sort_dir";
    return $current_page_url;


}

function storageUrl($path, $secure = null)
{
    return app('url')->asset("storage/app/images/profile_pic/" . $path, $secure);
}

function getProfileThumbnail($id, $type, $name)
{

    if (isset($name) && !empty($name)) {
        return app('url')->asset("storage/app/images/profile_pic/" . $id . "/" . $type . "_" . $name);
    } else {
        return assets("assets/img/8023186.jpg");
    }
}

function profilePicDimension()
{
    $dimension = [
        "small" => ["width" => 100, "height" => 100],
        "medium" => ["width" => 300, "height" => 300],
        "large" => ["width" => 500, "height" => 500],
    ];
    return $dimension;
}

function deleteProfilePicFromFolder($path, $name)
{
    if (isset($name) && !empty($name)) {
        $dimension = profilePicDimension();
        $mainProfilePicSourceInFolder = $path . $name;
        //dd($mainProfilePicSourceInFolder);
        @unlink($mainProfilePicSourceInFolder);

        foreach ($dimension as $key => $item) {
            $profilePicSourceInFolder = $path . $key . "_" . $name;
            @unlink($profilePicSourceInFolder);
        }
    }

}

function dateFormat($date)
{
    if (isset($date) && !empty($date)) {
        $currentTime = Carbon::parse($date)->format('d-M-Y  g:i:s A');
        return $currentTime;
    }
}

 function getTimeAgo($carbonObject) {
    //dd($carbonObject);
    return str_ireplace(
        [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'],
        ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'],
        $carbonObject->diffForHumans()

    );
}






