<?php
class Genre{
     private  string $nom;
     private string $description;

    public function __construct(string $nom , string $description){
      $this->nom=$nom;
      $this->description=$description;

    }

    public function Ajouter(){
       $file=__DIR__ ."/../data/genres.json"; 

       $genres=json_decode(file_get_contents($file),true);


       $newId=1;

        if(!empty($genres)){
           $ids=array_column($genres,"id");
           $newId=max($ids)+1;
        }

        $newGenre=[
            "id"=>$newId,
            "nom"=>$this->nom,
            "description"=>$this->description
        ];
        
        $genres[] = $newGenre;

        file_put_contents($file, json_encode($genres)) ;

    }

}