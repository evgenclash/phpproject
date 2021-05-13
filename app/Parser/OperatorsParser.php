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

    public function buildOperator(string $operator): Operator
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

//        get the page of the operators
        $page =  curl_get(self::HEADER . $operatorUri);
        $headerPage = get_page_str($page);
//        get the side ATTACKER OR DEFENDER
        $side = get_side($headerPage);
        $operatorObj->setSide($side);
//        get the stats of operators
        $stats = get_stats($headerPage);
        $operatorObj->setStats($stats);
//        get armorLoad
        $armor = $this->buildArmor($page);
        $operatorObj->setArmorCollection($armor);

        return $operatorObj;
    }

    function buildArmor($html)
    {
        $loadout = $this->get_armor_pg($html);
        $armorCollection = $this->findArmors($loadout);

        return $armorCollection;
    }

    function get_armor_pg($html){
        $startpos = strpos($html, '<div class="operator__loadout"');
        $endpos = strpos($html,'<div class="scrollToAnchor"', $startpos);
        $loadout = substr($html, $startpos, $endpos - $startpos);

        return $loadout;
    }


    public function findArmors($html)
    {
        $armorCollection = new ArmorCollection();
        $categories = $this->parseCategory($html);
        foreach ($categories as $category){
            $armors = $this->parseArmor($category);
            $weaponCategory = $this->getArmorCategory($category);

            foreach ($armors as $armor){
                $armorObj = new Armor();
                $armorObj->setCategory(trim($weaponCategory));
                $name = $this->parseName($armor);
                $armorObj->setName($name);
                $type = $this->parseType($armor);
                $armorObj->setType($type);
                $photoUri = $this->parsePhotoUri($armor);
                $armorObj->setPhotoUri($photoUri);

                $armorCollection->addArmor($armorObj);
            }
        }

        return $armorCollection;
    }


    public function parseCategory($html)
    {
        $startpos = 0;
        while ($startpos = strpos($html, '<div class="operator__loadout__category">', $startpos+2)){
            $endpos = strpos($html, '</p></div></div></div>', $startpos);
            $category =  substr($html, $startpos, $endpos - $startpos + 22);
            $categories[] = $category;
        }

        return $categories;
    }

    public function parseArmor($html)
    {
        $startpos = 0;
        while (false !== $startpos = strpos($html, '<div class="operator__loadout__weapon"', $startpos + 5)){

            $endpos = strpos($html, '</p></div>', $startpos+2);
            $weapon =  substr($html, $startpos, $endpos - $startpos + 10);
            $loadout[] = $weapon;
        }

        return $loadout;
    }

    public function getArmorCategory($html)
    {
        $startpos = strpos($html, '<span>');
        $endpos = strpos($html, '</span>');
        $category = substr($html, $startpos + 6,$endpos - $startpos - 6);
        return $category;
    }

    public function parseName($html)
    {
        $startpos = strpos($html, '<p>');
        $endpos = strpos($html, '</p>');
        $name = substr($html, $startpos + 3,$endpos - $startpos - 3);
        return $name;
    }

    public function parseType($html)
    {
        $startpos = strpos($html, '</div><p>');
        $endpos = strpos($html, '</p>',$startpos);
        $type = substr($html, $startpos + 9,$endpos - $startpos - 9);
        return $type;
    }

    public function parsePhotoUri($html)
    {
        $startpos = strpos($html, 'img src="');
        $endpos = strpos($html, '.png"',$startpos);
        $photoUri = substr($html, $startpos + 9,$endpos - $startpos - 5);
        return $photoUri;
    }
}
