<?php
function curl_get($url, $referer = 'https://www.google.com'){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_REFERER,$referer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

//парсинг строчными функциями!!!

function get_operators_str($html){
    $startpos = 0;
    do{
//    search the starting position of operators card
        $startpos = strpos ($html,'class="oplist__card"',$startpos+1);
//    check if we found a new operator
        if ($startpos !==false){
//        find the end of the operator card info
            $endpos = strpos($html, '</span>', $startpos);
//         substract the string that contains info about operators 17 is number of skipped letters from the start of the html code for each operator, 24 is (17 that we gave to the start position and 7 for </span> tag
            $operator = substr($html, $startpos - 17, $endpos - $startpos +24);
//        echo $endpos. '<br>'. '<br>'. '<br>';
        }
//        add each operators to the array of operators
        $operators[] = $operator;
    }while($startpos !== false);
    return $operators;
}

function get_operatorUri_str($html){
    $startpos = 0;
    $startpos = strpos($html, 'href=',$startpos);
    $endpos = strpos($html, '"><');
    $operatorUri = substr($html, $startpos + 7,$endpos - $startpos - 7);
    return $operatorUri;
}

function get_cardUri_str($html){
    $startpos = 0;
    $startpos = strpos($html, '"oplist__card__img" src="',$startpos);
    $endpos = strpos($html, 'alt="');
//    +25 это длина ("oplist__card__img" src=") -27 это -25 которые добавил  в начале и -2 за это (">)
    $cardUri = substr($html, $startpos + 25,$endpos - $startpos - 27);
    return $cardUri;
}

function get_cardLogoUri_str($html){
    $startpos = 0;
    $startpos = strpos($html, '"oplist__card__icon" src="',$startpos);
//    тут используем strrpos чтобы узнать позицию последнего alt=
    $endpos = strrpos($html, 'alt="');
//    +26 это длина ("oplist__card__icon" src=") -28 это -26 которые добавил  в начале и за это-2 "space
    $cardUri = substr($html, $startpos + 26,$endpos - $startpos - 28);
    return $cardUri;
}

function get_name_str($html){
    $startpos = 0;
    $startpos = strpos($html, '<span>',$startpos);
//    тут используем strrpos чтобы узнать позицию последнего alt=
    $endpos = strrpos($html, '</span>');
//    +26 это длина ("oplist__card__icon" src=") -28 это -26 которые добавил  в начале и за это-2 "space
    $name = substr($html, $startpos + 6,$endpos - $startpos - 6);
    return $name;
}
