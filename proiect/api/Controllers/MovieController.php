<?php
// controllers/MoviesController.php

require_once('D:\OneDrive\Documente\GitHub\Tehnologii-Web\proiect\api\Entity\MovieModel.php');

class MovieController {
    public function getAllMovies() {
        $movieModel = new MovieModel();
        $movies = $movieModel->getAllMovies(); 
        return json_encode($movies);
    }

    public function getMovieByName($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $movieModel = new MovieModel();
            $movie = $movieModel->getMovieByName($name);
        return json_encode($movie);
        }
    }
    public function getMovieDetails($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $movieModel = new MovieModel();
            $movieDetails = $movieModel->getMovieDetailsFromTmdb($name);
            return json_encode($movieDetails);

           
    }
}

}
