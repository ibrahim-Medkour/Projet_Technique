
<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../DAO/GenreDAO.php';
require_once __DIR__ . '/../Classes/Genre.php';


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
    $genre = new Genre(
        $data['nome'],
        $data['description']
    );

    $this->genreDAO->add($genre);
}
}
