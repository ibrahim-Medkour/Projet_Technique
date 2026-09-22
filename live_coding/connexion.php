<?php
$host="localhost";
$dbname="films";
$user="root";
$password="009139B";

try{
    $pdo=new PDO("mysql:host=$host;dbname=$dbname",$user,$password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die("erreur de connexion : " .$e->getMessage());
}



?>