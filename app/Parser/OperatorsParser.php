<?php


namespace App\Parser;


use App\Armor;
use App\ArmorCollection;
use App\Operator;
use App\OperatorsCollection;

class OperatorsParser
{
    private const URI = 'https://www.ubisoft.com/en-gb/game/rainbow-six/siege/game-info/operators?fbclid=IwAR0hE7Rjar0iT52mQtp9FaYL5ezVY3I_Th_KnCpH2ExvLlOE0eHKP6s-kTo&isSso=true&refreshStatus=noLoginData';
    private const HEADER = 'https://www.ubisoft.com';
    private ArmorCollection $armorCollection;
    private OperatorParsingFunctions $opParsingFunctions;
    private HTML $getHtml;
    private ArmorParsingFunctions $armorParsingFunctions;

    // TODO place here all the methods for parsing page of operators

    public function parse(): OperatorsCollection
    {
        $getHtml = new HTML();
        $this->getHtml = $getHtml;
        $operators = new OperatorsCollection();
        $opParsingFunctions = new OperatorParsingFunctions();
        $this->opParsingFunctions = $opParsingFunctions;
        $armorParsingFunctions = new ArmorParsingFunctions();
        $this->armorParsingFunctions = $armorParsingFunctions;

        //get html code of the page using CURL
        $html = $getHtml->get_curl(self::URI);

        // parse html page
        $this->parseHtmlToCollection($html, $operators);

        return $operators;
    }

    private function parseHtmlToCollection($html, OperatorsCollection $operators)
    {
        $ops = $this->opParsingFunctions->get_operators($html);

        foreach ($ops[0] as $operatorInfo) {
            $operator = $this->buildOperator($operatorInfo);
            $operators->addOperator($operator);
        }
    }

    public function buildOperator(string $operator): Operator
    {
        //    get the name
        $name = $this->opParsingFunctions->get_name($operator);

        $operatorObj = new Operator($name);

        //get the operatorsUri
        $operatorUri = $this->opParsingFunctions->get_operatorUri($operator);
        $operatorObj->setOperatorUri(self::HEADER . $operatorUri);

        //    get the cardLogoUri
        $cardLogoUri = $this->opParsingFunctions->get_cardLogoUri($operator);
        $operatorObj->setLogoUri($cardLogoUri);

        //    get the cardUri
        $cardUri = $this->opParsingFunctions->get_cardUri($operator);
        $operatorObj->setCardUri($cardUri);

//        get the page of the operators
        $page =  $this->getHtml->get_curl(self::HEADER . $operatorUri);
        $headerPage = $this->opParsingFunctions->get_page_str($page);
//        get the side ATTACKER OR DEFENDER
        $side = $this->opParsingFunctions->get_side($headerPage);
        $operatorObj->setSide($side);
//        get the stats of operators
        $stats = $this->opParsingFunctions->get_stats($headerPage);
        $operatorObj->setStats($stats);
//        get armorLoad
        $armor = $this->buildArmor($page);
        $operatorObj->setArmorCollection($armor);

        return $operatorObj;
    }

    function buildArmor($html)
    {
        $loadout = $this->armorParsingFunctions->get_armor_pg($html);
        $armorCollection = new ArmorCollection();
        $categories = $this->armorParsingFunctions->parseCategory($loadout);

        foreach ($categories as $category){
            $armors = $this->armorParsingFunctions->parseArmor($category);
            $weaponCategory = $this->armorParsingFunctions->getArmorCategory($category);

            foreach ($armors as $armor){
                $armorObj = new Armor();
                $armorObj->setCategory(trim($weaponCategory));
                $name = $this->armorParsingFunctions->parseName($armor);
                $armorObj->setName($name);
                $type = $this->armorParsingFunctions->parseType($armor);
                $armorObj->setType($type);
                $photoUri = $this->armorParsingFunctions->parsePhotoUri($armor);
                $armorObj->setPhotoUri($photoUri);

                $armorCollection->addArmor($armorObj);
            }
        }

        return $armorCollection;
    }
}
