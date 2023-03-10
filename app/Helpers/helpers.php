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
        @unlink($mainProfilePicSourceInFolder);

        foreach ($dimension as $key => $item) {
            $profilePicSourceInFolder = $path . $key . "_" . $name;
            @unlink($profilePicSourceInFolder);
        }
    }

}

function dateFormat($date, $timeZone = 'Asia/Karachi')
{
    if (isset($date) && !empty($date)) {
        $utc = $date;
        $dt = new DateTime($utc);
        $original = $dt->format('r');
        $tz = new DateTimeZone($timeZone);
        $dt->setTimezone($tz);
        $getDateTime = $dt->format('d-M-Y  g:i:s A');
        return $getDateTime;
    }
}

function getUserTimeZone($date, $timeZone = 'Asia/Karachi')
{
    $utc = $date;
    $dt = new DateTime($utc);
    $original = $dt->format('r');
    $tz = new DateTimeZone($timeZone);
    $dt->setTimezone($tz);
    $getDateTime = $dt->format('r');
    $getDate = \Carbon\Carbon::parse($getDateTime)->diffForHumans();
    return $getDate;
}


function langLimit($key, $text)
{
    $detector = new \LanguageDetector\LanguageDetector(null, ['en', 'ur']);
    $description = explode(" ", $text);
    $urduWordCount = 0;
    $engWordCount = 0;
    foreach ($description as $item) {
        $language = $detector->evaluate($item)->getLanguage();
        if ($language == "ur") {
            $urduWordCount++;
        }
        if ($language == "en") {
            $engWordCount++;
        }
    }
    $totalWords = $urduWordCount + $engWordCount;
    $option = new \App\Models\Option();
    $value = $option->getValue($key);
    if ($engWordCount < ($totalWords * ($value / 100))) {
        return true;
    } else {
        return false;
    }

}

function checkBlockedKeyWord($string)
{
    $checkWords = \App\Models\BlockedKeyword::select("keyword")->get();
    foreach ($checkWords as $item) {
        if (strpos($string, $item->keyword)) {
            return $item->keyword;
        }
    }
}


