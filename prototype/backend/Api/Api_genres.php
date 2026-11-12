<?php

require_once "../Classes/Genre.php";
require_once "../Classes/GenreManager.php";


if($_SERVER['REQUEST_METHOD']==="GET"){

    $file = __DIR__ ."/../data/genres.json";
    $genres=json_decode(file_get_contents($file),true);

    echo json_encode(
        $genres
    );

    exit;
}

if($_SERVER['REQUEST_METHOD']==="POST"){

    $data=json_decode(file_get_contents("php://input"),true);

    $genre=new Genre(
        $data["nome"],
        $data["description"]
    );

    $manager = new GenreManager();
    $manager->Ajouter($genre);

    echo json_encode([
        "status"=>"sucesses",
        "message"=>"le genre et ajouter"
    ]);
    exit;
} 