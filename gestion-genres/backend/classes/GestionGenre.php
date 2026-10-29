<?php

require_once __DIR__ . '/Genre.php';


class GestionGenre
{
    private static string $dataFile = __DIR__ . '/../data/genres.json';

    public function lister(): array{
        $contenu = file_get_contents(self::$dataFile);

        $genres = json_decode($contenu, true);
        return $genres;
    }

    public function ajouter(Genre $genre): bool
    {
        $genres = $this->lister();

        // 2. Préparer le nouvel ID
        $newId = 1;

        if (!empty($genres)) {
            $ids = array_column($genres, 'id');
                $newId = max($ids) + 1;
            }

            // 3. Ajouter le nouveau genre au tableau
            $genres[] = [
                'id' => $newId,
                'nom' => $genre->getNom(),
                'description' => $genre->getDescription()
            ];

          // 4. Convertir le tableau PHP en JSON
            $nouveauContenu = json_encode(
                $genres,
            );

            // 5. Vérifier la conversion JSON
            if ($nouveauContenu === false) {
                return false;
            }

            // 6. Enregistrer dans le fichier JSON
            return file_put_contents(
                self::$dataFile,
                $nouveauContenu
                
            ) ;


    }
}















// class GestionGenre
// {
//     private static string $dataFile = __DIR__ . '/../data/genres.json';

//     public static function ajouter(Genre $genre): bool
//     {
//         // 1. Lire les genres depuis le fichier JSON
//         $contenu = file_get_contents(self::$dataFile);

//         if ($contenu === false) {
//             return false;
//         }

//         // 2. Convertir JSON en tableau PHP
//         $genres = json_decode($contenu, true);

//         if (!is_array($genres)) {
//             return false;
//         }

//         // 3. Generer un nouvel ID
//         $newId = 1;

//         if (!empty($genres)) {
//             $ids = array_column($genres, 'id');
//             $newId = max($ids) + 1;
            
//         }

//         // 4. Ajouter le nouveau genre au tableau
//         $genres[] = [
//             'id' => $newId,
//             'nom' => $genre->getNom(),
//             'description' => $genre->getDescription()
//         ];

//         // 5. Convertir le tableau PHP en JSON
//         $nouveauContenu = json_encode($genres,);

//         if ($nouveauContenu === false) {
//             return false;
//         }

//         // 6. Enregistrer les modifications dans le fichier JSON
//         return file_put_contents(
//             self::$dataFile,
//             $nouveauContenu
            
//         ) ;
//     }
// }