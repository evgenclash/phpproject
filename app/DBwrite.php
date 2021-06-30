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

        if (isset($stats["Armor"])){
            $armor = $stats["Armor"];
        }

        if (isset($stats['Speed'])){
            $speed = $stats["Speed"];
        }

        if (isset($stats['Difficulty'])){
            $difficulty = $stats["Difficulty"];
        }else {
            $difficulty = 0;
        }

        mysqli_query($this->sqlCon,"INSERT INTO operators(Name, Side, PageUri, logoUri, photoUri) VALUES ('$name', '$side', '$operatorUri', '$cardLogoUri', '$cardUri')");
        mysqli_query($this->sqlCon, "INSERT INTO Stats(Name, Speed, Armor, Difficulty) VALUES ('$name', '$speed', '$armor', '$difficulty')");
    }

    public function writeIntoDBWeapon($name, $type, $category, $photoUri)
    {
        mysqli_query($this->sqlCon,"INSERT INTO weapons(Name, type, category, photoUri) VALUES ('$name', '$type', '$category', '$photoUri')");
    }

    public function createConnection()
    {
        $connection = mysqli_connect('localhost', 'root', "faqfaq12",'Operators');

        if ($connection == false){
            echo 'какаято ошибка подключения к базе данных';
        }
        $this->sqlCon = $connection;
    }

    public function closeConnection()
    {
        mysqli_close($this->sqlCon);
    }

    public function checkDB(): int
    {
        $result1 = mysqli_query($this->sqlCon, 'SELECT COUNT(Name) as total FROM operators' );
        $data=mysqli_fetch_assoc($result1);
        return $data['total'] ;
    }

    public function writeIntoBDTeam(Team $team, $teamNr)
    {
//        here we can write any info we need for each team
        $team = $team->getMembers();
        foreach ($team as $operator){
            $name = $operator->getName();
            mysqli_query($this->sqlCon,"INSERT INTO team(teamNR, Name) VALUES ('$teamNr','$name')");
        }
    }
}