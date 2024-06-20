<?php
// models/ActorModel.php
require_once 'C:\xampp\htdocs\ProiectMVC\public\Database/config.php';
class ActorModel {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllActors() {
        $query = "SELECT * FROM screen_actor_guild_awards WHERE category LIKE '%ACTOR%'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllActorsNames() {
        $query = "SELECT full_name FROM screen_actor_guild_awards WHERE category LIKE '%ACTOR%'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActorByName($name) {
        $query = "SELECT * FROM screen_actor_guild_awards WHERE full_name = :name";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getActorsByStartingWith($letter) {
        $query = "SELECT * FROM screen_actor_guild_awards WHERE full_name LIKE :letter%";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':letter', $letter);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
