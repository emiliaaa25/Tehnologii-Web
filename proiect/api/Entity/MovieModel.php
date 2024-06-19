<?php
require_once './Database/config.php';

class MovieModel {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllMovies() {
        $query = "SELECT DISTINCT `show` FROM screen_actor_guild_awards";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
