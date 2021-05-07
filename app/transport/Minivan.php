<?php


namespace app\transport;


class Minivan extends Transport
{

    private static int $maxSpeed = 140;

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