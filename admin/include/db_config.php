<?php
    define('DB_SERVER','localhost');
    define('DB_USERNAME','fueluser');
    define('DB_PASSWORD','');
    define('DB_DATABASE','booking');

    $connect = new PDO("mysql:host=localhost;dbname=booking", "root", "");

?>