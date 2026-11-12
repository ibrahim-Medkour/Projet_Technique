
<?php

require_once __DIR__ . '/../Services/GenreService.php';

class GenreController
{
    private GenreService $genreService;

    public function __construct()
    {
        $this->genreService = new GenreService();
    }

    public function getAll(): void
    {
        $genres = $this->genreService->getAll();

        echo json_encode($genres);
    }

   public function add(): void
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            $this->genreService->add($data);

            echo json_encode([
                "success" => true,
                "message" => "Genre ajouté avec succès"
            ]);

        } catch (Exception $e) {

            echo json_encode([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->getAll();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->add();
        }
    }
}

$controller = new GenreController();
$controller->handleRequest();
