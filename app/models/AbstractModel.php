<?php
namespace App;

use App\PdoConnection;
class AbstractModel
{
    protected $atributes = [];
    protected $pdo;

    public function __construct()
    {
        $start = new PdoConnection();
        $this->pdo = $start->dbConnect();
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->atributes;
    }

//    ВООБЩЕ НЕ ПОНЯЛ КАК ИХ ИСПОЛЬЗОВАТЬ ДЛЯ НАШЕЙ ЦЕЛИ!! а так понятно как они работают в принципе
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->atributes = $this->pdo->query("SELECT * FROM operators");
    }
}