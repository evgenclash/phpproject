<?php


namespace App;

require_once '../bootstrap/autoload.php';
class OperatorsCollection
{
    /** @var array<Operator> */
    private array $operators = [];

    public function addOperator(Operator $operator): void
    {
        $this->operators[] = $operator;
    }

    public function getRandom(): Operator
    {
        // TODO return random operator
        $randOp = rand(0, count($this->operators));
        return $this->operators[$randOp];
    }


    public function findByName(string $name): ?Operator
    {
        foreach ($this->operators as $op) {
            if ($op->getName() === $name) {
                return $op;
            }
        }
        return null;
    }

    public function getAllOperators()
    {
        return $this->operators;
    }


    public function toJson(): string
    {
        // TODO return json object of all operators
    }
}