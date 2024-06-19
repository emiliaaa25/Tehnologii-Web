<?php

class MovieModel {
    private $connection;

    public function __construct() {
        $this->connection = new PDO("mysql:host=localhost;dbname=web", "web", "EmiliaAndra");
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllMovies() {
        $query = "SELECT * FROM screen_actor_guild_awards WHERE category LIKE '%ACTOR%'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
