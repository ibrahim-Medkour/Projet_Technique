<?php
class Genre{
     private  string $nom;
     private string $description;

    public function __construct(string $nom , string $description){
      $this->nom=$nom;
      $this->description=$description;

    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getDescription(): string {
        return $this->description;
    }

}