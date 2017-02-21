<?php
    class Genre
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO genres (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_genres = $GLOBALS['DB']->query("SELECT * FROM genres;");
            $genres = array();
            foreach($returned_genres as $genre) {
                $name = $genre['name'];
                $id = $genre['id'];
                $new_genre = new Genre($name, $id);
                array_push($genres, $new_genre);
            }
            return $genres;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM genres;");
        }
    }
?>
