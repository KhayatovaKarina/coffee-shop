<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'mysql';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=coffee-shop", $username, $password);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>