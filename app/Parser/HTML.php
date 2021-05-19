<?php


namespace App\Parser;


class HTML
{
    //include_once ('main.php');
    public function get_curl($url, $referer = 'https://www.google.com'){

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
    public function get_html2($url){
//    этот контекст для того чтобы сайт который мы парсим увидел заголовок что это реальный человек заходит с браузера,как я понял это такая защита от получения инфы с сайта с помощю кода

//    array используется (я не уверен но думаю изза того что нашему user agent присваивается заголовок от разных браузеров
        $context =stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (HTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $result = file_get_contents($url,false, $context);
        return $result;
    }
}