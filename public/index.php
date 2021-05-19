<?php

use App\DBwrite;
use App\Operator;
use App\Parser\OperatorsParser;
use App\TeamManager;

require_once '../bootstrap/autoload.php';

echo 'star';

$sqlDB = new DBwrite();

$sqlCheck = $sqlDB->checkDB();
echo $sqlCheck. '<hr>';
if ($sqlCheck < 60){
    ////Initiate parsing
    $parsing = new OperatorsParser($sqlDB);
    //start parsing and create collection object
    $collection = $parsing->parse();
    //
    $team = new TeamManager($collection);

    $teams = $team->buildTeam();

    $sqlDB->writeIntoBDTeam($teams,1);

    ////echo '<pre>';
    //echo var_dump($team->buildTeam());
    //echo '<pre>'
}

;





