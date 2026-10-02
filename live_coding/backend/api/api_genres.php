<?php

header("content-Type:application/json");

require_once "../classes/class_genre.php";


//GET
if($_SERVER['REQUEST_METHOD']==="GET"){
    $file="../data/data_genres.json";
    $genres=json_decode(file_get_contents($file),true);

    echo json_encode([
        "status"=>"success",
        "data"=>$genres
    ]);
}

//POST
if($_SERVER['REQUEST_METHOD']==="POST"){
    $data=json_decode(file_get_contents("php://input"),true);

    $genre = new Genre($data['nom'],$data['description']);
    $genre->Ajouter();

    echo json_encode([
        "status"=>"success",
        "message"=>"vous aver ajouter data"
    ]);
}




