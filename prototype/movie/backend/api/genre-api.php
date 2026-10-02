<?php

header("Content-Type: application/json");

require_once "../classes/Genre.php";

// GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $file = "../data/genres.json";

    $genres = json_decode(
        file_get_contents($file),
        true
    );

    echo json_encode([
        "status" => "success",
        "data" => $genres
    ]);
          
    exit;
}

//POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(
        file_get_contents("php://input"),
        true
    );

    if (!isset($data["nom"]) || empty(trim($data["nom"]))) {

        echo json_encode([
            "status" => "error",
            "message" => "Le nom du genre est obligatoire"
        ]);

        exit;
    }

    // Créer l'objet Genre
    $genre = new Genre(
        trim($data["nom"])
    );

    // Ajouter le genre
    $genre->ajouter();

    // Réponse
    echo json_encode([
        "status" => "success",
        "message" => "Genre ajouté avec succès"
    ]);

    exit;
}



