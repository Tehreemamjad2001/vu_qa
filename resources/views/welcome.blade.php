<?php
require_once 'Text/LanguageDetect.php';

use Illuminate\Support\Str;

$text = 'لڑکیوں لڑکیوں لڑکیوں لڑکیوںلڑکیوں لڑکیوںلڑکیوں لڑکیوںلڑکیوںلڑکیوںلڑکیوںلڑکیوں hello language text goodtext goodtext goodtext good text good very nice ';
$ld = new Text_LanguageDetect();
//dd($ld->detect($text));
$results = $ld->detect($text);

foreach ($results as $language => $confidence) {

    echo $language . ': ' . number_format($confidence, 2) . "<br>";
}

echo "------------------";
echo "<br>";


$urdu = "لڑکیوں  لڑکیوں لڑکیوں لڑکیوں لڑکیوںوں  لڑکیوں لڑکیوں لڑکوں   ";
$ld = new Text_LanguageDetect();
//3 most probable languages
$results = $ld->detect($urdu, 5);
foreach ($results as $language => $confidence) {
    echo $language . ': ' . number_format($confidence, 2) . "<br>";
}


echo "<br>";
//$wordsCount = Str::of($text)->wordCount();
//echo "Total words counts = " . $wordsCount;
//echo "<br>";
//echo "20% will be = " . $wordsCount * 20 / 100;
//echo "<br>";
//echo "80% will be = " . $wordsCount * 80 / 100;


?>
