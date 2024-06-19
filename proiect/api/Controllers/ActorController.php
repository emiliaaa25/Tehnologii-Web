<?php
// controllers/ActorsController.php

require_once('D:\OneDrive\Documente\GitHub\Tehnologii-Web\proiect\api\Entity\ActorModel.php');

class ActorController {
    public function getAllActors() {
        $actorModel = new ActorModel();
        $actors = $actorModel->getAllActors();
        return json_encode($actors);
    }

    public function getActorByName($name) {
        $actorModel = new ActorModel();
        $actor = $actorModel->getActorByName($name);
        return json_encode($actor);
    }

    public function getAllActorsNames() {
        $actorModel = new ActorModel();
        $names= $actorModel->getAllActorsNames();
        return json_encode($names);
    }

}
