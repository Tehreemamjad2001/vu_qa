<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function contactUs()
    {
        $this->pageData["page_title"] = "Contact Us";
        return $this->showPage("front_end.contact_us");
    }
}
