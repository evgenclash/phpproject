<?php

//include_once ('main.php');
function curl_get($url, $referer = 'https://www.google.com'){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
//    это выключает заголовок ответа от сервера
    curl_setopt($ch,CURLOPT_HEADER, 0);
//    реферер показывает откуда мы нашли данный сайт, чтобы не выглядили для сайта будто мы кодом заходим
    curl_setopt($ch, CURLOPT_REFERER,$referer);
//    для передачи результата в качестве строки вместо вывода сайта в браузере
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//    также как и контекст ниже для того чтобы обходили защиту от входа на сайт с помощю кода , чтобы выглядели как реальные людя зашедшие с браузера, тут находится содержимое http запроса
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}
//Получение страницы используя file_get_contents
function get_html2($url){
//    этот контекст для того чтобы сайт который мы парсим увидел заголовок что это реальный человек заходит с браузера,как я понял это такая защита от получения инфы с сайта с помощю кода

//    array используется (я не уверен но думаю изза того что нашему user agent присваивается заголовок от разных браузеров
    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (HTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    $result = file_get_contents($url,false, $context);
    return $result;
}



//Функции парсинга тут написаны

function get_operators($html){
    preg_match_all('#<a[^>]+?class\s*?=\s*?(["\'])oplist__card\1[^>]*?>.+?</a>#su', $html, $ops);
    return $ops;
}


function get_operatorUri($html){
    preg_match('#href\s*?=\s*?"([^>]*?)"#',$html,$operatorUri);
    return $operatorUri[1];
}

function get_cardLogoUri($html){
    preg_match('#class\s*?=\s*?"oplist__card__icon"[^>]*?src="([^>]*?\.png)"#',$html,$cardLogoUri);
    return $cardLogoUri[1];
}

function get_cardUri($html){
    preg_match('#class\s*?=\s*?"oplist__card__img"[^>]*?src="([^>]*?\.png)"#',$html,$cardUri);
    return $cardUri[1];
}

function get_name($html){
    preg_match('#span\s*?>([^>]*?)<#',$html,$name);
    return $name[1];
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
    $name = substr($html, $startpos + 6,$endpos - $startpos);
    return $name;
}
