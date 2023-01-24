<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function aboutUs()
    {

//        $text = 'My tailor is rich and Alison is in the kitchen with Bob.';
        $text = 'For  آپ کسی ہے My tailor is rich and Alison is in the kitchen with Bob.My tailor is rich and Alison is in the kitchen with Bob.My tailor is rich and Alison is in the kitchen with Bob. example, typing آپ کسی ہے  "Aap kasai hai?" becomes "آپ کسی ہے ?".';
        $text = 'آپ کسی ہےآپ کسی ہےآپ کسی ہےآپ کسی ہےآپ کسی ہےآپ کسی  ہےآپ  کسی ہےآپ کسی example,
         typingexample, t
        ypingexample, typingexample, typingexampl, t ypingexample, typingexample, typing  My tailor is rich and Aliso
         is in the kitchen with Bob
        .My tailor is rich and Alison is in the kitchen with Bob.My tailor is rich and Alison is in 
        the kitchen with Bob.My tailor is rich and Alison is in the kitchen with Bob. ہےآپ کسی ہے
         y tailor is rich and Alison is in the kitchen with Bob.My tailor is rich and Alison
         is in the kitcheny tailor 
        is rich and Alison is in the kitchen with Bob.My tailor is rich and Alison is in the kitchen ?my name is ';

        // $detector = new LanguageDetector(null, ['en', 'fr', 'de']);
        $detector = new \LanguageDetector\LanguageDetector(null, ['en', 'ur']);

        $language = $detector->evaluate($text)->getLanguage();
        echo $language; // Prints something like 'en'

        $description = explode(" ", $text);
        $urduWordCount = 1;
        $engWordCount = 1;

        foreach ($description as $item) {
            $language = $detector->evaluate($item)->getLanguage();

            if ($language == "ur") {
                echo $item . " -----  " . $language . " ----- " . $urduWordCount;
                echo "<br>";
                $urduWordCount++;
            }
            if ($language == "en") {
                echo $item . " -----  " . $language . " ----- " . $engWordCount;
                echo "<br>";
                $engWordCount++;
            }


        }
        $engWordCount = 4;
        echo $totalUrduWords = "Total Urdu Words =  " . $urduWordCount;
        echo "<br>";
        echo $totalEngWords = "Total English Words =  " . $engWordCount;
        echo "<br>";
        $add = $urduWordCount + $engWordCount;
        echo $totalWords = "Total Words in a string =  " . $add;
        echo "<br>";
        echo "<br>";
        if ($engWordCount <= ($add * (20 / 100))) {
            echo "<br>";
            echo "<br>";
            echo $totalEngWords;
            echo "     hello 20 % english words";
        } else {
            echo "<br>";
            echo "<br>";
            echo "you exceed the limit of english words";
        }

        exit;


        $this->pageData["page_title"] = "About Us";
        return $this->showPage("front_end.about_us");

    }
}
