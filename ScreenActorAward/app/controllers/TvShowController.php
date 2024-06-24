<?php
// controllers/tvShowsController.php

require_once('C:\xampp\htdocs\ScreenActorAward\app\models\TvShowModel.php');

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

    public function getAllSeasonsFromTmdb($params) {
        if (isset($params['id']) && !empty($params['id']) && is_numeric($params['id'])) {
            $showId = $params['id'];
        $model = new TvShowModel();
        $seasons=$model->getAllSeasonsFromTmdb($showId);
        return json_encode($seasons);
        
    }
}

    public function getEpisodes($params) {
        if (isset($params['id']) && !empty($params['id']) && is_numeric($params['id']) && isset($params['season_number'])  && is_numeric($params['season_number'])) {
            $showId = $params['id'];
            $seasonNumber = $params['season_number'];
            $model = new TvShowModel();
            $episodes = $model->getEpisodes($showId, $seasonNumber);
            return json_encode($episodes);
        }
    }


}
