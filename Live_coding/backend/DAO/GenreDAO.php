<?php

require_once __DIR__ . "/../Classes/Genre.php";

class GenreDAO
{
    private string $file = __DIR__ . '/../data/genres.json';
    public function getALL(): array
    {

        $content = file_get_contents($this->file);
        if ($content === false) {
            throw new RuntimeException("Impossible de lire le fichier JSON");
        }
        return json_decode($content, true);

    }

    public function add(Genre $genre):void
    {
        $genres = $this->getAll();
        $newId = 1;

        if (!empty($genres)) {
            $ids = array_column($genres, "id");
            $newId = max($ids) + 1;
        }

        $newGenre = [
            "id" => $newId,
            "nom" => $genre->getNom(),
            "description" => $genre->getDescription()
        ];

        $genres[] = $newGenre;



        file_put_contents($this->file, json_encode($genres));
        
    }

}


