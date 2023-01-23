<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function aboutUs()
    {

//        $text = 'My tailor is rich and Alison is in the kitchen with Bob.';
        $text = 'For  آپ کسی ہے  example, typing آپ کسی ہے  "Aap kasai hai?" becomes "آپ کسی ہے ?".';
        $text = 'آپ کسی ہےآپ کسی ہےآپ کسی ہےآپ کسی ہےآپ کسی ہےآپ کسی ہےآپ  کسی ہےآپ کسی ہےآپ کسی ہے ?my name is ';

        // $detector = new LanguageDetector(null, ['en', 'fr', 'de']);

        $detector = new \LanguageDetector\LanguageDetector(null, ['en', 'ur']);
        $language = $detector->evaluate($text)->getScores();
        dd($language);

        // $language = $detector->evaluate($text)->getLanguage();
        echo $language; // Prints something like 'en'
        exit;


        $this->pageData["page_title"] = "About Us";
        return $this->showPage("front_end.about_us");

    }
}
