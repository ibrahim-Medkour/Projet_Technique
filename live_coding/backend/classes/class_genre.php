<?php
class Genre {
  private string $nom;
  private string $descriptoin;

    public function  __construct(string $nom , string $descriptoin){
        $this->nom=$nom;
        $this->descriptoin=$descriptoin;
  
    }

    public function Ajouter(){
        
        $file="../data/data_genres.json";
        $genres=json_decode(file_get_contents($file),true);


        $newId=1;
        if(!empty($genres)){
           $ids=array_column($genres,"id");
           $newId=count($ids)+1;
        }

        $neveauGenre=[
            "id"=>$newId,
            "nom"=>$this->nom,
            "description"=>$this->descriptoin
        ];

        $genres[]=$neveauGenre;

        file_put_contents($file,json_encode($genres));
    }
    

  
}