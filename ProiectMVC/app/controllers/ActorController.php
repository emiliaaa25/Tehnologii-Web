<?php
require_once('C:\xampp\htdocs\ProiectMVC\app\models\ActorModel.php');
class ActorController {
    public function getAllActors() {
        $actorModel = new ActorModel();
        $actors = $actorModel->getAllActors();
        return json_encode($actors);
    }

    public function getActorByName($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $actorModel = new ActorModel();
            $actors = $actorModel->getActorByName($name);
            return json_encode($actors);
        }
        return json_encode([]);
    }

    public function getActorsStartingWith($params) {
        //  if (isset($params['letter']) && !empty($params['letter']) && is_string($params['letter'])) {
            //  $letter = $params['letter'];
          $actorModel = new ActorModel();
          $actors = $actorModel->getActorsStartingWith($params);
          return $actors;
        // }
         // return null;
      }

    public function getAllActorsNames() {
        $actorModel = new ActorModel();
        $names = $actorModel->getAllActorsNames();
        return json_encode($names);
    }
    public function getActorDetails($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $actorModel = new ActorModel();
        $actors = $actorModel->getActorDetailsFromTmdb($name);
        return json_encode($actors);
        }
    }

    public function getActorPhotos($params) {
        if (isset($params['name']) && !empty($params['name']) && is_string($params['name'])) {
            $name = $params['name'];
            $actorModel = new ActorModel();
            $actors = $actorModel->getActorPhoto($name);
            return json_encode($actors);
        }
        return json_encode([]);
    }

    public function getActorsPaginated($page, $pageSize) {
        $actorModel = new ActorModel();
        return $actorModel->getActorsPaginated($page, $pageSize);
    }

    public function getTotalActors() {
        $actorModel = new ActorModel();
        return $actorModel->getTotalActors();
    }
}
