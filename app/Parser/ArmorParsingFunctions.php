<?php


namespace App\Parser;


class ArmorParsingFunctions
{
    function get_armor_pg($html){
        $startpos = strpos($html, '<div class="operator__loadout"');
        $endpos = strpos($html,'<div class="scrollToAnchor"', $startpos);
        $loadout = substr($html, $startpos, $endpos - $startpos);

        return $loadout;
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