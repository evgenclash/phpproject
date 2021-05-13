<?php

require_once '../functions/functions.reg.php';

////капец какой простой автолоадер классов НЕ СРАБОТАЛО, ЕЩЕ ПОДУМАЮ
//spl_autoload_register('myAutoloader');
//function myAutoloader($className){
//
//    if ($className == 'OperatorsParser'){
//        $path = 'app/Parser/';
//    }else {
//        $path = '../app/';
//    }
//    $extentsion = '.php';
//    $fullPath ='../'. $className. $extentsion;
//    include_once $fullPath;
//
//}
require_once '../app/Operator.php';
require_once '../app/Parser/OperatorsParser.php';
require_once '../app/OperatorsCollection.php';
require_once '../app/Team.php';
require_once '../app/TeamManager.php';
require_once '../app/Armor.php';
require_once '../app/ArmorCollection.php';

