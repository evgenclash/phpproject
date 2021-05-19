<?php


namespace App\Parser;


class OperatorParsingFunctions
{


    public function get_operators($html)
    {
        preg_match_all('#<a[^>]+?class\s*?=\s*?(["\'])oplist__card\1[^>]*?>.+?</a>#su', $html, $ops);
        return $ops;
    }

    public function get_operatorUri($html)
    {
        preg_match('#href\s*?=\s*?"([^>]*?)"#', $html, $operatorUri);
        return $operatorUri[1];
    }

    public function get_cardLogoUri($html)
    {
        preg_match('#class\s*?=\s*?"oplist__card__icon"[^>]*?src="([^>]*?\.png)"#', $html, $cardLogoUri);
        return $cardLogoUri[1];
    }

    public function get_cardUri($html)
    {
        preg_match('#class\s*?=\s*?"oplist__card__img"[^>]*?src="([^>]*?\.png)"#', $html, $cardUri);
        return $cardUri[1];
    }

    public function get_name($html)
    {
        preg_match('#span\s*?>([^>]*?)<#', $html, $name);
        return $name[1];
    }

//парсинг строчными функциями!!!

    public function get_operators_str($html)
    {
        $startpos = 0;
        do {
//    search the starting position of operators card
            $startpos = strpos($html, 'class="oplist__card"', $startpos + 1);
//    check if we found a new operator
            if ($startpos !== false) {
//        find the end of the operator card info
                $endpos = strpos($html, '</span>', $startpos);
//         substract the string that contains info about operators 17 is number of skipped letters from the start of the html code for each operator, 24 is (17 that we gave to the start position and 7 for </span> tag
                $operator = substr($html, $startpos - 17, $endpos - $startpos + 24);
//        echo $endpos. '<br>'. '<br>'. '<br>';
            }
//        add each operators to the array of operators
            $operators[] = $operator;
        } while ($startpos !== false);
        return $operators;
    }

    public function get_operatorUri_str($html)
    {
        $startpos = 0;
        $startpos = strpos($html, 'href=', $startpos);
        $endpos = strpos($html, '"><');
        $operatorUri = substr($html, $startpos + 7, $endpos - $startpos - 7);
        return $operatorUri;
    }

    public function get_cardUri_str($html)
    {
        $startpos = 0;
        $startpos = strpos($html, '"oplist__card__img" src="', $startpos);
        $endpos = strpos($html, 'alt="');
//    +25 это длина ("oplist__card__img" src=") -27 это -25 которые добавил  в начале и -2 за это (">)
        $cardUri = substr($html, $startpos + 25, $endpos - $startpos - 27);
        return $cardUri;
    }

    public function get_cardLogoUri_str($html)
    {
        $startpos = 0;
        $startpos = strpos($html, '"oplist__card__icon" src="', $startpos);
//    тут используем strrpos чтобы узнать позицию последнего alt=
        $endpos = strrpos($html, 'alt="');
//    +26 это длина ("oplist__card__icon" src=") -28 это -26 которые добавил  в начале и за это-2 "space
        $cardUri = substr($html, $startpos + 26, $endpos - $startpos - 28);
        return $cardUri;
    }

    public function get_name_str($html)
    {
        $startpos = 0;
        $startpos = strpos($html, '<span>', $startpos);
//    тут используем strrpos чтобы узнать позицию последнего alt=
        $endpos = strrpos($html, '</span>');
//    +26 это длина ("oplist__card__icon" src=") -28 это -26 которые добавил  в начале и за это-2 "space
        $name = substr($html, $startpos + 6, $endpos - $startpos);
        return $name;
    }

    public function get_side($html)
    {
        $startpos = strpos($html, '<div class="operator__header__side__detail');
        preg_match('#span\s*?>([^>]*?)<#', $html, $side, PREG_OFFSET_CAPTURE, $startpos);
        return $side[1][0];
    }

    public function get_page($html)
    {
        /*    preg_match('#<div[^>]+?class\s*?=\s*?(["\'])operator__header__infos\1[^>]*?>(.+?)<div class="promo operator__ability__row "#su', $html, $ops);*/
        preg_match('#<div class="operator__header__infos">(.+?)</div>.+?</div>#su', $html, $ops);
        var_dump($ops);
        echo '<br>' . htmlentities($ops[1]);
        return $ops[0];
    }

    public function get_page_str($html)
    {
        $startpos = 0;
        $startpos = strpos($html, '<div class="operator__header__infos">', $startpos);
        $endpos = strpos($html, '<div class="promo operator__ability__row');
        $operatorUri = substr($html, $startpos, $endpos - $startpos);

        return $operatorUri;
    }

    public function get_stats($html)
    {
        $stats = array();
        $startpos = $this->findStats($html);

        foreach ($startpos as $ok) {
            $stat = $this->get_stats_str($ok);
            $stats = array_merge($stats,$stat);
        }

        return $stats;
    }

    public function findStats($html)
    {
        $startpos = 0;
        $result = [];
        while (false !== ($startpos = strpos($html, '<div class="operator__header__stat"', $startpos + 5))) {
            $endpos = strpos($html, '</div></div></div></div>', $startpos);
            $add = substr($html, $startpos, $endpos - $startpos);
            $result[] = $add;
        }

        return $result;
    }

    public function get_stats_str($html)
    {
        $counter = 0;
        $startpos = strpos($html, '<span>');
        $endpos = strpos($html, '</span>');
        $key = substr($html, $startpos + 6, $endpos - $startpos -6);
        while (false !== ($startpos = strpos($html, '<div class="react-rater-star is-disabled is-active"', $startpos + 2))) {
            $counter++;
        }
        $stats[$key] = $counter;

        return $stats;
    }

}