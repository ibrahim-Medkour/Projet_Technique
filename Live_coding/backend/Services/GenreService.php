
<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../DAO/GenreDAO.php';
require_once __DIR__ . "/../Classes/Genre.php";



class GenreService extends BaseService
{
    private GenreDAO $genreDAO;

    public function __construct()
    {
        $this->genreDAO = new GenreDAO();
    }

    public function getAll(): array
    {
        return $this->genreDAO->getAll();
    }

    public function add(array $data): void
{
    $nom = trim($data['nome'] ?? '');
    $description = trim($data['description'] ?? '');

    if ($nom === '') {
        throw new InvalidArgumentException(
            "Le nom est obligatoire"
        );
    }

    $genre = new Genre($nom, $description);

    $this->genreDAO->add($genre);
}
}
