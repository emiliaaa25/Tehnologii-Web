<?php
require_once ('C:\xampp\htdocs\ScreenActorAward\app\models\SearchModel.php');

class SearchController
{
    public function getSearch($params)
    {
        if (isset($params['query']) && !empty($params['query']) && is_string($params['query'])) {
            $showId = $params['query'];
            $model = new SearchModel();
            $seasons = $model->getSearch($showId);
            return json_encode($seasons);
        }
    }

}