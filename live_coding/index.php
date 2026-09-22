<?php

require_once "functions.php";

$movies = getMovies();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Films</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Nos Films</h1>

    <div class="movies">

        <?php foreach ($movies as $movie): ?>

            <div class="movie-card">

                <img
                    src="<?= htmlspecialchars($movie['image_movie']) ?>"
                    alt="<?= htmlspecialchars($movie['titre_movie']) ?>"
                >

                <h2>
                    <?= htmlspecialchars($movie['titre_movie']) ?>
                </h2>

                <p>
                    <?= htmlspecialchars($movie['description_movie']) ?>
                </p>

                <p>
                    <strong>Réalisateur :</strong>
                    <?= htmlspecialchars($movie['prenom_director']) ?>
                    <?= htmlspecialchars($movie['nom_director']) ?>
                </p>

                <p>
                    <strong>Genre :</strong>
                    <?= htmlspecialchars($movie['nom_genre']) ?>
                </p>

                <p>
                    <strong>Année :</strong>
                    <?= htmlspecialchars($movie['annee_sortie']) ?>
                </p>

                <p>
                    <strong>Durée :</strong>
                    <?= htmlspecialchars($movie['duree']) ?> minutes
                </p>

                <p>
                    <strong>Pays :</strong>
                    <?= htmlspecialchars($movie['pays_origine']) ?>
                </p>

            </div>

        <?php endforeach; ?>

    </div>

</body>

</html>