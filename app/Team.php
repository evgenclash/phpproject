<?php

namespace App;

use App\OperatorsCollection;

require_once '../bootstrap/autoload.php';

class Team
{
    private int $membersCount;

    /** @var array<Operator> */
    private array $members = [];

    public function __construct(int $membersCount = 5)
    {
        // TODO
        $this->membersCount = $membersCount;
    }

//adds a new member to the team
    public function addMember(Operator $member): void
    {
        // TODO
        $this->members[] = $member;
    }

//check if the team is complete
    public function isComplete(): bool
    {
        // TODO
        $count = count($this->members);
        if ($count == $this->membersCount) {

            return true;
        }

        return false;
    }

//check if operator is unique
    public function isUnique($operator): bool
    {
        foreach ($this->members as $compare) {
            if ($compare === $operator) {

                return false;
            }
        }

        return true;
    }

    /**
     * @return Operator[]
     */
    public function getMembers(): array
    {
        return $this->members;
    }
}

