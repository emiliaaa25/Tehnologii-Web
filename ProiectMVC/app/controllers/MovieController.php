<?php
// controllers/MoviesController.php

require_once('C:\xampp\htdocs\ProiectMVC\app\models\MovieModel.php');

class MovieController {
    public function getAllMovies() {
        $movieModel = new MovieModel();
        $movies = $movieModel->getAllMovies(); 
        return json_encode($movies);
    }

    public function getMovieDetailsFromTmdb($params) {
        if (isset($params['title']) && !empty($params['title']) && is_string($params['title'])) {
            $name = $params['title'];
            $movieModel = new MovieModel();
        $movie = $movieModel->getMovieDetailsFromTmdb($name);
        return json_encode($movie);
        }
    }


}
