<?php
// controllers/MoviesController.php

require_once('../Entity/MovieModel.php');

class MovieController {
    public function getAllMovies() {
        $movieModel = new MovieModel();
        $movies = $movieModel->getAllMovies(); 
        return json_encode($movies);
    }

}
