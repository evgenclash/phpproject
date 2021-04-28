<?php
include_once('functions/functions.str.php');
include_once ('functions/operators.php');

$url = 'https://www.ubisoft.com/en-gb/game/rainbow-six/siege/game-info/operators?fbclid=IwAR0hE7Rjar0iT52mQtp9FaYL5ezVY3I_Th_KnCpH2ExvLlOE0eHKP6s-kTo&isSso=true&refreshStatus=noLoginData';
//get html code of the page using file_get_contents
$html = curl_get($url);
$header = 'https://www.ubisoft.com/';


$ops = get_operators_str($html);

foreach ($ops as $i => $operator){
//get the operatorsUri
    $operatorUri = get_operatorUri_str($operator);
    $operators[$i]['operatorUri'] = $header. $operatorUri;
//    get the cardLogoUri
    $cardLogoUri = get_cardLogoUri_str($operator);
    $operators[$i]['cardLogoUri'] = $cardLogoUri;
//    get the cardUri
    $cardUri = get_cardUri_str($operator);
    $operators[$i]['cardUri'] = $cardUri;
    //    get the name
    $name = get_name_str($operator);
    $operators[$i]['name'] = $name;
}
//это для вывода на экран все данные из массива $operators[]
//foreach ($operators as $operator){
//    echo $operator['name']. '<br>'. '<br>';
//    echo $operator['operatorUri']. '<br>';
//    echo $operator['cardUri']. '<br>';
//    echo $operator['cardLogoUri']. '<br>'. '<br>';
//}


// попытался записать данные в класс(не суди строго:) )
foreach ($operators as $operator){

    $operator = new operators($operator['name'],$operator['operatorUri'],$operator['cardUri'],$operator['cardLogoUri']);
    $objectOperators[] = $operator;
}
//вывел на экран из класса
foreach ($objectOperators as $operator){
    echo $operator->name. '<br>'. '<br>';
    echo $operator->operatorUri. '<br>';
    echo $operator->cardUri. '<br>';
    echo $operator->cardLogoUri. '<br>'. '<br>'. '<br>';
}



