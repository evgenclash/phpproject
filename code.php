<?php
include_once ('functions/curl.php');

$url = 'https://www.ubisoft.com/en-gb/game/rainbow-six/siege/game-info/operators?fbclid=IwAR0hE7Rjar0iT52mQtp9FaYL5ezVY3I_Th_KnCpH2ExvLlOE0eHKP6s-kTo&isSso=true&refreshStatus=noLoginData';

$header = 'https://www.ubisoft.com/';

$operators = [
    [

    ]
];
$i = 0;
//get html code of the page using CURL
$html = curl_get($url);
//get html code of the page using file_get_contents
$html2 = get_html2($url);
//get the html code of the operators using our parser
$ops = get_operators($html);

foreach ($ops[0] as $operator){
//get the operatorsUri
    $operatorUri = get_operatorUri($operator);
    $operators[$i]['operatorUri'] = $header. $operatorUri;
//    get the cardLogoUri
    $cardLogoUri = get_cardLogoUri($operator);
    $operators[$i]['cardLogoUri'] = $cardLogoUri;
//    get the cardUri
    $cardUri = get_cardUri($operator);
    $operators[$i]['cardUri'] = $cardUri;
    //    get the name
    $name = get_name($operator);
    $operators[$i]['name'] = $name;
//increment the counter
    $i++;
}

foreach ($operators as $operator){
    echo $operator['name']. '<br>';
    echo $operator['operatorUri']. '<br>';
    echo $operator['cardLogoUri']. '<br>';
    echo $operator['cardLogoUri']. '<br>'. '<br>';
}




