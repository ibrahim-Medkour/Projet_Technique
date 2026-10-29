<?php

// require_once __DIR__ . '/../classes/Genre.php';
// require_once __DIR__ . '/../classes/GestionGenre.php';

// header('Content-Type: application/json; charset=utf-8');

// $method = $_SERVER['REQUEST_METHOD'];

// // GET : récupérer les genres
// if ($method === 'GET') {

//     $file = __DIR__ . '/../data/genres.json';

//     $contenu = file_get_contents($file);

//     if ($contenu === false) {
//         http_response_code(500);

//         echo json_encode([
//             'status' => 'error',
//             'message' => 'Impossible de lire le fichier JSON'
//         ]);

//         exit;
//     }

//     $genres = json_decode($contenu, true);

//     if (!is_array($genres)) {
//         http_response_code(500);

//         echo json_encode([
//             'status' => 'error',
//             'message' => 'Le fichier JSON est invalide'
//         ]);

//         exit;
//     }

//     echo json_encode([
//         'status' => 'success',
//         'data' => $genres
//     ]);

//     exit;
// }

// // POST : ajouter un genre
// if ($method === 'POST') {

//     $contenu = file_get_contents('php://input');
//     $data = json_decode($contenu, true);

//     if (
        // !is_array($data) ||
        // !isset($data['nom'], $data['description']) ||
        // !is_string($data['nom']) ||
        // !is_string($data['description']) ||
//         trim($data['nom']) === ''
//     ) {
//         http_response_code(400);

//         echo json_encode([
//             'status' => 'error',
//             'message' => 'Le nom et la description sont requis'
//         ]);

//         exit;
//     }

//     $genre = new Genre(
//         $data['nom'],
//         $data['description']
//     );

//     $gestion = new GestionGenre();

//     $succes = $gestion->ajouter($genre);

//     if (!$succes) {
//         http_response_code(500);

//         echo json_encode([
//             'status' => 'error',
//             'message' => "Erreur lors de l'ajout du genre"
//         ]);

//         exit;
//     }

//     echo json_encode([
//         'status' => 'success',
//         'message' => 'Le genre a été ajouté avec succès'
//     ]);

//     exit;
// }

