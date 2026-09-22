-- 1. Création de la base de données
CREATE DATABASE films;

USE films;


-- 2. Table DIRECTOR
CREATE TABLE director (
    id_director INT AUTO_INCREMENT PRIMARY KEY,
    nom_director VARCHAR(100) NOT NULL,
    prenom_director VARCHAR(100) NOT NULL,
    image_director VARCHAR(255)
);


-- 3. Table FILMGENRE
CREATE TABLE filmgenre (
    id_genre INT AUTO_INCREMENT PRIMARY KEY,
    nom_genre VARCHAR(100) NOT NULL
);

INSERT INTO filmgenre (nom_genre) VALUES
('Action'),
('Comédie'),
('Drame'),
('Horreur'),
('Science-Fiction'),
('Romance'),
('Thriller'),
('Aventure'),
('Animation'),
('Fantastique');

-- 4. Table MOVIE
CREATE TABLE movie (
    id_movie INT AUTO_INCREMENT PRIMARY KEY,
    titre_movie VARCHAR(255) NOT NULL,
    description_movie TEXT NOT NULL,
    image_movie VARCHAR(255) NOT NULL,
    annee_sortie INT NOT NULL,
    duree INT NOT NULL,
    pays_origine VARCHAR(100) NOT NULL,

    id_director INT NOT NULL,
    id_genre INT NOT NULL,

    CONSTRAINT fk_movie_director
        FOREIGN KEY (id_director)
        REFERENCES director(id_director),

    CONSTRAINT fk_movie_genre
        FOREIGN KEY (id_genre)
        REFERENCES filmgenre(id_genre)
);