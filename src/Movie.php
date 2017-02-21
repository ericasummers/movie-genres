<?php
    class Movie
    {
        private $name;
        private $id;
        private $genre_id;

        function __construct($name, $id = null, $genre_id)
        {
            $this->name = $name;
            $this->id = $id;
            $this->genre_id = $genre_id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function getGenreId()
        {
            return $this->genre_id;
        }

        function setGenreId($new_genre_id)
        {
            $this->genre_id = (int) $new_genre_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO movies (name, genre_id) VALUES ('{$this->getName()}', {$this->getGenreId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $movies = array();
            $returned_movies = $GLOBALS['DB']->query("SELECT * FROM movies;");
            foreach ($returned_movies as $movie) {
                $name = $movie['name'];
                $genre_id = $movie['genre_id'];
                $id = $movie['id'];
                $new_movie = new Movie($name, $id, $genre_id);
                array_push($movies, $new_movie);
            }
            return $movies;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM movies;");
        }
    }
 ?>
