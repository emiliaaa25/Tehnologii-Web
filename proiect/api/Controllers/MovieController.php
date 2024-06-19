<?php
// controllers/MoviesController.php

require_once('D:\OneDrive\Documente\GitHub\Tehnologii-Web\proiect\api\Entity\MovieModel.php');

class MovieController {
    public function getAllMovies() {
        $movieModel = new MovieModel();
        $movies = $movieModel->getAllMovies(); 
        return json_encode($movies);
    }

}
