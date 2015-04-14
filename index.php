<?php
require_once "db.php";
  $bd=new ConnectDB;
  $pdo=$bd->connect();
  $qvery=$pdo->prepare("SELECT firm.firm_name, COUNT('firm_id')  as count
  FROM firm LEFT JOIN product USING(firm_id) 
  GROUP BY `firm_id` ORDER BY `count` DESC LIMIT 1
");
  $qvery->execute();
  $result=$qvery->fetchAll();
  print_r($result);  
 echo "third commit";
?>