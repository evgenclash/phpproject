<?php


namespace app\transport;

class Truck extends Transport implements Serializable, IPrintable
{
    public const MAX_SPEED = 140;
    public $cameraType = "Parktronics";


    protected function checkMaxSpeed($speed): bool
    {
        return $speed < static::MAX_SPEED;
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


    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }

    public function print(): void
    {
        // TODO: Implement print() method.
        $truckStr = json_encode($this->toArray());

        $this->printer->printString($truckStr);
    }
}