<?php

require_once "functions.php";


// ========================================
// 1. Vérifier que la requête est POST
// ========================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Requête invalide.");
}


// ========================================
// 2. Récupérer les données du formulaire
// ========================================

$nom = trim($_POST['nom']);
$prenom = trim($_POST['prenom']);

$titre = trim($_POST['titre']);
$description = trim($_POST['description']);
$annee = $_POST['annee'];
$duree = $_POST['duree'];
$pays = trim($_POST['pays']);

$id_genre = $_POST['id_genre'];


// ========================================
// 3. Récupérer les images
// ========================================

$image_director = $_FILES['image_director'] ?? null;
$image_movie = $_FILES['image_movie'] ?? null;


// ========================================
// 4. Validation des données
// ========================================

if (
    $nom === '' ||
    $prenom === '' ||
    $titre === '' ||
    $description === '' ||
    $annee === '' ||
    $duree === '' ||
    $pays === '' ||
    $id_genre === ''
) {
    die("Veuillez remplir tous les champs.");
}


if (!$image_director || $image_director['error'] !== UPLOAD_ERR_OK) {
    die("Image du réalisateur invalide.");
}


if (!$image_movie || $image_movie['error'] !== UPLOAD_ERR_OK) {
    die("Image du film invalide.");
}


// ========================================
// 5. Vérifier les images
// ========================================

$extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp'];

$extensionDirector = strtolower(
    pathinfo($image_director['name'], PATHINFO_EXTENSION)
);

$extensionMovie = strtolower(
    pathinfo($image_movie['name'], PATHINFO_EXTENSION)
);


if (!in_array($extensionDirector, $extensionsAutorisees)) {
    die("Format de l'image du réalisateur invalide.");
}


if (!in_array($extensionMovie, $extensionsAutorisees)) {
    die("Format de l'image du film invalide.");
}


// ========================================
// 6. Créer les noms des images
// ========================================

$nomImageDirector = uniqid('director_') . '.' . $extensionDirector;
$nomImageMovie = uniqid('movie_') . '.' . $extensionMovie;


// ========================================
// 7. Définir les chemins
// ========================================

$destinationDirector = "uploads/directors/" . $nomImageDirector;
$destinationMovie = "uploads/movies/" . $nomImageMovie;


// ========================================
// 8. Déplacer les images
// ========================================

if (!move_uploaded_file(
    $image_director['tmp_name'],
    $destinationDirector
)) {
    die("Erreur lors de l'enregistrement de l'image du réalisateur.");
}


if (!move_uploaded_file(
    $image_movie['tmp_name'],
    $destinationMovie
)) {
    die("Erreur lors de l'enregistrement de l'image du film.");
}


// ========================================
// 9. Ajouter le Director
// ========================================

$id_director = ajouterDirector($nom,$prenom, $destinationDirector
);


// ========================================
// 10. Ajouter le Movie
// ========================================

Ajouterfilm(
    $titre,
    $description,
    $destinationMovie,
    $annee,
    $duree,
    $pays,
    $id_director,
    $id_genre
);


// ========================================
// 11. Redirection vers l'accueil
// ========================================

header("Location: index.php");
exit;