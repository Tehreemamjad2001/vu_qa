<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function aboutUs()
    {
        $this->pageData["page_title"] = "About Us";
        return $this->showPage("front_end.about_us");

    }
}
