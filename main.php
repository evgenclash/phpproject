<?php

include_once ('/Users/mac/PhpstormProjects/simplehtmldom_1_9_1/simple_html_dom.php');
include_once ('functions/curl.php');

$context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (HTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);
$header = 'https://www.ubisoft.com/';
$operators = [
    [

    ]
];
$url = 'https://www.ubisoft.com/en-gb/game/rainbow-six/siege/game-info/operators?fbclid=IwAR0hE7Rjar0iT52mQtp9FaYL5ezVY3I_Th_KnCpH2ExvLlOE0eHKP6s-kTo&isSso=true&refreshStatus=noLoginData';

//get the content of the page using file_get_content
$try = file_get_contents($url,false, $context);
//echo (htmlentities($try));

//                                тут должна была быть фунция для получения имени
//function get_name($ops){
    $i = 0;
//    foreach($ops as $element) {
//        $a = $element->find('span', 0);
//        $operators[$i]['name'] = $a;
//        $i++;
//    }
//    var_dump($operators);
//    foreach ($operators as $operator){
//        echo $operator['name']. '<br>';
//    }

//get the html
$html = curl_get($url);

// Create DOM from URL or file
$dom = str_get_html($html);
//find all the operators
$ops = $dom->find('.oplist__card');

//get_name($ops);
foreach($ops as $element) {
//    get name
    $a = $element->find('span',0);
    $operators[$i]['name'] = $a;

//get operatorsUri
    $operators[$i]['operatorUri'] = $header. $element->href;
//    get cardLogoUri
    $a = $element->find('.oplist__card__img',0);
    $operators[$i]['cardLogoUri'] = $a->src;
//    get logoUri
    $a = $element->find('.oplist__card__icon',0);
    $operators[$i]['logoUri'] = $a->src;
    $i++;
}

////var_dump ($operators);
//foreach ($operators as $operator){
//    echo $operator['name']. '<br>';
//    echo $operator['operatorUri']. '<br>';
//    echo $operator['cardLogoUri']. '<br>';
//    echo $operator['logoUri']. '<br>'. '<br>';
////    var_dump($operator);
//}
echo '<br>'. '<br>';
$op_page = curl_get('https://www.ubisoft.com//en-gb/game/rainbow-six/siege/game-info/operators/finka');
var_dump($op_page);




