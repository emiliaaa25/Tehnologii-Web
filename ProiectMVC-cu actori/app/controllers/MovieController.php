<?php
// controllers/MoviesController.php

require_once('C:\xampp\htdocs\ProiectMVC\app\models\MovieModel.php');

class MovieController {
    public function getAllMovies() {
        $movieModel = new MovieModel();
        $movies = $movieModel->getAllMovies(); 
        return json_encode($movies);
    }

}
