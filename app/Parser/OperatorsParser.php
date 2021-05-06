<?php


namespace App\Parser;


use App\Operator;
use App\OperatorsCollection;

class OperatorsParser
{
    private const URI = 'https://www.ubisoft.com/en-gb/game/rainbow-six/siege/game-info/operators?fbclid=IwAR0hE7Rjar0iT52mQtp9FaYL5ezVY3I_Th_KnCpH2ExvLlOE0eHKP6s-kTo&isSso=true&refreshStatus=noLoginData';
    private const HEADER = 'https://www.ubisoft.com/';

    // TODO place here all the methods for parsing page of operators

    public function parse(): OperatorsCollection
    {
        $operators = new OperatorsCollection();

        //get html code of the page using CURL
        $html = curl_get(self::URI);

        // parse html page
        $this->parseHtmlToCollection($html, $operators);

        return $operators;
    }

    private function parseHtmlToCollection($html, OperatorsCollection $operators)
    {
        $ops = get_operators($html);

        foreach ($ops[0] as $operatorInfo) {
            $operator = $this->buildOperator($operatorInfo);
            $operators->addOperator($operator);
        }
    }

    private function buildOperator(string $operator): Operator
    {
        //    get the name
        $name = get_name($operator);

        $operatorObj = new Operator($name);

        //get the operatorsUri
        $operatorUri = get_operatorUri($operator);
        $operatorObj->setOperatorUri(self::HEADER . $operatorUri);

        //    get the cardLogoUri
        $cardLogoUri = get_cardLogoUri($operator);
        $operatorObj->setLogoUri($cardLogoUri);

        //    get the cardUri
        $cardUri = get_cardUri($operator);
        $operatorObj->setCardUri($cardUri);

        return $operatorObj;
    }

}
