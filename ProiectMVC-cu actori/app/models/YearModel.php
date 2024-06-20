<?php
// models/ActorModel.php
require_once 'C:\xampp\htdocs\ProiectMVC\public\Database\config.php';
class YearModel {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllYears() {
        $query = "SELECT DISTINCT year FROM screen_actor_guild_awards" ;
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllFromSpecificYear($year) {
        $query = "SELECT * FROM screen_actor_guild_awards where year = :year " ;
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':year', $year);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    

}