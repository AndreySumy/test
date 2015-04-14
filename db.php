<?php
class ConnectDB{
private $user='root';// пользователь базы данных
private $pass='';//пароль к базе данных
private $host='localhost';//хост на котором расположенная база данных
private $my_db='Test';//имя базы данных
/**
 * connect
 * создает соединение с баззой данных
 * @return $DBH - обьект PDO
 */
function connect(){
try{
    $opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    );
    $DBH = new PDO("mysql:host=$this->host", $this->user, $this->pass, $opt); 
    $DBH->exec("CREATE DATABASE IF NOT EXISTS `$this->my_db`");
    $DBH->exec("use $this->my_db");
    $DBH->exec("CREATE TABLE IF NOT EXISTS firm (
           firm_id  INT AUTO_INCREMENT NOT NULL,
           firm_name  VARCHAR(10) NOT NULL UNIQUE,
           INDEX i_firm_name(firm_name(3)),
           PRIMARY KEY(firm_id )
         ) ENGINE=MyISAM CHARACTER SET=UTF8;
         
         CREATE TABLE IF NOT EXISTS product (
           product_id  INT AUTO_INCREMENT NOT NULL,
           name  VARCHAR(30) NOT NULL,
           INDEX i_name(name(3)),
           firm_id  INT NOT NULL,
           PRIMARY KEY(product_id)
         ) ENGINE=MyISAM CHARACTER SET=UTF8;
         ");
    
    }catch(PDOException $e){
     die('Error : '.$e->getMessage());
    }
return $DBH;
}
}
?>