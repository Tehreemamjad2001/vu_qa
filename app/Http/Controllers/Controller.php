<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Routing;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $pageData = [];

    public function showPage($view)
    {
        $this->pageData['forAll'] = "Global";
        return view($view)->with("pageData", $this->pageData);
    }

    function setFormMessage($formID, $messageType, $message)
    {
        $messageHTML = view("back_end.components.alert", [
            "messageType" => $messageType,
            "message" => $message
        ])->render();
        Session::flash('alert-' . $formID, $messageHTML);
    }

    public function createThumbnail($sourcePath, $pathName)
    {
        $dimension = profilePicDimension();

        foreach ($dimension as $key => $item) {

            $path = $sourcePath . $pathName;
            $img = Image::make($path)->resize($item["width"], $item["height"]);
            $thumbnailPath = $sourcePath . $key . "_" . $pathName;
            $img->save($thumbnailPath);

        }
    }



}
