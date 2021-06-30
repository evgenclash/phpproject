<?php

require_once '../bootstrap/autoload.php';


use App\AbstractModel;
use App\PdoConnection;
echo 'start'. '<br>';
$DB = new PdoConnection();
$pdo = $DB->dbConnect();

//$result = $pdo->query('SELECT *FROM operators');

//$result1 = $pdo->query( 'SELECT *  FROM team' );
//var_dump($result1);
//
//$stmt = "INSERT INTO team(teamNr, name) VALUES (:teamNr,:name)";
//$prepared = $pdo->prepare($stmt);
//$prepared->execute([':teamNr' => 4, ':name' => 'pesik']);
//echo '<br>'. '<br>';
//$result1 = $pdo->query( 'SELECT *  FROM team' );
//while ($row = $result1->fetch()){
//    echo $row['name'] ."   ".$row['teamNr'] . "<br>";
//}
//$dbh = new PDO('mysql:host=localhost;dbname=Operators', 'root', 'faqfaq12', array(
//    PDO::ATTR_PERSISTENT => true
//));
//$result = $dbh->query('SELECT *FROM operators');
//while ($row = $result->fetch())
//{
//    echo $row['name'] ."   ".$row['side'] . "<br>";
//}

$statement = $pdo->query('SELECT *FROM operators')->fetch(PDO::FETCH_OBJ, );


$result = $statement->fetchObj (AbstractModel::class);
//
//
$model = new Operator();
var_dump($model->name);
