<?php
    define('DB_SERVER','localhost');
    define('DB_USERNAME','fueluser');
    define('DB_PASSWORD','');
    define('DB_DATABASE','booking');

    try{
        $connect = new PDO("mysql:host=localhost;dbname=booking", "root", "");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       }
       catch(PDOException $e){
        echo $e->getMessage();
       }

?>