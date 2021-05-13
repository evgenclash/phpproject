<?php

use app\transport\Minivan;

include_once 'autoload.php';

$car1 = new Minivan();

$car1->setActualSpeed(50);
$car1->speedUp(120);

echo $car1->getSpeed(). '<br>';

$car1->conditioner()->setConditioner(24);
echo $car1->conditioner->getWork();

$car1->conditioner->turnCondtionerOff();
echo $car1->conditioner->getTemp(). '<br>';

echo $car1->radio(25)->getVolume();
$car1->radio->turnOff();
echo $car1->radio->getVolume();




