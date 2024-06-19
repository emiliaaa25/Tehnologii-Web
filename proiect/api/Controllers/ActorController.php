<?php
// controllers/ActorsController.php

require_once('D:\OneDrive\Documente\GitHub\Tehnologii-Web\proiect\api\Entity\ActorModel.php');

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
    }


    public function getAllActorsNames() {
        $actorModel = new ActorModel();
        $names= $actorModel->getAllActorsNames();
        return json_encode($names);
    }

}
