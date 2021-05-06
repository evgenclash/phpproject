<?php

use App\Operator;
use App\Parser\OperatorsParser;
use App\TeamManager;

require_once '../bootstrap/autoload.php';


//Initiate parsing
$parsing = new OperatorsParser();
//start parsing and create collection object
$collection = $parsing->parse();

$team = new TeamManager($collection);
echo '<pre>';
echo var_dump($team->buildTeam());
echo '<pre>';





