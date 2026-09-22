<?php

require_once "connexion.php";

function getGenres(){
    global $pdo;

    $sql = "SELECT * FROM filmgenre";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function ajouterDirector($nom, $prenom, $image){
    global $pdo;

    $sql = "INSERT INTO director 
            (nom_director, prenom_director, image_director)
            VALUES (:nom, :prenom, :image)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':image' => $image
    ]);
    return $pdo->lastInsertId();
}


 function Ajouterfilm( $titre, $description,$image,$annee,
                    $duree,$pays,$id_director,$id_genre){

    global $pdo;

    $sql = "INSERT INTO movie
            (
                titre_movie,
                description_movie,
                image_movie,
                annee_sortie,
                duree,
                pays_origine,
                id_director,
                id_genre
            )
            VALUES
            (
                :titre,
                :description,
                :image,
                :annee,
                :duree,
                :pays,
                :id_director,
                :id_genre
            )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':titre' => $titre,
        ':description' => $description,
        ':image' => $image,
        ':annee' => $annee,
        ':duree' => $duree,
        ':pays' => $pays,
        ':id_director' => $id_director,
        ':id_genre' => $id_genre
    ]);
}


 function getMovies()
{
    global $pdo;

    $sql = "SELECT
                movie.id_movie,
                movie.titre_movie,
                movie.description_movie,
                movie.image_movie,
                movie.annee_sortie,
                movie.duree,
                movie.pays_origine,
                director.nom_director,
                director.prenom_director,
                filmgenre.nom_genre
            FROM movie
            INNER JOIN director
                ON movie.id_director = director.id_director
            INNER JOIN filmgenre
                ON movie.id_genre = filmgenre.id_genre
            ORDER BY movie.id_movie DESC";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>