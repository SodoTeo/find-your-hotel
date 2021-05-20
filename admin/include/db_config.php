<?php

    try{
        $connect = new PDO("mysql:host=localhost;dbname=booking", "root", "");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

?>