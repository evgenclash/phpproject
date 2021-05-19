<?php


namespace app\transport;


abstract class Transport
{
    public const MAX_SPEED = 100;

    protected string $color;
    protected string $model;
    protected int $speed;

    public Conditioner $conditioner;
    public Radio $radio;
    public GearBox $gearBox;
    public Camera $camera;
    private ?int $cruise;


    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setActualSpeed(int $Speed): void
    {
        $this->speed = $Speed;
        $this->setCruise();
    }

    public function setCruise(): void
    {
        $this->cruise = $this->speed;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getColor(): string
    {
        return $this->color;
    }


    public function getModel(): string
    {
        return $this->model;
    }

    public function speedUp($speed)
    {
        $newSpeed = $this->speed + $speed;

        if ($this->checkMaxSpeed($newSpeed)) {
            $this->actualSpeed = $newSpeed;
            $this->setCruise();
        } else {
            echo "Max speed has exceeded!!! ";
        }
    }

    public function slowDown($speed)
    {
        $newSpeed = $this->speed - $speed;

        if ($newSpeed >= 0) {
            $this->speed = $newSpeed;
            $this->cruise = null;

            return;
        }

        $this->speed = 0;

        echo "Can't slow down so much!!! We have stopped";
    }

    public function setCamera($camera): void
    {
        $this->camera = $camera;
    }

    public function stop()
    {
        $this->speed = 0;
    }

    public function conditioner(): Conditioner
    {
        $this->conditioner = new Conditioner();

        return $this->conditioner;
    }

    public function addRadio($volume = 10): Radio
    {
        $this->radio = new Radio($volume);

        return $this->radio;
    }

    public function startEngine(): void
    {
        $this->gearBox = new GearBox($this->camera());
    }

    public function camera()
    {
        $this->camera = new Camera($this->getCameraType());

        return $this->camera;
    }
}