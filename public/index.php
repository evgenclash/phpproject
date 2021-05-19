<?php

use App\Operator;
use App\Parser\OperatorsParser;
use App\TeamManager;

require_once '../bootstrap/autoload.php';


//Initiate parsing
$parsing = new OperatorsParser();
//start parsing and create collection object
$collection = $parsing->parse();

//$team = new TeamManager($collection);
//echo '<pre>';
//echo var_dump($team->buildTeam());
//echo '<pre>';

$str2 = $collection->findByName('Finka');
echo strcmp('https://www.ubisoft.com/en-gb/game/rainbow-six/siege/game-info/operators/lion', $str2->getOperatorUri()). '<br>';
$operatorUri = get_html2($str2->getOperatorUri());

//$res = $parsing->get_armor_pg($str2);
////echo htmlentities($res);
//$res1 = $parsing->parseCategory($res);
$random = $collection->getAllOperators();

//foreach ($random as $okn){
//    $weaponCollectionAll = $okn->getArmorCollection()->getAllWeapons();


//    foreach ($weaponCollectionAll as $key=>$col){
        echo '<pre>';
        var_dump($random);
        echo '<br>'. '<br>'. '<br>'. '<br>';
//        var_dump($col);
//        echo '<br>'. $key. '<br>'. '<br>';
//    }
//}





