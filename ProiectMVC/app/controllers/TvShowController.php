<?php
// controllers/tvShowsController.php

require_once('C:\xampp\htdocs\ProiectMVC\app\models\TvShowModel.php');

class TvShowController {
    public function getAlltvShows() {
        $tvShowModel = new TvShowModel();
        $tvShows = $tvShowModel->getAlltvShows(); 
        return json_encode($tvShows);
    }

    public function gettvShowDetailsFromTmdb($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $tvShowModel = new TvShowModel();
        $tvShow = $tvShowModel->gettvShowDetailsFromTmdb($name);
        return json_encode($tvShow);
        }
    }


}
