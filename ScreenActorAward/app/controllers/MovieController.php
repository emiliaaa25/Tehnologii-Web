<?php
require_once ('C:\xampp\htdocs\ScreenActorAward\app\models\MovieModel.php');

class MovieController
{
    public function movieDetail($params)
    {
        if (!empty($params)) {
            $param = $params[0];
            $sanitizedParam = filter_var($param, FILTER_SANITIZE_STRING);

            $viewFilePath = 'C:/xampp/htdocs/ScreenActorAward/app/views/Movie.php';
            if (file_exists($viewFilePath)) {
                $_GET['title'] = $sanitizedParam;
                require_once $viewFilePath;
            } else {
                echo "View file not found.";
            }
        } else {
            echo "No parameters specified.";
        }
    }

    public function getAllMovies()
    {
        $movieModel = new MovieModel();
        $movies = $movieModel->getAllMovies();
        return json_encode($movies);
    }

    public function getMovieDetailsFromTmdb($params)
    {
        if (isset($params['title']) && !empty($params['title']) && is_string($params['title'])) {
            $name = $params['title'];
            $movieModel = new MovieModel();
            $movie = $movieModel->getMovieDetailsFromTmdb($name);
            return json_encode($movie);
        }
    }


}
