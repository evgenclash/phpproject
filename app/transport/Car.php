<?php


namespace app\transport;


class Car extends Transport
{
    private static int $maxSpeed = 220;

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