<?php

namespace App;

use Exception;

require_once '../bootstrap/autoload.php';

class TeamManager
{
    private OperatorsCollection $operators;

    public function __construct(OperatorsCollection $operatorsCollection)
    {
        $this->operators = $operatorsCollection;
    }

    /**
     * @throws Exception
     */
    //builds the team of    UNIQUE OPERATORS
    public function buildTeam(int $membersCount = 5): Team
    {
        if ($membersCount < 4) {
            // allow only 4 or more count of team members
            throw new Exception('TeamManager can contain 4+ members');
        }
        //CREATE the teamObject
        $team = new Team($membersCount);
        // TOdo build team from random operator (UNIQUE)

            while(!$team->isComplete()){
                $member = $this->operators->getRandom();
                if ($team->isUnique($member)){
                $team->addMember($member);
                }
            }

        return $team ;
    }

    public function buildByNames(array $names): Team
    {
        $team = new Team();
        
        foreach ($names as $name){
            $operator = $this->operators->findByName($name);
            $team->addMember($operator);
        }
        
        return $team;
    }

    public function buildTeamAttackers(int $membersCount = 5): Team
    {
        $team = new Team($membersCount);
        // TOdo build team from random operator (UNIQUE)

        while(!$team->isComplete()){
            $member = $this->operators->getRandom();
            if ($team->isUnique($member)){
                if ($member->getSide() == 'Attacker')
                $team->addMember($member);
            }
        }

        return $team ;
    }

    public function buildTeamDefenders(int $membersCount = 5): Team
    {
        $team = new Team($membersCount);
        // TOdo build team from random operator (UNIQUE)

        while(!$team->isComplete()){
            $member = $this->operators->getRandom();
            if ($team->isUnique($member)){
                if ($member->getSide() == 'Defender')
                    $team->addMember($member);
            }
        }

        return $team ;
    }



}