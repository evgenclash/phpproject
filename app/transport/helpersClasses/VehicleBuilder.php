<?php


namespace app\transport;


class VehicleBuilder
{
    public function makeBlueCar(): Car
    {
        $car = new Car();
        $car->setCamera(new Camera('Hope'));
//        $car->gearBox
    }

    public function sendToPrint(IPrintable $printable)
    {
        $printable->print();
    }

}