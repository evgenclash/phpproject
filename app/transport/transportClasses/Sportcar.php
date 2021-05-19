<?php


namespace app\transport;


class Sportcar extends Transport
{
    private static int $maxSpeed = 320;
    public $cameraType = "Video camera";

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

    public function setCameraType($camera): void
    {
        self::$cameraType = $camera;
    }

    public function getCameraType(): string
    {
        return self::$cameraType;
    }
}