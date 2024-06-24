<?php
require_once 'C:\xampp\htdocs\ScreenActorAward\public\Database\config.php';
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
    public function getDetails($url){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 100,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI3NDA1ZjJlYWE5NzRjYmRmOThmYzBkZWU4YzYyZTNmZCIsInN1YiI6IjVkNjAwMmVkYTg5NGQ2NmZmOTlhYjY3MyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.5PZuPsNJ0tMAyp9hyhUN6Yv3W_EryL2UMKAyecJxoEU",
                "accept: application/json"
              ],
            ]);
            

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
    
    }
    public function fetchImageUrl($name, $type) {
        $url = "https://api.themoviedb.org/3/search/";
        if ($type == 'person') {
            $url .= 'person';
        } else if ($type == 'tv') {
            $url .= 'tv';
        }
        else {
            $url .= 'movie';
        }
        $url .= '?query=' . urlencode($name). '&language=en-US';
        $data = $this->getDetails($url);
    
        if ($type == 'person' && isset($data['results'][0]['profile_path'])) {
            return 'https://image.tmdb.org/t/p/w185' . $data['results'][0]['profile_path'];
        } elseif (isset($data['results'][0]['poster_path'])) {
            return 'https://image.tmdb.org/t/p/w185' . $data['results'][0]['poster_path'];
        }
        return null;
    }
    public function getCategoriesAndNomineesForYear($year) {
    $query = "SELECT category, IF(full_name IS NULL OR full_name = '', `show`, full_name) AS nominee, IF(won = 'true', IF(full_name IS NULL OR full_name = '', `show`, full_name), NULL) AS winner, full_name FROM screen_actor_guild_awards WHERE year = :year ORDER BY category";
    $statement = $this->connection->prepare($query);
    $statement->bindParam(':year', $year);
    $statement->execute();

    $categories = [];

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $category = $row['category'];
        $nominee = $row['nominee'];
        $winner = $row['winner'];
        $fullName = $row['full_name'];

        if (!isset($categories[$category])) {
            $categories[$category] = [
                'nominees' => [],
                'winner' => null,
                'type' => null,
                'imageUrl' => null
            ];
        }

        if ($fullName !== NULL && $fullName !== '' && (stripos($category, 'ENSEMBLE') === false) && (stripos($category, 'CAST') === false)) {
            $type = 'person';
        } else if ((stripos($category, 'ENSEMBLE') !== false) && $fullName === '') {
            $type = 'tv';
        } else if ((stripos($category, 'CAST') !== false )&& $fullName === '') {
            $type = 'movie';
        } else {
            $type = 'not important';
        }

        if ($type === 'not important') {
            continue; 
        }

        if ($categories[$category]['type'] === null) {
            $categories[$category]['type'] = $type;
        }

        $nomineeImageUrl = $this->fetchImageUrl($nominee, $type);
        $categories[$category]['nominees'][] = ['name' => $nominee, 'type' => $type, 'imageUrl' => $nomineeImageUrl];

        if ($winner !== null && $categories[$category]['winner'] === null) {
            $categories[$category]['winner'] = $winner;
            $categories[$category]['imageUrl'] = $this->fetchImageUrl($winner, $type);
        }
    }

    return ['year' => $categories];
}
    public function getNominationsCount($year) {
        $query = "SELECT COUNT(*) AS count FROM screen_actor_guild_awards WHERE year = :year";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
    public function getYearData($year) {
        $query = "SELECT * FROM screen_actor_guild_awards WHERE year = :year";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchAllScreenActorGuildAwards() {
        $query = "SELECT * FROM screen_actor_guild_awards"; // Adjust table name if necessary
        $result = $this->connection->query($query);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGenderStatistics() {
        $query = "
            SELECT
                SUM(CASE WHEN category LIKE '%FEMALE%' THEN 1 ELSE 0 END) AS Female,
                SUM(CASE WHEN category LIKE '%MALE%' THEN 1 ELSE 0 END) AS Male
            FROM screen_actor_guild_awards
        ";
        $result = $this->connection->query($query);

        $stats = $result->fetch(PDO::FETCH_ASSOC);
        return $stats;
    }
    public function getGenderStatisticsByYear($year) {
        $query = "
            SELECT
                SUM(CASE WHEN category LIKE '%FEMALE%' THEN 1 ELSE 0 END) AS Female,
                SUM(CASE WHEN category LIKE '%MALE%' THEN 1 ELSE 0 END) AS Male,
                SUM(CASE WHEN category NOT LIKE '%FEMALE%' AND category NOT LIKE '%MALE%' THEN 1 ELSE 0 END) AS `Show`
            FROM screen_actor_guild_awards
            WHERE year = :year
        ";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();
    
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stats;
    }
    public function getNominationsData() {
        $query = "SELECT year, COUNT(*) as nominations FROM screen_actor_guild_awards GROUP BY year";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['nominations'] > 50) {

                $data[substr($row['year'], 0, 4)] =$row['nominations'];
            }
        }

        return $data;
    }
}