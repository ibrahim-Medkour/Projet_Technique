<?php

require_once "../classes/Genre.php";

if($_SERVER['REQUEST_METHOD']==="GET"){

    $file = __DIR__ ."/../data/genres.json"; 
    $genres=json_decode(file_get_contents($file),true);

    echo json_encode([
        "status"=>"sucesses",
        "data"=>$genres
    ]);
   
    exit;
}

if($_SERVER['REQUEST_METHOD']==="POST"){

    $data=json_decode(file_get_contents("php://input"),true);

    $genre=new Genre(
        $data["nom"],
        $data["description"]
    );

    $genre->Ajouter();

    echo json_encode([
        "status"=>"sucesses",
        "message"=>"le genre et ajouter"
    ]);
    exit;

}

