<?php


namespace App;


use PDO;

class PdoConnection
{
    protected $host = 'localhost';
    protected $dbname = 'Operators';
    protected $user = 'root';
    protected $password = 'faqfaq12';



    public function dbConnect()
    {
        $db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . '', $this->user, $this->password) or die("Cannot connect to mySQL.");

        return $db;
    }
}