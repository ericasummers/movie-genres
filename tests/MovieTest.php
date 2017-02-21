<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Genre.php';
    require_once 'src/Movie.php';

    $server = 'mysql:host=localhost:8889;dbname=media_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class MovieTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Movie::deleteAll();
            Genre::deleteAll();
        }

        function test_MovieSave()
        {
            $name = "Action";
            $id = null;
            $new_genre = new Genre($name, $id);
            $new_genre->save();

            $movie_name = "The Fifth Element";
            $genre_id = $new_genre->getId();
            $new_movie = new Movie($name, $id, $genre_id);
            $new_movie->save();

            $result = Movie::getAll();

            $this->asserEquals($new_movie, $result[0]);
        }
    }




?>
