<?php

class Genre
{
    private string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    public function ajouter(): bool
    {
        $file = "../data/genres.json";

        $genres = json_decode(
            file_get_contents($file),
            true
        );

        // Générer un nouvel ID
        $newId = 1;

        if (!empty($genres)) {
            $ids = array_column($genres, "id");
            $newId = max($ids) + 1;
        }

        // Créer le nouveau genre
        $nouveauGenre = [
            "id" => $newId,
            "nom" => $this->nom
        ];

        // Ajouter au tableau
        $genres[] = $nouveauGenre;

        // Enregistrer dans JSON
        file_put_contents(
            $file,
            json_encode($genres, JSON_PRETTY_PRINT)
        );

        return true;
    }
}