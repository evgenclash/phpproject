<?php

//include_once ('main.php');
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
//Получение страницы используя file_get_contents
function get_html2($url){
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