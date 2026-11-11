<?php
require_once __DIR__ . '/Genre.php';

class GenreManager {

    public function Ajouter(Genre $genre){
       $file=__DIR__ ."/../data/genres.json";

       $genres=json_decode(file_get_contents($file),true);


       $newId=1;

        if(!empty($genres)){
           $ids=array_column($genres,"id");
           $newId=max($ids)+1;
        }

        $newGenre=[
            "id"=>$newId,
            "nom"=>$genre->getNom(),
            "description"=>$genre->getDescription()
        ];

        $genres[] = $newGenre;

        file_put_contents($file, json_encode($genres)) ;

    }

}
