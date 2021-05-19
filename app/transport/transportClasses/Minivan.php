<?php


namespace app\transport;


class Minivan extends Transport
{

    private static int $maxSpeed = 140;
    public static $cameraType = "None";

    protected function checkMaxSpeed($speed): bool
    {
        if ($speed < self::$maxSpeed) {
            return true;
        }
        return false;
    }

    public static function getMaxSpeed(): int
    {
        return self::$maxSpeed;
    }

    public function setCameraType($camera): void
    {
        self::$cameraType = $camera;
    }

    public function getCameraType(): string
    {
        return self::$cameraType;
    }
}