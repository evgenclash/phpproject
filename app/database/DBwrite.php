<?php


namespace App;


class DBwrite
{
    private $sqlCon;

    public function __construct()
    {
        $this->createConnection();
    }

    public function writeIntoDBOperator($name, $side, $stats, $operatorUri, $cardLogoUri, $cardUri)
    {
//        write the stats from array to variables

        if (isset($stats['Armor'])){
            $armor = $stats['armor'];
        }

        if (isset($stats['Speed'])){
            $speed = $stats['speed'];
        }

        if (isset($stats['Difficulty'])){
            $difficulty = $stats['difficulty'];
        }else {
            $difficulty = 0;
        }

        $stmt = "INSERT INTO operators(name, side, pageUri, logoUri, photoUri) VALUES ('$name', '$side', '$operatorUri', '$cardLogoUri', '$cardUri')";
        $prepared = $this->sqlCon->prepare($stmt);
        $prepared->execute([
            ':name'=> $name,
            ':side'=> $side,
            ':pageUri'=>$operatorUri,
            ':logoUri'=>$cardLogoUri,
            ':photoUri'=>$cardUri,
        ]);
        $stmt= "INSERT INTO Stats(name, speed, armor, difficulty) VALUES (:name, :speed, :armor, :difficulty)";
        $prepared = $this->sqlCon->prepare($stmt);
        $prepared->execute([
            ':name'=> $name,
            ':speed'=> $speed,
            ':armor'=>$armor,
            ':difficulty'=>$difficulty,
            ]);

    }

    public function writeIntoDBWeapon($name, $type, $category, $photoUri)
    {
        $stmt = ("INSERT INTO weapons(name, type, category, photoUri) VALUES (:name, :type, :category, :photoUri)");
        $prepared = $stmt->prepare($stmt);
        $prepared->execute([
            ':name'=>$name,
            ':type'=>$type,
            ':category'=>$category,
            ':photoUri'=>$photoUri,
        ]);
    }

    public function createConnection()
    {
        $DB = new PdoConnection();
        $connection = $DB->dbConnect();
        $this->sqlCon = $connection;
    }


    public function checkDB(): int
    {
        $result1 = $this->sqlCon->query( 'SELECT COUNT(name) as total FROM operators' )->fetchColumn();
        return $result1 ;
    }

    public function writeIntoBDTeam(Team $team, $teamNr)
    {
//        here we can write any info we need for each team
        $team = $team->getMembers();
        foreach ($team as $operator){
            $name = $operator->getName();
            $stmt = "INSERT INTO team(teamNR, name) VALUES (:teamNr,:name)";
            $prepared = $this->sqlCon->prepare($stmt);
            $prepared->execute([':teamNr' => $teamNr, ':name' => $name]);
        }
    }
}