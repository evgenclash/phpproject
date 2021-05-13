<?php

include_once 'autoload.php';

function compareSpeed($obj1, $obj2)
{
    if ($obj1->getSpeed() > $obj2->getSpeed()){
        return $obj1;
    }elseif ($obj1->getSpeed() < $obj2->getSpeed()){
        return $obj2;
    }elseif ($obj1->getSpeed() == $obj2->getSpeed()){
        $result = [$obj1, $obj2];
        return $result;
    }
}