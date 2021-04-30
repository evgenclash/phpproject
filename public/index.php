<?php
include_once('../functions/functions.reg.php');
include_once('../app/operators.php');


$url = 'https://www.ubisoft.com/en-gb/game/rainbow-six/siege/game-info/operators?fbclid=IwAR0hE7Rjar0iT52mQtp9FaYL5ezVY3I_Th_KnCpH2ExvLlOE0eHKP6s-kTo&isSso=true&refreshStatus=noLoginData';

$header = 'https://www.ubisoft.com/';

$operators =[];
$i = 0;
//get html code of the page using CURL
$html = curl_get($url);
//get html code of the page using file_get_contents
$html2 = get_html2($url);
//get the html code of the operators using our parser
$ops = get_operators($html);
foreach ($ops[0] as $i => $operator){
    //    get the name
    $name = get_name($operator);
    $operators['name'] = $name;
    $name = new Operators($name);
//get the operatorsUri
    $operatorUri = get_operatorUri($operator);
    $name->setOperatorUri($header. $operatorUri);
//    get the cardLogoUri
    $cardLogoUri = get_cardLogoUri($operator);
    $name->setLogoUri($cardLogoUri);
//    get the cardUri
    $cardUri = get_cardUri($operator);
    $name->setCardUri($cardUri);
//добавил все обьекты в массив(мне кажется что это нужно делать)
    $objectOperators[] = $name;
}
//вывел данные из обьектов
foreach ($objectOperators as $operator){
    echo $operator->getName(). '<br>';
    echo $operator->getOperatorUri(). '<br>';
    echo $operator->getcardUri(). '<br>';
    echo $operator->getCardLogoUri(). '<br>'. '<br>';
}




