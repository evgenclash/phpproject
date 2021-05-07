<?php


namespace app\transport;


class Truck extends Transport
{
    private static int $maxSpeed = 120;

    protected function checkMaxSpeed($speed): bool
    {
        if ($speed < self::$maxSpeed){
            return true;
        }
        return false;
    }

    public static function getMaxSpeed(): int
    {
        return self::$maxSpeed;
    }
}