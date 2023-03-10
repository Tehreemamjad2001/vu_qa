<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Mail\TestMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function contactUsView()
    {
        $this->pageData["page_title"] = "Contact Us";
        return $this->showPage("front_end.contact_us");
    }

    public function contactUs(UserRequest $request)
    {
        $contactUser = Contact::create([
            "name" => $request->name,
            "email" => $request->email,
            "message" => $request->message,
        ]);

        Mail::to($request->email)->send(new TestMail());
        if ($contactUser) {
            $this->setFormMessage("contact-us-record", "success", "Your message has been sent ");
        } else {
            $this->setFormMessage("contact-us-record", "danger", "something went wrong");
        }
        return back();
    }
}
