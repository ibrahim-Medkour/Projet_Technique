<?php

require_once "functions.php";

$genres = getGenres();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion Films</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Ajouter un film</h1>

    <form action="traitement.php" method="POST" enctype="multipart/form-data">

        <!-- ==================== DIRECTOR ==================== -->

        <h2>Informations du réalisateur</h2>

        <div>
            <label for="nom">Nom du réalisateur</label>
            <input type="text" name="nom" id="nom" required>
        </div>

        <div>
            <label for="prenom">Prénom du réalisateur</label>
            <input type="text" name="prenom" id="prenom" required>
        </div>

        <div>
            <label for="image_director">Image du réalisateur</label>
            <input type="file" name="image_director" id="image_director" accept="image/*"required>
        </div>


        <!-- ==================== MOVIE ==================== -->

        <h2>Informations du film</h2>

        <div>
            <label for="titre">Titre du film</label>
            <input type="text" name="titre" id="titre" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <div>
            <label for="image_movie">Image du film</label>
            <input type="file" name="image_movie"  id="image_movie" accept="image/*" required>
        </div>

        <div>
            <label for="annee">Année de sortie</label>
            <input type="number" name="annee" id="annee" required>
        </div>

        <div>
            <label for="duree">Durée (minutes)</label>
            <input type="number" name="duree" id="duree" required>
        </div>

        <div>
            <label for="pays">Pays d'origine</label>
            <input type="text" name="pays" id="pays" required>
        </div>


        <!-- ==================== GENRE ==================== -->

        <div>
            <label for="genre">Genre</label>
            <select name="id_genre" id="genre" required>
                <option value="">-- Choisir un genre --</option>

                <?php foreach ($genres as $genre): ?>

                    <option value="<?= $genre['id_genre'] ?>">
                        <?= htmlspecialchars($genre['nom_genre']) ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>


        <!-- ==================== BUTTON ==================== -->

        <button type="submit">Ajouter</button>

    </form>

</body>

</html>